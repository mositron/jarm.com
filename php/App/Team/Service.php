<?php
namespace Jarm\App\Team;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'',
      'description'=>'',
      'keywords'=>'',
    ]);
  }
}
?>
