<?php
namespace Jarm\Core;
class Ajax
{
  protected static $x=['f'=>[]];
  public $jsonp=false;
  public $arg=[];
  public $loaded=false;
  public function __construct()
  {
    $this->jsonp=(isset($_GET['callback'])&&isset($_GET['ajax']))?$_GET['callback']:'';
    $this->arg=($this->jsonp?$_GET:$_POST);
  }
  public function register($func,$cls=null): void
  {
    if(!isset($this->arg['ajax']))return;
    if(is_array($func))
    {
      foreach($func as $f)
      {
        $this->register($f,$cls);
      }
    }
    else
    {
      if(isset($this->arg['ajax']) && $this->arg['ajax']==$func)
      {
        $this->loaded=true;
        $arg=$this->arg["ajaxargs"];
        if(!is_array($arg))$arg=[];
        if(is_object($cls)&&method_exists($cls,$func))
        {
          call_user_func_array([$cls,$func],$arg);
        }
        elseif(method_exists(Load::$app,$func))
        {
          call_user_func_array([Load::$app,$func],$arg);
        }
        else
        {
          $this->alert("Function not Found: ". $func);
        }
        while (@ob_end_clean());
        echo $this->get();
        exit;
      }
    }
  }
  public function alert(string $v): ajax
  {
    self::$x['f'][]=["a"=>"al",'v'=>$v];
    return $this;
  }
  public function redirect($u): ajax
  {
    self::$x['f'][]=["a"=>"js",'v'=>'window.location.href="'.Load::uri($u).'";'];
    return $this;
  }
  public function html(string $t,string $k,string $v): ajax
  {
    self::$x['f'][]=["a"=>"ht","s"=>$t,'v'=>$k];
    self::$x['f'][]=["a"=>"ml","s"=>$t,'v'=>$v];
    return $this;
  }
  public function script(string $v): ajax
  {
    self::$x['f'][]=["a"=>"js",'v'=>$v];
    return $this;
  }
  public function jquery(string $s,string $p,string $v='')
  {
    self::$x['f'][]=['a'=>'$','s'=>$s,'p'=>$p,'v'=>$v];
    return $this;
  }
  public function get(): void
  {
    while(@ob_end_clean());
    header('Content-type: application/json');
    echo ($this->jsonp?$this->jsonp.'('.json_encode(self::$x).')':json_encode(self::$x));
    exit;
  }
}
?>
