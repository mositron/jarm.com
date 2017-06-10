<?php
namespace Jarm\Core;
class Mcache
{
  private $config;
  private $prefix='';
  public $cache=[];
  public $connected=false;
  public static $count=0;
  public $debug=false;
  public static $query = [];
  public function __construct($key="default")
  {
    $this->config=Load::$conf['cache'];
    $this->prefix=(isset(Load::$conf['cache']['prefix'])?Load::$conf['cache']['prefix']:'');
    if(isset($_GET['debug']))$this->debug=true;
  }
  public function connect(string $host)
  {
    $this->cache[$host] = new Memcache();
    if(!$this->cache[$host]->connect($this->config[$host]['host'], $this->config[$host]['port']))
    {
      die('Error connecting to Cache server ('.$this->config[$host]['host'].')');
    }
  }
  public function __call($func,$var=[])
  {
    $h=$var[0];
    array_shift($var);
    if(!$this->cache[$h])$this->connect($h);
    self::$count++;
    if(in_array($func,['get','set','delete']))
    {
      $var[0]=$this->prefix.$var[0];
    }
    if($this->debug)self::$query[]=print_r($var,true);
    return call_user_func_array([$this->cache[$h],$func],$var);
  }
}
