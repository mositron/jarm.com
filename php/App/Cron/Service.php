<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  /*
  '' => 'home',
  'home' => 'home',
  'music'=>'music',
  'weather'=>'weather',
  'lotto'=>'lotto',
  'oil'=>'oil',
  'gold'=>'gold',
  'facebook'=>'facebook',
  'fbimage'=>'fbimage',
  'fbnews'=>'fbnews',
  'tv'=>'tv',
  'ads-hour'=>'ads-hour',
  'news-hour'=>'news-hour',
  'luckysim'=>'luckysim',
  'movie'=>'movie',
  'trend'=>'trend',
  'cache'=>'cache',
  */
  public function __construct()
  {
    if($_GET['key']!=Load::$conf['cron']['key'])
    {
      echo 'invalid Key';
      exit;
    }
  }
}
?>
