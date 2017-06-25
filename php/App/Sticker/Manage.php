<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class Manage extends Service
{
  public function _manage()
  {
    Load::Session()->logged();
    if(Load::$my['am']!=9)
    {
      Load::move('https://jarm.com/');
    }
    if(is_numeric(Load::$path[1])||Load::$path[1]=='new')
    {
      return $this->manage_view();
    }
    else
    {
      return $this->manage_home();
    }
  }

  public function manage_home()
  {
    Load::Ajax()->register(['newapp','delapp','frominet']);
    return Load::$core
      ->assign('getapp',getapp())
      ->fetch('sticker/manage.home');
  }

  public function manage_view()
  {
    $db=Load::DB();
    $app=[];
    if(Load::$path[1]!='new')
    {
      $arg=['u'=>Load::$my['_id'],'_id'=>intval(Load::$path[1])];
      if(Load::$my['_id']==1)
      {
        unset($arg['u']);
      }
      if((!$app=$db->findOne('sticker',$arg)))
      {
        Load::move('/manage',false);
      }
    }
    if($_POST)
    {
      $error=[];
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,50,'utf-8'));
      $arg['c']=intval(trim($_POST['cate']));
      $arg['ref']=trim($_POST['ref']);
      $arg['pl']=($_POST['published']?1:0);

      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อสติกเกอร์';
      }
      if((!$arg['c'])||!isset($cate[$arg['c']]))
      {
        $error['cate']='กรุณาเลือกหมวด';
      }

      if(!$arg['ref'])
      {
        $error['ref']='กรุณาเลือกที่มา';
      }

      if(Load::$my['am']>=9)
      {
        $arg['rc']=($_POST['rc']?1:0);
      }
      if(!count($error))
      {
        if(Load::$path[1]=='new')
        {
          $arg['u']=Load::$my['_id'];
          $arg['do']=0;
          if($id=$db->insert('sticker',$arg))
          {
            $app=$arg;
            $app['_id']=$id;
            $fd=Load::Folder()->fd($id);
            $app['fd']=substr($fd,2,2).'/'.substr($fd,4,2);
            $app['f']=rtrim(substr($fd,2,2).substr($fd,4,2),'0');
            $db->update('sticker',['_id'=>$id],['$set'=>['fd'=>$app['fd']]]);
          }
        }
        else
        {
          $id=$app['_id'];
          $db->update('sticker',['_id'=>$id],['$set'=>$arg]);
        }


        if($f=$_FILES['photo']['tmp_name'])
        {
          $size=@getimagesize($f);
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/bmp':
            case 'image/wbmp':
            case 'image/png':
            case 'image/x-png':
              if($size[0]>=1 && $size[1]>=1)
              {
                $q=Load::Upload()->post('s3','sticker-post','@'.$f,['folder'=>$app['fd']]);
                if($q['status']=='OK')
                {
                  $db->update('sticker',['_id'=>$app['_id']],['$set'=>['img'=>$q['data']['n']]]);
                }
              }
          }
        }

        $tm=time();
        if(is_array($fs=$_FILES['photo_icon']['tmp_name']))
        {
          foreach($fs as $f)
          {
            if($f)
            {
              $size=@getimagesize($f);
              switch (strtolower($size['mime']))
              {
                case 'image/gif':
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/bmp':
                case 'image/wbmp':
                case 'image/png':
                case 'image/x-png':
                  if($size[0]>=16 && $size[1]>=16)
                  {
                    if($icon=$db->insert('sticker_icon',['p'=>$app['_id']]))
                    {
                      $arg=[];
                      $fd=Load::Folder()->fd($icon);
                      $arg['fd']=substr($fd,0,2).'/'.substr($fd,2,2);
                      $arg['f']=rtrim(substr($fd,0,2).substr($fd,2,2),'0');
                      $arg['n']=substr($fd,4,2);
                      $q=Load::Upload()->post('s3','sticker-pic','@'.$f,$arg);
                      if($q['status']=='OK')
                      {
                        $db->update('sticker_icon',['_id'=>$icon],['$set'=>$q['data']]);
                      }
                      else
                      {
                        $db->remove('sticker_icon',['_id'=>$icon]);
                      }
                    }
                  }
              }
            }
          }
        }
        for($i=0;$i<count($_POST['delo']);$i++)
        {
          if($_POST['delo'][$i])
          {
            if($icon=$db->findone('sticker_icon',['_id'=>intval($_POST['delo'][$i]),'p'=>$app['_id']]))
            {
              $q=Load::Upload()->post('s3','sticker-del',$app['_id'],$icon);
              $db->update('sticker_icon',['_id'=>$icon['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
            }
          }
        }
        Load::move('/manage/'.$app['_id'].'?completed');
      }
      else
      {
        $app=array_merge($app,$arg);
      }
    }
    return Load::$core
      ->assign('app',$app)
      ->assign('icon',$db->find('sticker_icon',['p'=>$app['_id'],'dd'=>['$exists'=>false]]))
      ->assign('error',$error)
      ->fetch('sticker/manage.view');
  }

  public function getapp($page=1)
  {
    $rows = 30;
    $allorder = ['_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ'];
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    $all=['order','by','search','page'];

    extract(Load::Split()->get('/manage/',0,$all,$allorder,$allby));

    $arg = ['u'=>Load::$my['_id'],'dd'=>['$exists'=>false],'ref'=>'fb'];
    if(Load::$my['_id']==1)
    {
      unset($arg['u']);
    }
    if($search)
    {
      $arg['$or']=[['t'=>$q],['m'=>$q]];
    }

    $db=Load::DB();
    if($count=$db->count('sticker',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($rows,$count,[$url,'page-'],$page);
      $app=$db->find('sticker',$arg,[],['skip'=>$skip,'limit'=>$rows,'sort'=>[$order=>($by=='desc'?-1:1)]]);
    }


    Load::$core->assign(['app'=>$app,'pager'=>$pg,'count'=>number_format($count),'allby'=>$allby,'allorder'=>$allorder]);
    for($i=0;$i<count($all);$i++)if(${$all[$i]}) Load::$core->assign($all[$i],${$all[$i]});
    return Load::$core->fetch('sticker/manage.home.list');
  }

  public function delapp($i)
  {
    $db=Load::DB();
    $arg=['u'=>Load::$my['_id'],'_id'=>intval($i)];

    if(Load::$my['_id']==1)
    {
      unset($arg['u']);
    }
    if($var=$db->findOne('sticker',$arg))
    {
      $db->update('sticker',['_id'=>$var['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::Upload()->post('s3','sticker-clean',$var['fd']);
    }
    Load::Ajax()->jquery('#getapp','html',getapp());
  }
}
?>
