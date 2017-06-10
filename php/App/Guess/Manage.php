<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;

class Manage extends Service
{
  public function _manage()
  {
    Load::Session()->logged();
    if(!Load::$my['st'] || Load::$my['st']<1)
    {
      Load::move('https://jarm.com/verify');
    }
    if(is_numeric(Load::$path[1])||Load::$path[1]=='new')
    {
      $this->manage_view();
    }
    elseif(in_array(Load::$path[1],['stats']))
    {
      $this->{'manage_'.Load::$path[1]}();
    }
    else
    {
      $this->manage_home();
    }
  }

  public function manage_home()
  {
    Load::Ajax()->register(['newapp','delapp','frominet']);
    Load::$core->assign('getapp',$this->getapp());
    Load::$core->data['content']=Load::$core->fetch('guess/manage.home');
  }

  public function manage_stats()
  {
    $db=Load::DB();
    $arg=['uid'=>Load::$my['_id'],'_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false]];
    if(Load::$my['_id']=='100000795480500')
    {
      unset($arg['uid']);
    }
    if((!$var=$db->findOne('guess',$arg)))
    {
      Load::move('/manage/',false);
    }
    $mn=['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
    $stats = $db->find('guess_play',['a'=>$var['_id'],'da'=>['$gte'=>Load::Time()->now(-3600*24*14)]],['k'=>1,'c'=>1],['sort'=>['k'=>1]]);
    $k=[['']];
    $a = $x = [[0,'']];
    $sa = $su = $sv = 0;
    for($i=0;$i<count($stats);$i++)
    {
      $_a = intval($stats[$i]['c']);
      $sa += $_a;
      $a[]=[$i+1,$_a];
      $k[]=$stats[$i]['k'];
      $e = explode('-',$stats[$i]['k']);
      $x[]=[$i+1,$e[2].'<br>'.$mn[intval($e[1])-1]];
    }
    $c=count($stats);
    if($c>1)
    {
      $a1 = $a[$c][1];
      $a2 = $a[$c-1][1];
      $_a = intval((($a1-$a2)/max(1,$a2))*100);
      $_a = ': <strong>'.number_format($sa).'</strong> <span class="stats-'.($_a>0?'u">(+':'d">(').$_a.'%)</span>';
    }
    $i=$c+1;
    $a[] = [$i,''];
    $k[] = '';
    Load::$core->data['content']=Load::$core
      ->assign('app',$var)
      ->assign('stats',$stats)
      ->assign('a',$a)
      ->assign('k',$k)
      ->assign('x',$x)
      ->assign('_a',$_a)
      ->fetch('guess/manage.stats');
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
      if((!$app=$db->findOne('guess',$arg)))
      {
        Load::move('/manage',false);
      }
    }
    if($_POST)
    {
      $error=[];
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,50,'utf-8'));
      $arg['d']=trim(mb_substr(strip_tags($_POST['detail']),0,150,'utf-8'));
      $arg['c']=intval(trim($_POST['cate']));
      $arg['pl']=($_POST['published']?1:0);
      $ans=[];
      for($i=0;$i<count($_POST['ans_id']);$i++)
      {
        $ans_t=trim(mb_substr(strip_tags($_POST['ans_t'][$i]),0,100,'utf-8'));
        $ans_d=trim(mb_substr(strip_tags($_POST['ans_d'][$i]),0,500,'utf-8'));
        if(!$ans_t&&!$ans_d)
        {
          $error['answer']='กรุณากรอกผลลัพธ์ให้ครบถ่วน';
        }

        $ans[]=[
                't'=>$ans_t,
                'd'=>$ans_d,
                'i'=>($app['ans']&&$app['ans'][$i]&&$app['ans'][$i]['i'])?$app['ans'][$i]['i']:''
        ];
      }
      $arg['ans']=$ans;


      $quest=[];
      $no=count($_POST['ans_id']);
      for($i=0;$i<count($_POST['quest_id']);$i++)
      {
        $quest_t=trim(mb_substr(strip_tags($_POST['quest_t'][$i]),0,100,'utf-8'));
        $a1=$i*$no;
        $a2=$a1+$no;
        $quest_a=[];
        $ca=0;
        $cb=0;
        for($j=$a1;$j<$a2;$j++)
        {
          if($qa=trim(mb_substr(strip_tags($_POST['quest_a'][$j]),0,500,'utf-8')))
          {
            $ca++;
          }
          $quest_a[]=['id'=>$cb,'t'=>strval($qa)];
          $cb++;
        }
        $quest[]=[
                      't'=>$quest_t,
                      'a'=>$quest_a
        ];
        if($ca!=$no)
        {
          $error['qans']='กรุณากรอกคำตอบของคำถามให้ครบทุกช่อง';
        }
        if(!$quest_t)
        {
          $error['quest']='กรุณากรอกคำถามให้ครบถ่วน';
        }
      }
      $arg['quest']=$quest;

      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อเกม';
      }
      if(!$arg['d'])
      {
        $error['detail']='กรุณากรอกคำอธิบายของเกม';
      }
      if((!$arg['c'])||!isset($cate[$arg['c']]))
      {
        $error['cate']='กรุณาเลือกหมวด';
      }
      if(count($arg['ans'])<2)
      {
        $error['answer']='กรุณากรอกผลลัพธ์ให้ครบถ้วนอย่างน้อย 2 ข้อ';
      }
      if(count($arg['quest'])<1)
      {
        $error['question']='กรุณากรอกคำถามให้ครบถ้วนอย่างน้อย 1 ข้อ';
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
          if($id=$db->insert('guess',$arg))
          {
            $app=$arg;
            $app['_id']=$id;
            $fd=Load::Folder()->fd($id);
            $app['fd']=substr($fd,2,2).'/'.substr($fd,4,2);
            $db->update('guess',['_id'=>$id],['$set'=>['fd'=>$app['fd']]]);
          }
        }
        else
        {
          $id=$app['_id'];
          $db->update('guess',['_id'=>$id],['$set'=>$arg]);
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
              if($size[0]>=100 && $size[1]>=100)
              {
                $q=Load::Upload()->post('s3','guess-post','@'.$f,['folder'=>$app['fd']]);
                if($q['status']=='OK')
                {
                  $db->update('guess',['_id'=>$app['_id']],['$set'=>['img'=>$q['data']['n']]]);
                }
              }
          }
        }

        $tm=time();
        for($i=0;$i<count($_POST['ans_id']);$i++)
        {
          if(empty($_POST['ans_del'][$i]) && ($f=$_FILES['ans_i']['tmp_name'][$i]))
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
                if($size[0]>=100 && $size[1]>=100)
                {
                  if($arg['ans']&&$arg['ans'][$i]&&$arg['ans'][$i]['i'])
                  {
                    $q=Load::Upload()->post('s3','delete','guess/'.$app['fd'].'/'.$arg['ans'][$i]['i']);
                  }

                  $q=Load::Upload()->post('s3','guess-answer','@'.$f,['folder'=>$app['fd'],'name'=>$tm.'-'.$i]);
                  if($q['status']=='OK')
                  {
                    $db->update('guess',['_id'=>$app['_id']],['$set'=>['ans.'.$i.'.i'=>$q['data']['n']]]);
                  }
                }
            }
          }
        }
        for($i=0;$i<count($_POST['ans_del']);$i++)
        {
          if($_POST['ans_del'][$i]!='')
          {
            if($app['ans'][$_POST['ans_del'][$i]])
            {
              if($app['ans'][$_POST['ans_del'][$i]]['i'])
              {
                $q=Load::Upload()->post('s3','delete','guess/'.$app['fd'].'/'.$app['ans'][$_POST['ans_del'][$i]]['i']);
                $db->update('guess',['_id'=>$app['_id']],['$unset'=>['ans.'.$_POST['ans_del'][$i]=>1]]);
                $db->update('guess',['_id'=>$app['_id']],['$pull'=>['ans'=>NULL]]);
              }
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

    Load::$core->data['content']=Load::$core
      ->assign('app',$app)
      ->assign('error',$error)
      ->fetch('manage.view');
  }

  public function getapp($page=1)
  {
    $rows = 30;
    $allorder = ['_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ'];
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    $all=['order','by','search','page'];

    extract(Load::Split()->get('/manage/',0,$all,$allorder,$allby));

    $arg = ['u'=>Load::$my['_id'],'dd'=>['$exists'=>false]];
    if(Load::$my['_id']==1)
    {
      unset($arg['u']);
    }
    if($search)
    {
      $arg['$or']=[['t'=>$q],['m'=>$q]];
    }
    $db=Load::DB();
    if($count=$db->count('guess',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($rows,$count,[$url,'page-'],$page);
      $app=$db->find('guess',$arg,[],['skip'=>$skip,'limit'=>$rows,'sort'=>[$order=>($by=='desc'?-1:1)]]);
    }
    Load::$core->assign(['app'=>$app,'pager'=>$pg,'count'=>number_format($count),'allby'=>$allby,'allorder'=>$allorder]);
    for($i=0;$i<count($all);$i++)if(${$all[$i]}) Load::$core->assign($all[$i],${$all[$i]});
    return Load::$core->fetch('guess/manage.home.list');
  }

  public function newapp($arg)
  {
    $db=Load::DB();
    if(trim($arg['title']))
    {
      if($guess=$db->insert('guess',['uid'=>Load::$my['_id'],'do'=>0,'t'=>mb_substr(trim($arg['title']),0,100,'utf-8'),'ty'=>trim($arg['type'])]))
      {
        $fd = Load::Folder()->fd($guess);
        $folder = substr($fd,2,2).'/'.substr($fd,4,2);
        $db->update('guess',['_id'=>$guess],['$set'=>['fd'=>substr($fd,2,2).'/'.substr($fd,4,2)]]);
        Load::Ajax()->redirect('/manage/'.$guess);
      }
    }
  }

  public function delapp($i)
  {
    $db=Load::DB();
    $arg=['u'=>Load::$my['_id'],'_id'=>intval($i)];
    if(Load::$my['_id']==1)
    {
      unset($arg['u']);
    }
    if($var=$db->findOne('guess',$arg))
    {
      $db->update('guess',['_id'=>$var['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
    //	Load::$core->delete('social','app-fb-'.md5(trim(strtolower($var['l']))),0);
    }
    Load::Ajax()->jquery('#getapp','html',getapp());
  }
}
?>
