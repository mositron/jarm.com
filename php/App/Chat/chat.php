<?php
echo '<span style="color:#000;font-size:32px">ปิดบริการชั่วคราว</span><br>'.
'พบกันใหม่ 1 เมษายน 2560.';
exit;

Load::$core->data['title'] = 'Chat แชท พูดคุย สนทนา ผ่านกล้องเว็บแคม สร้างห้องแชทฟรี กับเพื่อนๆใน jarm';
Load::$core->data['description'] = 'Chat แชท พูดคุย สนทนา ผ่านกล้องเว็บแคม ส่องเว็บแคม ส่องกล้อง สร้างห้องแชทฟรี กับเพื่อนๆใน jarm.com';
Load::$core->data['keywords'] = 'สร้างแชทฟรี, สร้างห้องแชทฟรี, Chat, แชท, พูดคุย, สนทนา, เว็บแคม, กล้อง';

$user=new user();
$user->session();

if(Load::$my['dd'])
{
  setcookie('bzc_dd',Load::$my['_id'],time()+8640000,'/','chat.jarm.com');
}

//

require_once(
              _::run([
                      '' => 'home',
                      'home' => 'home',
                      'api'=>'api',
                      'list' => 'list',
                      'create'=>'create',
                      'manage'=>'manage',
                      'room'=>'view',
                      'game'=>'game',
                      '__oauth'=>'oauth',
                      'facebook'=>'facebook',
                      'user'=>'user',
          ],
          true,
          function()
          {
            define('MODULE','view');
            define('MODULE_LINK','name');
          }
      )
);


Load::$core->data['nav-header']='<ul>
<li><a href="/" title="แชท คุยสด แชทหาเพื่อน">แชท</a></li>
<li><a href="/lobby" title="ห้องนั่งเล่น ห้องทั่วไป"'.(Load::$path[0]=='lobby'?' class="active"':'').'>ห้องนั่งเล่น</a></li>
<li><a href="/boyz" title="ห้องเกย์ ห้องแชทเกย์"'.(Load::$path[0]=='boyz'?' class="active"':'').'>ห้องเกย์</a></li>
<li><a href="/lesbian" title="ห้องเลสเบี้ยน ห้องแชทเลสเบี้ยน ทอม ดี้"'.(Load::$path[0]=='lesbian'?' class="active"':'').'>ห้องเลสเบี้ยน</a></li>
</ul>';
if(Load::$my['logged'])
{
  Load::$core->data['nav-header'].='<ul class="pull-right">
  <li><a href="/manage">จัดการห้องแชท</a></li>
  <li><a href="/facebook/logout">ออกจากระบบ</a></li>
  </ul>';
}
else
{
  Load::$core->data['nav-header'].='<ul class="pull-right">
  <li><a href="/facebook/login?redirect_uri='.urlencode(URI).'">ล็อคอินด้วย Facebook</a></li>
  </ul>';
}

function _setsession($data)
{
  $data['algorithm'] = 'HMAC-SHA256';
  $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
  $s = strtr(base64_encode(hash_hmac('sha256', $d, 'bczKey1234567890'.$data['_id'], true)), '+/', '-_');
  setcookie('bzc_session',$s.'.'.$d,time()+2592000,'/','chat.jarm.com',false,true);
}

function _randnick()
{
  require_once(__DIR__.'/api/chat/chat.api.func.randnick.php');
  return func_randnick().' '.func_randnick();
}


function _get_nick($n,$c=true)
{
  if($c)
  {
    return '<span>'.preg_replace('/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/i','</span><span class="f$1 s$3 b$5">',$n).'</span>';
  }
  else {
    return preg_replace('/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/i','',$n);
  }
}


class user
{
  public $list=[];
  public $fields=[];

  public function __construct()
  {
    $this->list=[];
  }

  public function session()
  {
    if(!empty($_COOKIE['bzc_session']))
    {
      list($s,$p) = explode('.', $_COOKIE['bzc_session'], 2);
      $sig = base64_decode(strtr($s, '-_', '+/'));
      $data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
      if(strtoupper($data['algorithm']) == 'HMAC-SHA256')
      {
        if($sig == hash_hmac('sha256', $p, 'bczKey1234567890'.$data['_id'], true))
        {
          if($data['logged'])
          {
            if(Load::$my=$this->get($data['_id']))
            {
              return;
            }
          }
          else
          {
            Load::$my=$data;
            return;
          }
        }
      }
      setcookie('bzc_session','',time()+86400,'/','chat.jarm.com');
    }
    Load::$my = array(
                'logged'=>0,
                '_id'=>'bzc'.time().rand(10000,99999),
                'name'=>_randnick(),
                'img'=>rand(1,61),
    );
    _setsession(Load::$my);
    Load::$my['first']=true;
  }
  public static function folder($uid)
  {
    $u=trim($uid);
    return substr($u,-3).'/'.$u;
  }
  public function get($uid,$allow=false)
  {
    $uid=strval($uid);
    if(!isset($this->list[$uid]))
    {
      $cache = Load::$core;
      $key = 'chat/user/'.self::folder($uid);
      if(!($this->list[$uid]=$cache->get($key,0,true)))
      {
        if($this->list[$uid]=Load::DB()->findOne('chatroom_user',['u'=>$uid]))
        {
          $this->list[$uid]['logged']=1;
          $this->list[$uid]['_id']=$this->list[$uid]['u'];
          $this->list[$uid]['name']=$this->list[$uid]['n'];
          $this->list[$uid]['img']='https://graph.facebook.com/'.$this->list[$uid]['u'].'/picture';
          $this->list[$uid]['link']='https://chat.jarm.com/user/'.$this->list[$uid]['u'];
          $this->list[$uid]['friend']=($this->list[$uid]['fr']?$this->list[$uid]['fr']:['price'=>2000,'own'=>0,'col'=>[]]);
          $cache->set($key,$this->list[$uid],true);
        }
        else
        {
          return false;
        }
      }
    }
    return $this->list[$uid];
  }

  public function reset($uid)
  {
    Load::Folder()->delete('bin/cache/chat/user/'.self::folder($uid).'.html');
  }

  public function update($uid,$update)
  {
    Load::DB()->update('chatroom_user',['u'=>strval($uid)],$update);
    $this->reset($uid);
    unset($this->list[$uid]);
  }

  public function bux($uid,$inc,$type)
  {
    if(Load::$my['logged'])
    {
      if(Load::$conf['bux_logs'])
      {
        Load::DB()->insert('chatroom_bux',['u'=>$uid,'log'=>$type,'sess'=>Load::$my['_id'],'inc'=>$inc]);
      }
      $this->update($uid,['$inc'=>['bu'=>$inc]]);
    }
  }
}
?>
