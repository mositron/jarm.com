<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class Lotto extends Service
{
  public function get_lotto()
  {
    $N=date('N');
    $G=date('G');

    if($N>5)
    {
      exit;
    }
    if($G<9||$G>22)
    {
      exit;
    }
    $db=Load::DB();
    $month=['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
    //echo 'http://xn--q3cropc2fyf.com/?page=sititi&id=2013';
    $tmp=Load::Http()->get('http://xn--q3cropc2fyf.com/?page=sititi&id=2015');
    $s='<table width="100%" align="center" style="font-weight:bold; ">';
    $i=strpos($tmp,$s);
    if($i>-1)
    {
      $days=[];
      $tmp=substr($tmp,$i);
      $s='</table>';
      $i=strpos($tmp,$s);
      if($i>-1)
      {
        $tmp=substr($tmp,0,$i+strlen($s));
        $c=explode('<tr',$tmp);
        for($i=4;$i<count($c)-1;$i++)
        {
          $day=[];
          //echo $c[$i]."\r\n\r\n";
          $d=explode('</td>',$c[$i]);
          for($j=0;$j<count($d)-1;$j++)
          {
            $x=strrpos($d[$j],'>');
            $day[]=substr($d[$j],$x+1);
          }
          ###################################################
          /*
          print_r($day);
          echo '<br><br>';
          if(preg_match('/^([0-9]{2})\-(.+)\-([0-9]{4})$/i',$day[0],$m))
          {
            $y=array_search($m[2],$month);
            if($y!==false)
            {
              $key=($m[3]-543).'-'.substr('00'.($y+1),-2).'-'.$m[1];
              $tm=strtotime($key.' 00:00:00');
              echo $key.' - '.Load::Time()->from($tm,'date');
              if($db->findone('lotto_set',['ky'=>$key],['_id'=>1]))
              {
                $db->update('lotto_set',['ky'=>$key],['$set'=>[
                  't11'=>$day[1],'t12'=>$day[2],
                  't21'=>$day[3],'t22'=>$day[4],
                  't31'=>$day[5],'t32'=>$day[6],
                  't41'=>$day[7],'t42'=>$day[8]
                ]]);
              }
              else
              {
                $db->insert('lotto_set',[
                  'ky'=>$key,
                  'tm'=>Load::Time()->from($tm),
                  't11'=>$day[1],'t12'=>$day[2],
                  't21'=>$day[3],'t22'=>$day[4],
                  't31'=>$day[5],'t32'=>$day[6],
                  't41'=>$day[7],'t42'=>$day[8]
                ]);
              }
              print_r($day);
            }
          }
          */
          ##################################################

        }

        echo '1<br>';
        if($day)
        {
        echo '2<br>';
          print_r($day);
          if(preg_match('/^([0-9]{2})\-(.+)\-([0-9]{4})$/i',$day[0],$m))
          {
        echo '3<br>';
            $y=array_search(trim($m[2]),$month);
            if($y!==false)
            {
        echo '4<br>';
              $key=($m[3]-543).'-'.substr('00'.($y+1),-2).'-'.$m[1];
              $tm=strtotime($key.' 00:00:00');
              echo $key.' - '.Load::Time()->from($tm,'date');
              if($db->findone('lotto_set',['ky'=>$key],['_id'=>1]))
              {
                $db->update('lotto_set',['ky'=>$key],['$set'=>[
                  't11'=>$day[1],'t12'=>$day[2],
                  't21'=>$day[3],'t22'=>$day[4],
                  't31'=>$day[5],'t32'=>$day[6],
                  't41'=>$day[7],'t42'=>$day[8]
                ]]);
              }
              else
              {
                $db->insert('lotto_set',[
                  'ky'=>$key,
                  'tm'=>Load::Time()->from($tm),
                  't11'=>$day[1],'t12'=>$day[2],
                  't21'=>$day[3],'t22'=>$day[4],
                  't31'=>$day[5],'t32'=>$day[6],
                  't41'=>$day[7],'t42'=>$day[8]
                ]);
              }
              /*
              if(!empty($day[1])&&!empty($day[2])&&!empty($day[3])&&!empty($day[4])&&!empty($day[5])&&!empty($day[6])&&!empty($day[7])&&!empty($day[8]))
              {
                if(!$set=$db->findone('forum',['c'=>192,'u'=>1,'lotto_set'=>$key]))
                {
                  $arg=[];
                  $nday=Load::Time()->day[date('w',$tm)];
                  $arg['t']='หวยหุ้น วิเคราะห์หวยหุ้น เลขเด็ด วัน'.$nday.'ที่ '.$m[1].' '.Load::Time()->month[$y].' '.($m[3]-543);
                  $arg['d']='<p>วิเคราะห์เลขเด็ด หวยหุ้น ประจำวันที่วัน'.$nday.'ที่ '.$m[1].' '.Load::Time()->month[$y].' '.($m[3]-543).'<p>';
                  $arg['d'].='<p>สรุปข้อมูล</p>';

                  if(is_array($cate[$c]['a']))
                  {
                    if($cate[$c]['a']['t'])
                    {
                      if(!isset($_FILES['attach1']) && !$_FILES['attach1']['tmp_name'])
                      {
                        $error['attach']='กรุณาเลือกรูปภาพ';
                      }
                    }

                    if(($f=$cate[$c]['a']['f']) && is_array($f))
                    {
                      foreach($f as $fk=>$fv)
                      {
                        if($fv[2] && !trim(strip_tags($_POST['f_'.$fk])))
                        {
                          $error['f_'.$fk]='กรุณากรอก'.$fv[0];
                        }
                      }
                    }
                  }


                  if(!count($error))
                  {
                    //$arg['d'] = htmlspecialchars($arg['d'], ENT_QUOTES,'utf-8');

                    # remove nofollow for link to jarm.com
                    //$arg['d']=preg_replace('/\<a href\="http\:\/\/([a-z0-9\.]+)?jarm\.com([^"]+)"([^\>]+)?"\>/i','<a href="http://\1jarm.com\2" target="_blank">',$arg['d']);
                    $arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i','checkout_nofollow',$arg['d']);

                    # add title to image(alt)
                    $arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?jarm.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2jarm.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);


                    $home_img=false;
                    $set=[
                      'u'=>Load::$my['_id'],
                      't'=>$arg['t'],
                      'c'=>intval($c),
                      'd'=>$arg['d'],
                      'ds'=>Load::Time()->now(),
                      'ip'=>$_SERVER['REMOTE_ADDR'],
                      'ic'=>max(1,min(14,intval($_POST['icon'])))
                    ];
                    if(Load::$my['am'])
                    {
                      $set['sk']=($_POST['sticky']?1:0);
                      $set['rc']=($_POST['recommend']?1:0);
                      $set['lo']=($_POST['lock']?1:0);

                      if($_POST['sethome'] && $option && $option['home'] && $option['home'][$_POST['sethome']])
                      {
                        $_ho=$option['home'][$_POST['sethome']];
                        if($_ho['i'])
                        {
                          $home_img=$_ho['i'];
                        }
                        $set['ho']=[$_POST['sethome']=>Load::Time()->now()];
                      }
                    }
                    else
                    {
                      $set['sk']=0;
                      $set['rc']=0;
                      $set['lo']=0;
                    }

                    if($id=$db->insert('forum',$set))
                    {
                    }
                }
              }
              */
              print_r($day);
            }
          }
        }


      }
    }

    $tmp=Load::Http()->get('http://www.settrade.com/C07_GraphIntraday.jsp?symbolType=i&indexName=SET');


    //<div style="width:720px;margin:0px auto;">
    $s='<div style="width:720px;margin:0px auto;">';
    $i=strpos($tmp,$s);
    if($i>-1)
    {
      $tmp=substr($tmp,$i);
      $s='<div style="width:750px;">';
      $i=strpos($tmp,$s);
      if($i>-1)
      {
        $tmp=substr($tmp,0,$i+strlen($s));

        $a=explode('<div class="fl',$tmp);
        $lot=[];
        for($i=1;$i<count($a);$i++)
        {
          echo $a[$i]."\r\n\r\n";
          $j=strpos($a[$i],'">');
          $b=substr($a[$i],$j+2);
          $j=strpos($b,'</div>');
          $lot[]=trim(substr($b,0,$j));
        }
        $db->update('msg',['_id'=>'lotto_set'],['$set'=>['msg'=>$lot,'tm'=>Load::Time()->now()]]);

        $mn=intval(date('i'));
        if(($G==12&&$mn>=40)||($G==13&&$mn<=50))
        {
          $q1=explode('.',$lot[1]);
          $q2=explode('.',$lot[2]);
          $key=date('Y-m-d');
          $tm=strtotime($key.' 00:00:00');
          echo $key.' - '.Load::Time()->from($tm,'date');
          if($db->findone('lotto_set',['ky'=>$key],['_id'=>1]))
          {
            $db->update('lotto_set',['ky'=>$key],['$set'=>['t21'=>$q1[1],'t22'=>$q2[1]]]);
          }
          else
          {
            $db->insert('lotto_set',[
              'ky'=>$key,
              'tm'=>Load::Time()->from($tm),
              't21'=>$q1[1],'t22'=>$q2[1],
            ]);
          }
        }
        elseif($G>=17)
        {
          $q1=explode('.',$lot[1]);
          $q2=explode('.',$lot[2]);
          $key=date('Y-m-d');
          $tm=strtotime($key.' 00:00:00');
          echo $key.' - '.Load::Time()->from($tm,'date');
          if($db->findone('lotto_set',['ky'=>$key],['_id'=>1]))
          {
            $db->update('lotto_set',['ky'=>$key],['$set'=>['t41'=>$q1[1],'t42'=>$q2[1]]]);
          }
          else
          {
            $db->insert('lotto_set',[
              'ky'=>$key,
              'tm'=>Load::Time()->from($tm),
              't41'=>$q1[1],'t42'=>$q2[1],
            ]);
          }
        }
      }
    }
    //	$db->update('weather',['_id'=>$weather['_id']],['$set'=>['du'=>Load::Time()->now()]]);
  }
}
?>
