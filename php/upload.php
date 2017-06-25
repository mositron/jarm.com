<?php
/*
+ ----------------------------------------------------------------------------+
|     Jarm - for PHP 7.1
|
|     https://jarm.com
|     positron@jarm.comm
|
|     $Revision: 3.0.4 $
|     $Date: 2017/06/25 19:58:00 $
|     $Author: Positron $
+-----------------------------------------------------------------------------+
*/
// set start time
define('START',microtime(true));

//Global Constant
define('ROOT',realpath('../').'/');
define('_PHP',ROOT.'php/');
define('_FILES',ROOT.'files/');
define('__APP',_PHP.'App/');
define('__CONF',_PHP.'Conf/');
define('__CORE',_PHP.'Core/');
define('__TPL',_PHP.'Tpl/');

/**
 * แสดงข้อผิดพลาดทั้งหมด
 * เฉพาะตอนพัฒาน
*/
error_reporting(E_ALL & ~E_NOTICE);

/**
 * แสดงข้อผิดพลาดที่สำคัญ ให้ละเอียดยิ่งขึ้น เพื่อง่ายต่อการไล่แก้ไข
 * E_ALL & ~E_NOTICE
*/
set_error_handler(function($no,$str,$file,$line){
  #debug_print_backtrace();
  while(@ob_end_clean());
  header('Content-type: application/json');
  echo json_encode(['status'=>'FAIL',
  'message'=>'<strong>Jarm Engine - เกิดข้อผิดพลาด!</strong><br>
    [ domain: '.$_SERVER['HTTP_HOST'].' ]<br>
    [ no: '.$no.' ]<br>
    [ msg: '.str_replace(ROOT,'/',$str).' ]<br>
    [ line: '.$line.' in '.str_replace(ROOT,'/',$file).' ]<br>
    [ server: '.$_SERVER['SERVER_ADDR'].' ]'
  ]);
  exit;
},E_ALL & ~E_NOTICE);

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

#
Jarm\Core\Load::Init([])
  ->run(['upload'=>[]]);

?>
