<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class Impression extends Service
{
  public function get_impression()
  {
    set_time_limit(3);
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if(isset($_GET['key']))
    {
      if(isset($_GET['id']))
      {
        $tmp = banner_id($_GET['id']);
        if($tmp['_id'])
        {
          $this->setimpression($tmp['_id']);
        }
        while(@ob_end_clean());
        header('Content-type: text/javascript');
        if($_GET['inner'])
        {
          if($tmp['script'])
          {
            echo $tmp['script']."\r\n";
          }
          echo '$(\'#'.$_GET['inner'].'\').css({\'display\':\'block\'}).html(\''.str_replace('rnd=[rnd]','rnd='.time(),$tmp['async']).'\');';
        }
        elseif($_GET['outer'])
        {
          if($tmp['script'])
          {
            echo $tmp['script']."\r\n";
          }
          echo '$(\'#'.$_GET['outer'].'\').css({\'display\':\'block\'}).replaceWith(\''.str_replace('rnd=[rnd]','rnd='.time(),$tmp['async']).'\');';
        }
        else
        {
          echo str_replace('rnd=[rnd]','rnd='.time(),$tmp['code']);
        }
      }
      elseif(isset($_GET['slot']))
      {
        $s=explode('-',$_GET['slot']);
        if(count($s)==3)
        {
          if(isset($this->position[$s[0]]))
          {
            if(isset($this->position[$s[0]]['l'][$s[1]]))
            {
              $domain=$this->banner($s[0],$s[1]);
              if(isset($domain[$s[2]]))
              {
                $rnd=0;
                $tmp = $domain[$s[2]];
                if(count($tmp)>1)
                {
                  $rnd = rand(0,count($tmp)*1000) % count($tmp);
                }
                if($tmp[$rnd]['_id'])
                {
                  $this->setimpression($tmp[$rnd]['_id']);
                }
                while(@ob_end_clean());
                header('Content-type: text/javascript');
                if($_GET['inner'])
                {
                  if($tmp[$rnd]['script'])
                  {
                    echo $tmp[$rnd]['script']."\r\n";
                  }
                  echo '$(\'#'.$_GET['inner'].'\').css({\'display\':\'block\'}).html(\''.str_replace('rnd=[rnd]','rnd='.time(),$tmp[$rnd]['async']).'\');';
                }
                elseif($_GET['outer'])
                {
                  if($tmp[$rnd]['script'])
                  {
                    echo $tmp[$rnd]['script']."\r\n";
                  }
                  echo '$(\'#'.$_GET['outer'].'\').css({\'display\':\'block\'}).replaceWith(\''.str_replace('rnd=[rnd]','rnd='.time(),$tmp[$rnd]['async']).'\');';
                }
                else
                {
                  echo str_replace('rnd=[rnd]','rnd='.time(),$tmp[$rnd]['code']);
                }
                if($s[2]=='a')
                {
                  /*
                  document.write(\'\x3Cdiv class="_banner _banner-l" id="jarm_b_l">\x3C/div>\x3Cscript type="text/javascript" src="https://ads.jarm.com/impression/?key='.substr(md5('ads-'.md5(HOST)),10,16).'&id=\'+___ads_left+\'&width=\'+window.screen.width+\'&height=\'+window.screen.height+\'&inner=jarm_b_l" async>\x3C/script>\');</script>
                  */
                }
              }
            }
          }
        }
      }
    }
    exit;
  }

  public function banner($domain,$sub)
  {
    $file = 'bin/cache/ads/'.$domain.'.'.$sub.'.txt';
    if(file_exists(_FILES.$file))
    {
      return unserialize(file_get_contents(_FILES.$file));
    }
    return $this->getbanner($domain,$sub,$file);
  }

  public function banner_id($id)
  {
    $file = 'bin/cache/ads/'.$id.'.txt';
    if(file_exists(_FILES.$file))
    {
      return unserialize(file_get_contents(_FILES.$file));
    }
    return $this->getbannerid($id,$file);
  }

  public function setimpression($id)
  {
    if($id=intval($id))
    {
      # /impression/[id]/[DATE:d]/[DATE:H]/[RAND:0-999].txt
      $file = 'bin/ads-impression/'.$id.'/'.date('Y-m-d').'/'.date('H').'/'.substr('000'.rand(1,300),-3).'.txt';
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
      if(strpos($domain,'jarm.com')>-1||strpos($domain,'boxza.com')>-1||strpos($domain,'boxzaracing.com')>-1||strpos($domain,'autocar.in.th')>-1||strpos($domain,'teededball.com')>-1)
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

      if(defined('NOTINC'))
      {
        while(@ob_end_clean());
        header('Content-type: text/javascript');
        exit;
      }
    }
  }

  public function getbanner($domain,$sub,$file)
  {
    $_b=[];
    if($banner=Load::DB()->find('ads',['dd'=>['$exists'=>false],'pl'=>1,$domain.'.'.$sub=>['$exists'=>true],'dt1'=>['$lte'=>Load::Time()->now()],'dt2'=>['$gte'=>Load::Time()->now()]],[],['sort'=>['so'=>1,'_id'=>1]]))
    {
      foreach($banner as $v)
      {
        if(is_array($v[$domain][$sub]))
        {
          $j=$v[$domain][$sub];
          foreach($j as $k)
          {
            if(!is_array($_b[$k]))
            {
              $_b[$k]=[];
            }
            $tmp='';
            if($k=='a')
            {
              if($v['ads'])
              {
                if($v['ads']['l'])
                {
                  //$tmp.="\n".'if($(window).width()>992)var ___ads_left='.$v['ads']['l'].';';
                  $tmp.='if($(window).width()>992)$(\'#jarm_b_l\').after(\'\x3Cscript type="text/javascript" src="'.Load::uri([Load::$sub,'/impression/?key='.substr(md5('ads-'.md5(HOST)),10,16).'&inner=jarm_b_l&id='.$v['ads']['l'].'&width=\'+window.screen.width+\'&height=\'+window.screen.height+\'']).'" async>\x3C/script>\');';
                }
                if($v['ads']['r'])
                {
                  //$tmp.="\n".'if($(window).width()>992)var ___ads_right='.$v['ads']['r'].';';
                  $tmp.='if($(window).width()>992)$(\'#jarm_b_r\').after(\'\x3Cscript type="text/javascript" src="'.Load::uri([Load::$sub,'/impression/?key='.substr(md5('ads-'.md5(HOST)),10,16).'&inner=jarm_b_r&id='.$v['ads']['r'].'&width=\'+window.screen.width+\'&height=\'+window.screen.height+\'']).'" async>\x3C/script>\');';
                }
              }
            }
            if($v['tyc']=='1')
            {
              $_b[$k][]=['_id'=>$v['_id'],'ty'=>'html','code'=>$this->docwrite($v['code']).$tmp];
            }
            else
            {
              $b=['_id'=>$v['_id'],'ty'=>'html','script'=>$tmp,'async'=>'<a href="'.$this->ads_fetch($v,$k).'" target="_blank" rel="nofollow" style="display:block;line-height:0px;"><img src="'.Load::uri([Load::$sub,'/_upload/'.$v['fd'].'/'.$v['s']]).'" class="img-responsive"></a>'];
              $b['code']=$this->docwrite($b['async']).$b['script'];
              $_b[$k][]=$b;
            }
          }
        }
      }
    }
    Load::Folder()->save($file,serialize($_b));
    return $_b;
  }

  public function getbannerid($id,$file)
  {
    $_b=[];
    if($v=Load::DB()->findone('ads',['dd'=>['$exists'=>false],'pl'=>1,'_id'=>intval($id)]))
    {
      if($v['tyc']=='1')
      {
        $_b=['_id'=>$v['_id'],'ty'=>'html','code'=>$this->docwrite($v['code'])];
      }
      else
      {
        $_b=['_id'=>$v['_id'],'ty'=>'html','async'=>'<a href="'.$this->ads_fetch($v,$k).'" target="_blank" title="'.$v['d'].'" rel="nofollow" style="display:block;line-height:0px;"><img src="'.Load::uri([Load::$sub,'/_upload/'.$v['fd'].'/'.$v['s']]).'" alt="'.$v['d'].'" class="img-responsive"></a>'];
        $_b['code']=$this->docwrite($_b['async']);
      }
    }
    Load::Folder()->save($file,serialize($_b));
    return $_b;
  }
}

?>
