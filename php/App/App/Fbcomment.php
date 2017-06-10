<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Fbcomment extends Service
{
  public function get_fbcomment()
  {
    $serv=[
      ''=>'json_recent',
      'get_recent_posts'=>'json_recent',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]??'json_recent'}();
    exit;
  }

  public function json_recent()
  {
    $ref=[
      '216748941823775', //ภาพคอมเม้นฮ่าๆ
      '586593644724225', //แจกรูปโพสต์ใต้คอมเม้นเฟสบุ๊ค
      '1376048759290010', //รวมรูปคอมเม้นฮาฮา
    ];

    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'fb'=>['$in'=>$ref]];

    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }
    if($orderby=='views')
    {
      $option=['sort'=>['sh'=>-1],'limit'=>$count];
      $arg['da']=['$gte'=>Load::Time()->now(-3600*24*3)];
    }
    else
    {
      $option=['sort'=>['_id'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];
    }
    $pages=1;
    $image=[];
    $db=Load::DB();

    if($c=$db->count('fbimage2',$arg))
    {
      $tmp=$db->find('fbimage2',$arg,['_id'=>1,'img'=>1,'fb'=>1,'p'=>1,'rp'=>1,'fd'=>1,'n'=>1,'fbid'=>1,'pid'=>1],$option);
      for($i=0;$i<count($tmp);$i++)
      {
        if($tmp[$i]['rp']&&$tmp[$i]['img'])
        {
          $fbid='';
          $fburl = explode('/',$tmp[$i]['img']);
          if(count($fburl)>1)
          {
            $purl = explode('_',$fburl[count($fburl)-1]);
            if (count($purl) > 3)
            {
              $fbid = $purl[count($purl)-4].'_'. $purl[count($purl)-3];
            }
          }
          $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['p'],'fbid'=>$fbid,'pid'=>(string)$tmp[$i]['pid'],'thumbnail'=>str_replace($tmp[$i]['rp'],'/s200x200/',$tmp[$i]['img']),'image'=>str_replace($tmp[$i]['rp'],'/p600x600/',$tmp[$i]['img'])];
        }
        elseif($tmp[$i]['fd']&&$tmp[$i]['n'])
        {
          $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['p'],'fbid'=>(string)$tmp[$i]['fbid'],'pid'=>(string)$tmp[$i]['pid'],'thumbnail'=>'https://s3.jarm.com/fbimage/'.$tmp[$i]['fd'].'/'.$tmp[$i]['n'].'_s.jpg','image'=>'https://s3.jarm.com/fbimage/'.$tmp[$i]['fd'].'/'.$tmp[$i]['n'].'_n.jpg'];
        }
      }
      if($orderby!='views')
      {
        $pages=ceil($c/$count);
      }
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$image
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }
}
?>
