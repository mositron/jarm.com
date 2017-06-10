<?php

class team_user
{
  public $list=[];
  public $fields=['_id'=>1,'th'=>1,'en'=>1,'email'=>1,'du'=>1,'ip'=>1,'da'=>1,'grade'=>1,'nickname'=>1,'team'=>1,'pos'=>1];

  public function __construct()
  {
    $this->list=[];
  }
  public function get($uid,$allow=false)
  {
    $uid=intval($uid);
    if(!isset($this->list[$uid]))
    {
      if($uid==0)
      {
        $this->list[$uid]['_id']=0;
        $this->list[$uid]['name']='ระบบ';
        $this->list[$uid]['img']=Load::uri(['f2','/profile/00/00/00/s.jpg']);
        $this->list[$uid]['link']='';
      }
      else
      {//
        $cache = Load::$core;
        $uid = intval($uid);
        $key = 'team/user/'.Load::Folder()->fd($uid,true);
        if(!($this->list[$uid]=$cache->get($key)))
        {
          if($this->list[$uid]=Load::DB()->findOne('team_user',['_id'=>$uid],$this->fields))
          {
            $this->list[$uid]['name']=$this->list[$uid]['th']['first'].' '.$this->list[$uid]['th']['last'];
            $this->list[$uid]['img']=Load::uri(['f1','/team/user/'.$this->list[$uid]['_id'].'-s.jpg']);
            $this->list[$uid]['link']=Load::uri(['team','/user/'.$this->list[$uid]['_id']]);
            $cache->set($key,$this->list[$uid],3600);
          }
          else
          {
            return false;
          }
        }
      }
    }

    if($this->list[$uid]['st']>=0 || $allow)
    {
      return $this->list[$uid];
    }
    return false;
  }

  public function reset($uid)
  {
    Load::$core->clean('team/user/'.Load::Folder()->fd(intval($uid),true),false);
  }

  public function update($uid,$update)
  {
    Load::DB()->update('team_user',['_id'=>intval($uid)],$update);
    $this->reset($uid);
    unset($this->list[$uid]);
  }
}
?>
