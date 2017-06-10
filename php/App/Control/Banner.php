<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Banner extends Service
{

  public function check_perm_ads()
  {
    if(!Load::$my)
    {

    }
    elseif(Load::$my['am']>=9)
    {
      return true;
    }
    elseif(in_array(Load::$my['_id'],[247228,177679]))
    {
      /*
      247228 - มี่
      177679 - พลอย
      */
      return true;
    }
    return false;
  }

  public function _banner()
  {
    $access=$this->check_perm_ads();
    $position=[
      'car'=>['t'=>'autocar.in.th - Car','l'=>['a','b','c','d','e','f','h','i','b1','b2']],
    ];
    Load::$core->assign('position',$position);
    $path=(Load::$path[1]??'');
    if(is_numeric($path))
    {
      if($access)
      {
        $db=Load::DB();
        if(!$banner=$db->findone('banner',['_id'=>intval($path),'dd'=>['$exists'=>false]]))
        {
          Load::move('/banner');
        }
        $error=[];
        if($_POST)
        {
          $arg=[];
          $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
          $arg['d']=stripslashes(trim($_POST['detail']));
          $arg['l']=trim($_POST['link']);
          $arg['so']=intval(trim($_POST['sort']));
          $arg['tyc']=($_POST['type']?1:0);
          $arg['code']=trim($_POST['code']);
          $arg['dt1']=Load::Time()->from(trim($_POST['date1']).' 00:00:00');
          $arg['dt2']=Load::Time()->from(trim($_POST['date2']).' 23:59:59');
          $arg['p']=$_POST['position'];
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
              $q=Load::Upload()->post('s2','banner-upload','@'.$f,['name'=>$banner['_id'],'folder'=>$banner['fd']]);
              if($q['status']=='OK')
              {
                if($q['data']['n'])
                {
                  $db->update('banner',['_id'=>$banner['_id']],['$set'=>['s'=>$q['data']['n'],'ex'=>$q['data']['ex'],'w'=>$q['data']['w'],'h'=>$q['data']['h']]]);
                }
              }
            }
            Load::move('/banner/'.$banner['_id'].'?completed');
          }
        }
        Load::$core->data['content']=Load::$core
          ->assign('banner',$banner)
          ->assign('error',$error)
          ->assign('access',$access)
          ->fetch('control/banner.update');
      }
      else
      {
        Load::move('/banner');
      }
    }
    elseif($path=='stats')
    {
      $db=Load::DB();
      if(!$banner=$db->findone('banner',['_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false]]))
      {
        Load::move('/banner');
      }
      $last=$db->find('banner_click',['b'=>$banner['_id']],[],['sort'=>['_id'=>-1],'limit'=>100]);
      Load::$core->assign('banner',$banner)
        ->assign('last',$last);
      $mn=['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
      $stats = $db->aggregate('banner_click',[
        ['$match'=>['da'=>['$gte'=>Load::Time()->now(-3600*24*31)],'b'=>$banner['_id']]],
        ['$group'=>['_id'=>'$kd', 'c'=>['$sum'=>1],'da'=>['$max'=>'$da']]],
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
        ->fetch('control/banner.stats');
    }
    else
    {
      if($access)
      {
        Load::Ajax()->register(['newbanner','delbanner','setads']);
      }
      $db=Load::DB();
      $allorder=['t'=>'ชื่อแบนเนอร์','dt1'=>'เริ่มแสดง','dt2'=>'จบแสดง','do'=>'คลิก'];
      $allby=['asc'=>'1','desc'=>'-1'];
      extract(Load::Split()->get('/banner/',0,['site','page','order','by'],$allorder,$allby));
      $arg = ['dd'=>['$exists'=>false],'ty'=>'ads'];
      if(isset($site)&&isset($position[$site]))
      {
        $arg['p.'.$site]=['$exists'=>true];
      }
      if($count=$db->count('banner',$arg))
      {
        $banner=$db->find('banner',$arg,[],['sort'=>['pl'=>-1,$order=>($by=='desc'?-1:1)]]);
      }
      Load::$core->data['content']=Load::$core
        ->assign('count',$count)
        ->assign('enabled',$db->findone('msg',['_id'=>'ads']))
        ->assign('banner',$banner)
        ->assign('access',$access)
        ->assign('site',$site??'')
        //->assign('pager',$pg)
        ->assign('order',$order)
        ->assign('by',$by)
        ->assign('allorder',$allorder)
        ->fetch('control/banner.home');
    }
  }

  public function delbanner($i)
  {
    $db=Load::DB();
    if($banner=$db->findone('banner',['_id'=>intval($i),'dd'=>['$exists'=>false]]))
    {
      $db->update('banner',['_id'=>$banner['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::Ajax()->alert('ลบโฆษณานี้เรียบร้อยแล้ว');
      Load::Ajax()->script('setTimeout(function(){window.location.href="/banner";},2000);');
    }
    else
    {
      Load::Ajax()->alert('โฆษณานี้ไม่ได้ใช้งาน');
    }
  }

  public function newbanner($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if(!$arg['title'])
    {
      $ajax->alert('กรุณากรอกชื่อข่าว');
    }
    else
    {
      $m=intval(date('m'))+1;
      $dt1=strtotime(date('Y-m-d 00:00:00'));
      $dt2=strtotime(date('Y-'.substr('0'.$m,-2).'-d 23:59:59'));
      $_=[
        't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
        'ty'=>'ads',
      //	'p'=>$arg['position'],
        'u'=>Load::$my['_id'],
        'so'=>99,
        'dt1'=>Load::Time()->from($dt1),
        'dt2'=>Load::Time()->from($dt2),
      ];

      if($id=$db->insert('banner',$_))
      {
        $fd = Load::Folder()->fd($id);
        $db->update('banner',['_id'=>$id],['$set'=>['fd'=>substr($fd,2,2).'/'.substr($fd,4,2)]]);
        $ajax->redirect('/banner/'.$id);
      }
      else
      {
        $ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
      }
    }
  }
}
?>
