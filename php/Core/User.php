<?php
namespace Jarm\Core;

class User
{
  public $list=[];
  public $fields=['_id'=>1,'if'=>1,'em'=>1,'st'=>1,'sc'=>1,'pf'=>1,'du'=>1,'ip'=>1,'am'=>1,'ht'=>1,'fr'=>1,'sg'=>1,'da'=>1,'dm'=>1,'sv'=>1];

  public function __construct()
  {
    $this->list=[];
  }
  public function get($uid,bool $allow=true): ?array
  {
    $md5=md5($uid=trim($uid));
    $key='user/'.substr($md5,0,3).'/'.substr($md5,3,3).'/'.substr($md5,6,3).'/'.$md5;
    if(is_numeric($uid))
    {
      $query=['_id'=>intval($uid)];
    }
    else
    {
      $query=['if.lk'=>$uid];
    }
    if(!isset($this->list[$uid]))
    {
      if($uid===0)
      {
        $this->list[$uid]['_id']=0;
        $this->list[$uid]['name']='ระบบ';
        $this->list[$uid]['img']=Load::uri(['f2','/profile/00/00/00/s.jpg']);
        $this->list[$uid]['link']='';
      }
      else
      {
        if(!($this->list[$uid]=Load::$core->get($key)))
        {
          if($this->list[$uid]=Load::DB()->findOne('user',$query,$this->fields))
          {
            $this->list[$uid]['name']=$this->list[$uid]['if']['fn'].' '.$this->list[$uid]['if']['ln'];
            $this->list[$uid]['nimg']=Load::uri([Load::getServ($this->list[$uid]['sv']?:'f2'),'/profile/'.$this->list[$uid]['if']['fd'].'/n.'.($this->list[$uid]['pf']['av']?:'jpg')]);
            $this->list[$uid]['img']=Load::uri([Load::getServ($this->list[$uid]['sv']?:'f2'),'/profile/'.$this->list[$uid]['if']['fd'].'/s.'.($this->list[$uid]['pf']['av']?:'jpg')]);
            $this->list[$uid]['link']=Load::uri(['my','/'.(($this->list[$uid]['lk']&&!is_numeric($this->list[$uid]['lk']))?$this->list[$uid]['lk']:'user/'.$this->list[$uid]['_id'])]);
            $this->list[$uid]['pet']=($this->list[$uid]['pet']??['price'=>10,'own'=>0,'col'=>[]]);
            Load::$core->set($key,$this->list[$uid],3600);
          }
          else
          {
            return null;
          }
        }
      }
    }
    if($this->list[$uid]['st']>=0 || $allow)
    {
      return $this->list[$uid];
    }
    return null;
  }

  public function reset(int $uid): void
  {
    $md5=md5($uid=trim($uid));
    Load::$core->clean('user/'.substr($md5,0,3).'/'.substr($md5,3,3).'/'.substr($md5,6,3).'/'.$md5,false);
  }

  public function update(int $uid,array $update): void
  {
    Load::DB()->update('user',['_id'=>intval($uid)],$update);
    $this->reset($uid);
    unset($this->list[$uid]);
  }
}
?>
