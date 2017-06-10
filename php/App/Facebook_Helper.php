<?php
namespace Jarm\App;
use Jarm\Core\Load;
use \Facebook\PersistentData\PersistentDataInterface;

class Facebook_Helper implements PersistentDataInterface
{
  protected $prefix='fb_';
  public function get($key)
  {
    if($s=Load::DB()->findone('logs',['ty'=>'fb_login','ip'=>$_SERVER['REMOTE_ADDR'],'key'=>$this->prefix.$key],['val'=>1]))
    {
      return $s['val'];
    }
    return '';
  }
  public function set($key,$val)
  {
    Load::DB()->remove('logs',['ty'=>'fb_login','$or'=>[['ip'=>$_SERVER['REMOTE_ADDR']],['da'=>Load::Time()->now(-3600)]]]);
    if($val)
    {
      Load::DB()->insert('logs',['ty'=>'fb_login','ip'=>$_SERVER['REMOTE_ADDR'],'key'=>$this->prefix.$key,'val'=>$val]);
    }
  }
}
?>
