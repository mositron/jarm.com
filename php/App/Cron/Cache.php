<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class Cache extends Service
{
  public function get_cache()
  {
    for($i=0;$i<3;$i++)
    {
      Load::$core->clean('',true,'jarm.com');
      sleep(3);
    }
    echo 'OK';
  }
}
?>
