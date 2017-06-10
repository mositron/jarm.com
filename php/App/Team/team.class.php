<?php

class team
{
	private static $h;
	public static $type='www';
	public static $content;
	public static $my;
  public static $p=[];

	public static function __callStatic($c,$n)
	{
		$_ = !empty($n)?md5(serialize($n)):'default';
		if(empty(self::$h[$c.'.'.$_]))
		{
			require_once(__DIR__.'/team.'.$c.'.php');
			try
			{
				self::$h[$c.'.'.$_] = (new ReflectionClass('team_'.$c))->newInstanceArgs($n);
			}
			catch(Exception $e)
			{
				var_dump($e->getMessage());
				exit;
			}
		}
		return self::$h[$c.'.'.$_];
	}

  public static function move($u,$m=false)
  {
    while(@ob_end_clean());
    $ajax=Load::Ajax();
    if($ajax->loaded)
    {
      $ajax->script('_getdata("'.$u.'",true)')->get();
    }
    elseif(defined('HASH'))
    {
      header('Content-type: application/json');
      echo json_encode(['redirect'=>$u]);
    }
    else
    {
      header('Location: '.$u);
    }
    exit;
  }
}

?>
