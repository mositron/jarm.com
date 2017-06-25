<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Live extends Service
{
  public function get_live()
  {
    $page=[
      'jarm'=>['t'=>'Jarm.com - จาม.com','id'=>'229722963822965'],
      'racing'=>['t'=>'BoxZa Racing','id'=>'130579630466464']
    ];
    $type=[
      'like'=>'Like - นับจำนวนถูกใจ',
      'comment'=>'Comment - แสดงคอมเมนท์ล่าสุด 1 ครั้ง',
      'note'=>'Note - แสดงคอมเมนท์ล่าสุด วนไปเรื่อยๆ',
      'slide'=>'Slide - รูปภาพวิ่งจากขวาไปซ้าย',
      'lotto'=>'Lottery - สลากกินแบ่งรัฐบาลงวดล่าสุด',
    ];
    $like=[
      'like'=>'like',
      'love'=>'love',
      'haha'=>'haha',
      'wow'=>'wow',
      'sad'=>'sad',
      'angry'=>'angry',
    ];
    $csv=[
      'csv_comment'=>'CSV - คอมเมนท์ทั้งหมด',
      'csv_like'=>'CSV - ถูกใจทั้งหมด',
    ];
    $postid='1168325759962676';
    // '229722963822965_xxxxxxxxxxxxxxx';   - Jarm.com - จาม.com
    // '130579630466464_xxxxxxxxxxxxxxx'    - BoxZa Racing];
    $access=Load::$conf['live']['token'];
    Load::$core
      ->assign('page',$page)
      ->assign('type',$type)
      ->assign('like',$like)
      ->assign('postid',$postid)
      ->assign('access',$access);
    if(isset(Load::$path[1]))
    {
      $url=urldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
      Load::$path=array_values(array_filter(explode('/',substr($url,strlen('/')))));

      list($type,$e)=explode('-',Load::$path[1],2);
      $like=explode('-',$e);
      $page=Load::$path[2];
      $post=Load::$path[3];
      $access=Load::$path[4];
      echo Load::$core
        ->assign('like',$like)
        ->assign('page',$page)
        ->assign('post',$post)
        ->assign('access',$access)
        ->fetch('control/live.'.$type);
      exit;
    }
    elseif(isset($csv[Load::$path[1]]))
    {
      $this->{Load::$path[1]}();
    }
    else
    {
      Load::Session()->logged();
      if(!Load::$my['am'])
      {
        echo '<h1>ไม่มีสิทธิ์ใช้งานส่วนนี้ - <small>('.(Load::$my?'ไม่ใช่ผู้ดูแล':'ยังไม่ได้เข้าระบบ').')</small></h1>';
        exit;
      }
      return Load::$core->fetch('control/live.home');
    }
  }

  public function csv_comment()
  {
    $url=urldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
    Load::$path=array_values(array_filter(explode('/',substr($url,strlen('/')))));
    list($type,$e)=explode('-',Load::$path[1],2);
    $like=explode('-',$e);
    $page=Load::$path[2];
    $post=Load::$path[3];
    $access=Load::$path[4];
  }
}
?>
