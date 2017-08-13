<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Viewmonth
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    Load::move('/report');
  }
}
?>
