<?php
/*
+ ----------------------------------------------------------------------------+
|     Jarm - for PHP 7.1
|
|     https://jarmza.com
|     positron@jarmza.com
|
|     $Revision: 3.1.1 $
|     $Date: 2017/08/19 15:52:00 $
|     $Author: Positron $
+-----------------------------------------------------------------------------+
*/
// set start time
define('START',microtime(true));

// use gzip compression
if(!ob_start("ob_gzhandler"))
{
  ob_start();
}

// check user-agent
if(empty(trim($_SERVER['HTTP_USER_AGENT'])))
{
  exit;
}

$url=urldecode(parse_url(strtolower($_SERVER['REQUEST_URI']),PHP_URL_PATH));
$path=array_values(array_filter(explode('/',trim($url,'/'))));
if($path[0]!='view'&&!is_numeric($path[1]))
{
  while(@ob_end_clean());
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: https://'.str_replace('jarmza.com','jarm.com',strtolower($_SERVER['HTTP_HOST'])).'/'.implode('/',$path));
  exit;
}
//Global Constant
define('ROOT',realpath('../').'/');
define('_PHP',ROOT.'php/');
define('_FILES',ROOT.'files/');
define('__APP',_PHP.'App/');
define('__CONF',_PHP.'Conf/');
define('__CORE',_PHP.'Core/');
define('__TPL',_PHP.'Tpl/');

//Reponse to html
header('Content-type: text/html; charset=utf-8');

/**
 * แสดงข้อผิดพลาดทั้งหมด
 * เฉพาะตอนพัฒนา
 * E_ALL
*/
error_reporting(E_ALL & ~E_NOTICE);

/**
 * แสดงข้อผิดพลาดที่สำคัญ ให้ละเอียดยิ่งขึ้น เพื่อง่ายต่อการไล่แก้ไข
 * E_ALL & ~E_NOTICE
*/
set_error_handler(function($no,$str,$file,$line){
  debug_print_backtrace();
  echo '<strong>Jarm Engine - เกิดข้อผิดพลาด!</strong><br>
    [ domain: '.$_SERVER['HTTP_HOST'].' ]<br>
    [ no: '.$no.' ]<br>
    [ msg: '.str_replace(ROOT,'/',$str).' ]<br>
    [ line: '.$line.' in '.str_replace(ROOT,'/',$file).' ]<br>
    [ server: '.$_SERVER['SERVER_ADDR'].' ]';
  return true;
},E_ALL & ~E_NOTICE);

//Asset
define('FILES_CDN','http://cdn.jarmza.com/');

//Autoload function
spl_autoload_register(function($c)
{
  $cl=[
    'Jarm'=>'',
    'Browser'=>'Vendor/cbschuld/browser.php/lib/Browser',
    'Facebook'=>'Vendor/facebook/graph-sdk/src/Facebook/autoload',
  ];
  list($n,$f)=explode('\\',$c,2);
  if(isset($cl[$n]))
  {
    require_once(_PHP.($cl[$n]?:str_replace('\\','/',$f)).'.php');
  }
});

//Start App.
Jarm\Core\Load::Init([
      //ค่าพื้นฐาน
      'type'=>'website',
      'sitename'=>'jarmza.com',
      'image'=>FILES_CDN.'img/logo-fb.png',
      'image_type'=>'image/png',
      'nav-header'=>'<ul><li><a href="https://news.jarmza.com/">ข่าววันนี้</a></li><li><a href="https://ent.jarmza.com/">ข่าวบันเทิง</a></li><li><a href="https://korea.jarmza.com/">ข่าวเกาหลี</a></li><li><a href="https://lotto.jarmza.com/">ตรวจหวย</a></li><li><a href="https://music.jarmza.com/">เพลงใหม่</a></li><li><a href="https://movie.jarmza.com/">หนังใหม่</a></li><li><a href="https://beauty.jarmza.com/">ผู้หญิง</a></li><li><a href="https://knowledge.jarmza.com/">เกร็ดความรู้</a></li><li><a href="https://eat.jarmza.com/">อาหาร</a></li><li><a href="https://english.jarmza.com/">ฝึกคำศัพท์ภาษาอังกฤษ</a></li></ul>',
      'feed'=>['title'=>'ข่าววันนี้','url'=>'https://feed.jarmza.com/news/rss'],
      'login'=>1,
      'content'=>'',
      'img_cache'=>true,
      'div_row'=>true,
      'sc-bottom'=>true,
  ])
  ->route([
    /**
    * ค่าเริ่มต้น:
    * - $key.app = $key (หากไม่กำหนด จะเรียกใช้ app ชื่อเดียวกับ $key [sub domain])
    * - $key.enable = true  (เปิดใช้งานโดยอัตโนมัติ ถ้ามีไฟล์ชื่อเดียวกับ app อยู่)
    * - $key.func = [first-path] (เรียกใช้ method พื้นฐาน ในกรณีที่ App ไม่มี method ที่ชื่อเดียวกับ _[first-path] )
    */
    'asiangames'=>['app'=>'news','arg'=>['cate'=>25]],
    'beauty'=>['app'=>'news','arg'=>['cate'=>27,'hot'=>31]],
    'boyz'=>['enable'=>false],
    'chat'=>['enable'=>false],
    'code'=>['app'=>'ads'],
    'eat'=>['app'=>'news','arg'=>['cate'=>32,'hot'=>31]],
    'ent'=>['app'=>'news','arg'=>['cate'=>4,'hot'=>3]],
    'feed'=>['func'=>'data'],
    'friend'=>['enable'=>false], //['func'=>'list'],
    'game'=>['app'=>'news','arg'=>['cate'=>2,'hot'=>90]],
    'guess'=>['func'=>'category'],
    'healthy'=>['app'=>'news','arg'=>['cate'=>34,'hot'=>31]],
    'home'=>['app'=>'news','arg'=>['cate'=>33,'hot'=>90]],
    'horo'=>['arg'=>['cate'=>20,'hot'=>90]],
    'knowledge'=>['app'=>'news','arg'=>['cate'=>30,'hot'=>31]],
    'korea'=>['app'=>'news','arg'=>['cate'=>26,'hot'=>5]],
    'lesbian'=>['enable'=>false],
    'live'=>['app'=>'news','arg'=>['cate'=>35,'hot'=>5]],
    'lotto'=>['arg'=>['cate'=>22]],
    'movie'=>['app'=>'news','arg'=>['cate'=>5,'hot'=>31]],
    'music'=>['arg'=>['cate'=>24,'hot'=>31]],
    'my'=>['func'=>'byuser'],
    'pr'=>['app'=>'news','arg'=>['cate'=>28,'hot'=>31]],
    'radio'=>['func'=>'view'],
    'sticker'=>['func'=>'cate'],
    'story'=>['func'=>'byblog'],
    'tech'=>['app'=>'news','arg'=>['cate'=>3,'hot'=>31]],
    'weather'=>['app'=>'news','arg'=>['cate'=>21]],
  ])
  ->run()
  ->exit();

?>
