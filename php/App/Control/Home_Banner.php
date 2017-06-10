<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Home_Banner extends Service
{
  public function _home_banner()
  {
    $access=$this->check_perm('home-banner',1);
    $position=['img'=>'TALK OF THE TOWN','bottom'=>'เรื่องเด่น ประเด็นร้อน'];
    Load::$core->assign('position',$position);
    $path=(Load::$path[1]??'');
    if(is_numeric($path))
    {
      if($access)
      {
        $db=Load::DB();
        if(!$banner=$db->findone('banner',['_id'=>intval($path),'dd'=>['$exists'=>false]]))
        {
          Load::move('/home-banner');
        }
        $error=[];
        if($_POST)
        {
          $arg=[];
          $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
          $arg['d']=stripslashes(trim($_POST['detail']));
          $arg['l']=trim($_POST['link']);
          $arg['so']=intval(trim($_POST['sort']));
          $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);
          if(!$arg['t'])
          {
            $error['title']='กรุณากรอกชื่อข่าว';
          }
          if(!count($error))
          {
            if(!$banner['fd'])
            {
              $fd = Load::Folder()->fd($banner['_id']);
              $banner['fd'] = $arg['fd'] = substr($fd,2,2).'/'.substr($fd,4,2);
            }
            $db->update('banner',['_id'=>$banner['_id']],['$set'=>$arg]);

            if($f=$_FILES['o']['tmp_name'])
            {
              $size=false;
              if($banner['p']=='img')
              {
                $size=[645,430];
              }
              if($banner['p']=='bottom')
              {
                $size=[330,220];
              }
              $q=Load::Upload()->post('f2','banner-upload','@'.$f,['name'=>$banner['_id'],'folder'=>$banner['fd'],'size'=>$size]);
              if($q['status']=='OK')
              {
                if($q['data']['n'])
                {
                  $banner['s']=$q['data']['n'];
                  $db->update('banner',['_id'=>$banner['_id']],['$set'=>['s'=>$q['data']['n'],'ex'=>$q['data']['ex'],'w'=>$q['data']['w'],'h'=>$q['data']['h']]]);
                }
              }
              else
              {
                $serv='f2';
                $method='banner-upload';
                $file='@'.$f;
                $data=['name'=>$banner['_id'],'folder'=>$banner['fd'],'size'=>$size];
                $serv = Load::getServ($serv);
                if(isset(Load::$conf['server']['files'][$serv]))
                {
                  $tmp=json_encode($data);
                  $key=md5($method.'-'.$tmp);
                  if(substr($file,0,1)=='@')
                  {
                    $file=new \CurlFile(substr($file,1));
                  }
                  echo '--'.'http://'.Load::$conf['server']['files'][$serv].':81/'.$serv.'--<br>';
                  print_r(['key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp]);
                  echo '<br>---<br>';
                  echo $json=Load::Http()->get('http://'.Load::$conf['server']['files'][$serv].':81/'.$serv,['key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp]);
                  exit;
                }
                else
                {
                  print_r(['status'=>'FAIL','message'=>'no server']);
                }
                exit;
              }
            }
            if(empty($banner['s'])&&$arg['pl']>0)
            {
              $db->update('banner',['_id'=>$banner['_id']],['$set'=>['pl'=>0]]);
              Load::move('/home-banner/'.$banner['_id'].'?no-img');
            }
            Load::$core->delete('jarm.com/home');
            Load::move('/home-banner/'.$banner['_id'].'?completed');
          }
        }
        Load::$core->data['content']=Load::$core
          ->assign('banner',$banner)
          ->assign('error',$error)
          ->assign('access',$access)
          ->fetch('control/home-banner.update');
      }
      else
      {
        Load::move('/home-banner');
      }
    }
    elseif($path=='stats')
    {
      $db=Load::DB();
      if(!$banner=$db->findone('banner',['_id'=>intval($path),'dd'=>['$exists'=>false]]))
      {
        Load::move('/banner');
      }
      $last=$db->find('banner_click',['b'=>$banner['_id']],[],['sort'=>['_id'=>-1],'limit'=>100]);
      Load::$core
        ->assign('banner',$banner)
        ->assign('last',$last);

      $mn=['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
      /*
      $stats = $db->group('banner_click',['kd'=>1], ['kd'=>'','c'=>0], "function(obj, prev) { prev.kd=obj.kd; prev.c++; }",
        [
          'condition'=>[
            'da'=>['$gte'=>Load::Time()->now(-3600*24*31)],
            'b'=>$banner['_id'],
           ]
        ]
      );
      */
      $stats = $db->aggregate('banner_click',[
        ['$match'=>['da'=>['$gte'=>Load::Time()->now(-3600*24*31)],'b'=>$banner['_id']]],
        ['$group'=>['_id'=>'$kd', 'c'=>['$sum'=>1],'da'=>['$max'=>'$da']]],
    //		['$sort'=>['c'=>-1]],
      ]);

      $k=[['']];
      $a = $x = [[0,'']];
      $sa = $su = $sv = 0;
      for($i=0;$i<count($stats);$i++)
      {
        $_a = intval($stats[$i]['c']);
        $sa += $_a;
        $a[]=[$i+1,$_a];
        $k[]=$stats[$i]['kd'];
        $e = explode('-',$stats[$i]['kd']);
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
        ->fetch('control/home-banner.stats');
    }
    else
    {
      if($access)
      {
        Load::Ajax()->register(['newhome_banner','delhome_banner'],$this);
      }
      $db=Load::DB();
      extract(Load::Split()->get('/home-banner/',1,['page']));

      $arg = ['dd'=>['$exists'=>false],'ty'=>'home'];

      if(in_array($path,['img','text','bottom']))
      {
        $arg['p']=$path;
      }
      if($count=$db->count('banner',$arg))
      {
        $banner=$db->find('banner',$arg,[],['sort'=>['da'=>-1]]);
      }
      Load::$core->data['content']=Load::$core
        ->assign('count',$count)
        ->assign('banner',$banner)
        ->assign('access',$access)
      //  ->assign('pager',$pg)
        ->fetch('control/home-banner.home');
    }
  }

  public function delhome_banner($i)
  {
    $db=Load::DB();
    if($banner=$db->findone('banner',['_id'=>intval($i),'dd'=>['$exists'=>false]]))
    {
      $db->update('banner',['_id'=>intval($i)],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::Ajax()->alert('ลบเรียบร้อยแล้ว.');
      Load::Ajax()->script('$(".bn'.$i.'").remove();');
      //Load::Ajax()->redirect('/home-banner');
    }
    else
    {
      Load::Ajax()->redirect(URL);
    }
  }

  public function newhome_banner($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if(!$arg['title'])
    {
      $ajax->alert('กรุณากรอกชื่อข่าว');
    }
    elseif(!$arg['position'])
    {
      $ajax->alert('กรุณาเลือกตำแหน่งการแสดงผล');
    }
    else
    {
      $_=[
        't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
        'ty'=>'home',
        'p'=>$arg['position'],
        'u'=>Load::$my['_id'],
        'so'=>99
      ];

      if($id=$db->insert('banner',$_))
      {
        $fd = Load::Folder()->fd($id);
        $db->update('banner',['_id'=>$id],['$set'=>['fd'=>substr($fd,2,2).'/'.substr($fd,4,2)]]);
        $ajax->redirect('/home-banner/'.$id);
      }
      else
      {
        $ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
      }
    }
  }
}
?>
