<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class Click extends Service
{
  public function get_click()
  {
    if($b=$_GET['__b'])
    {
      $data=json_decode(base64_decode(strtr($b,'-_','+/')),true);
      if($id=intval($data['i']))
      {
        # /impression/[id]/[DATE:d]/[DATE:H]/[RAND:0-999].txt
        $file = 'bin/ads-click/'.$id.'/'.date('Y-m-d').'/'.date('H').'/'.substr('0000'.rand(1,100),-4).'.txt';
        if(file_exists(_FILES.$file))
        {
          $log = unserialize(file_get_contents(_FILES.$file));
        }
        else
        {
          $log = ['mb'=>0,'tb'=>0,'rb'=>0,'fb'=>0,'aol'=>0,'do'=>0,'pc'=>0];
        }

        $browser = new \Browser();
        // Browser
        $_bs=str_replace([' ','.'],'_',mb_strtolower($browser->getBrowser(),'utf-8'));
        if($log['bs_'.$_bs])
        {
          $log['bs_'.$_bs]++;
        }
        else
        {
          $log['bs_'.$_bs]=1;
        }
        // Platform
        $_pf=str_replace([' ','.'],'_',mb_strtolower($browser->getPlatform(),'utf-8'));
        if($log['pf_'.$_pf])
        {
          $log['pf_'.$_pf]++;
        }
        else
        {
          $log['pf_'.$_pf]=1;
        }
        // isMobile
        if($browser->isMobile())
        {
          $log['mb']++;
          define('NOTPC',true);
        }
        // isTablet
        if($browser->isTablet())
        {
          $log['tb']++;
          define('NOTPC',true);
        }
        // isRobot
        if($browser->isRobot())
        {
          $log['rb']++;
          define('NOTPC',true);
          define('NOTINC',true);
        }
        // isFacebook
        if($browser->isFacebook())
        {
          $log['fb']++;
          define('NOTPC',true);
          //define('NOTINC',true);
        }
        //isAol
        if($browser->isAol())
        {
          $log['aol']++;
          define('NOTPC',true);
          //define('NOTINC',true);
        }

        $domain=strtolower(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST));
        if(strpos($domain,'jarm.com')>-1||strpos($domain,'boxzaracing.com')>-1||strpos($domain,'autocar.in.th')>-1||strpos($domain,'teededball.com')>-1)
        {
          $dm='dm_'.str_replace('.','_',$domain);
          if($log[$dm])
          {
            $log[$dm]++;
          }
          else
          {
            $log[$dm]=1;
          }
        }

        if(!defined('NOTINC'))
        {
          $log['do']++;
        }
        if(!defined('NOTPC'))
        {
          $log['pc']++;
        }
        Load::Folder()->save($file,serialize($log));
        Load::move(str_replace('[rnd]',time(),$data['l']),false);
      }
      else
      {
        Load::move(['ads','/?error=invalid-ads-id'],false);
      }
    }
  }
}

?>
