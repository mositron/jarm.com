<?php
namespace Jarm\Core;
class Time
{
  public $today=false;
  public $ytd=false;
  public $month=['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
  public $day=['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
  public function __construct()
  {

  }

  public function from($sec=0,string $type='mongo',bool $txt=false)
  {
    return $this->getTime(($this->sec($sec)?:time()),$type,$txt);
  }

  public function now($sec=0,string $type='mongo',bool $txt=false)
  {
    if(is_string($sec)&&!is_numeric($sec))
    {
      $sec=strtotime($sec);
    }
    elseif(is_numeric($sec))
    {
      $sec=(time()+$sec);
    }
    else
    {
      $sec=$this->sec($sec);
    }
    return $this->getTime($sec?:time(),$type,$txt);
  }

  public function sec($sec): int
  {
    if(is_array($sec)&&$sec['milliseconds'])
    {
      $s=$sec['milliseconds']/1000;
    }
    elseif(is_object($sec)&&$sec->milliseconds)
    {
      $s=$sec->milliseconds/1000;
    }
    elseif(is_string($sec)&&!is_numeric($sec))
    {
      $s=strtotime($sec);
    }
    elseif(is_numeric($sec))
    {
      $s=$sec;
    }
    else
    {
      $s=0;
    }
    return $s;
  }

  private function getAgo($sec): string
  {
    $s=time()-$sec;
    if ($s<0)$s=0;
    foreach(["60:วินาที","60:นาที","24:ชั่วโมง","30:วัน","12:เดือน","0:ปี"] as $x)
    {
      $y=explode(":",$x);
      if($y[0]>1){$v=$s%$y[0];$s=floor($s/$y[0]);}else{$v=$s;}
      $t[$y[1]]=$v;
    }
    foreach(['ปี','เดือน','วัน','ชั่วโมง','นาที'] as $x)
    {
      if($t[$x]) return $t[$x]." ".$x;
    }
    return '>1 นาที';
  }

  private function getTime(int $s,string $type='mongo',bool $txt=false)
  {
    switch($type)
    {
      case 'date':
        if(!$s)return '';
        $t=date('j',$s).' '.$this->month[date('n',$s)-1].' '.(date('Y',$s)+543);
        if($txt)
        {
          if(!$this->today)
          {
            $this->today=date('j').' '.$this->month[date('n')-1].' '.(date('Y')+543);
            $d=strtotime('-1 day');
            $this->ytd=date('j',$d).' '.$this->month[date('n',$d)-1].' '.(date('Y',$d)+543);
          }
          if($t==$this->today)
          {
            return 'วันนี้';
          }
          elseif($t==$this->ytd)
          {
            return 'เมื่อวาน';
          }
        }
        return $t;
      case 'time':
        return $s?date('H:i', $s):'';
      case 'datetime':
        return $this->getTime($s,'date',$txt).' - '.$this->getTime($s,'time');
      case 'ago':
        return $this->getAgo($s);
      case 'mongo':
        return new \MongoDB\BSON\UTCDateTime($s*1000);
    }
  }
}
?>
