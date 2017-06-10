<?php
namespace Jarm\App\Chat;
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
