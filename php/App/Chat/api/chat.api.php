<?php

//define('EXP_RATE',5);

$room=intval(trim(Load::$path[0]));
if(Load::$my['first']&&Load::$path[1]!='list')
{
//	exit;
}
if($_COOKIE['bzc_dd'])
{
  exit;
}
$mynick=[];
$foundpoem=false;
$chat = new chat($room,$user);
if(!$chat->ban&&$chat->valid)
{
  if($chat->room<=3)
  {
    define('EXP_RATE',5);
  }
  else
  {
    define('EXP_RATE',1);
  }

  $act=Load::$path[1];
  if(in_array($chat->myid,$chat->super) || (isset($chat->super2[$chat->myid])&&in_array($chat->room,(array)$chat->super2[$chat->myid])))
  {
    list($func,$cm)=explode('-',$act,2);
    if($cm)
    {
      $act=$cm;
       if($func=='0')
       {
        $chat->mysystem=1;
       }
       elseif($func)
       {
        $chat->isbot=intval($func);
        $nick=getnicks($chat->cache,$chat->room);
        if($_to=$nick[$chat->isbot])
        {
          $chat->syntex['u']=$chat->isbot;
          $chat->syntex['n']=$_to['n'];
          $chat->syntex['l']=$_to['l'];
          $chat->syntex['i']=str_replace('http://','https://',$_to['i']);
          $chat->syntex['rk']=$_to['rk'];
          $chat->syntex['am']=$_to['am'];
          $chat->syntex['ip']=$_to['ip'];
        }
        else
        {
          $chat->isbot=0;
        }
       }
       else
       {
        $chat->mysystem=-1;
       }
    }
    else
    {
      $act=$func;
    }
  }

  switch($act)
  {
    case 'list':
    case 'login':
    case 'nick':
    case 'restore':
    case 'ban':
    case 'unban':
    case 'msg':
    case 'private':
    case 'send':
    case 'admin':
    case 'vj':
    case 'html':
    case 'shutup':
    case 'kick':
    case 'rank':
    case 'move':
    case 'clear':
    case 'talk':
    case 'world':
    case 'marquee':
    case 'secret':
    case 'spin':
      require_once(__DIR__.'/chat/chat.api.'.$act.'.php');
      break;
    case 'idle':
      break;
    default:
      Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คำสั่งไม่ถูกต้อง กรุณาพิมพ์ /help เพื่อดูคำสั่งเบื้องต้น ('.$act.' - '.$chat->myadmin.')'];
      break;
  }
  if(count($_ms=$chat->getms()))
  {
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'chat','data'=>$_ms];
  }
  //Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'logged','data'=>$chat->mylogged];
  $chat->save();
}
if($chat->valid)
{
  $cook='bz_sroom_'.$chat->room;
  if(!$chat->last)
  {
    $chat->hash=rand(1,999999);
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'first','data'=>['_id'=>$chat->room,'hash'=>$chat->hash,'name'=>$chat->data['room']['n'],'radio'=>str_replace('http://','https://',$chat->data['room']['r']),'welcome'=>$chat->data['room']['w'],'bg'=>str_replace('http://','https://',$chat->data['room']['bg']),'logged'=>$chat->mylogged,'rank'=>$chat->mybux]];
    $_COOKIE[$cook] = $chat->hash;
    setcookie($cook,$chat->hash,time()+2592000,'/','chat.jarm.com',false,true);
  }
  else
  {
    if($_COOKIE[$cook]&&$chat->hash)
    {
      if($_COOKIE[$cook]!=$chat->hash)
      {
        Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'duplicate'];
      }
    }

    if($chat->room<8)
    {
      if(in_array($chat->myid,$chat->block))
      {
        if(!$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']])
        {
          $chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+(3600*2400);
          $chat->save=true;
          $chat->save();
        }
        exit;
      }
    }
  }
  Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'info','data'=>['ip'=>$_SERVER['REMOTE_ADDR'],'myid'=>$chat->myid,'logged'=>Load::$my['logged']?1:0]];
}

/*
if(Load::$my['_id']=='10206486363972963')
{
  print_r(Load::$my);
  exit;
}
*/
while(@ob_end_clean());
if($_GET['callback'])
{
  header('Content-type: text/javascript');
  echo $_GET['callback'].'('.json_encode((array)Load::$core->data['content']).')';
}
else
{
  header('Content-type: application/json');
  echo json_encode(Load::$core->data['content']);
}
exit;

class chat
{
  public $data;
  public $user;
  public $admin;
  public $myid;
  public $syntex;
  public $config;
  public $key='';
  public $hash='';
  public $ban=false;
  public $isbot=false;
  public $valid=false;
  public $save=false;
  public $inner=false;
  public $mylogged=0;
  public $mysystem=0;
  public $myadmin=0;
  public $mybux=0;
  public $mybox=0;
  public $myname='';
  public $myimg='';
  public $mylink='';
  public $myitem=0;
  public $flood=false;
  public $super=['10206486363972963']; //
  public $super2=[];
  public $super_dj=[];
  public $super_love=[];
  public $superkick=[]; //28710
  //public $super2=[49501=>[3]];
  public $superroom=[];
  public $block=[28461,149595,113739]; //,141826,117317
  public $badword='(ควย|ฆวย|ควัย|เย็ด|พ่อง|อีดอก|kukamusic|แม่ง|เเม่ง|เเมร่ง|เเม่ม|แม้ม|แมร่ง|แม่ม|เหี้ย|เชี่ย|เหรี้ย|เงี่ยน|มึง|สถุน|qpidradio\.com|xat\.com|เสือก|สัส|สัด|สาส|คูก้า|happy2pays|slim\-sure)';
  public $adsword='(qpidradio\.com|xat\.com|happy2pays|slim\-sure)';
  public function __construct($room,$user)
  {
    if(empty($_SERVER['REMOTE_ADDR']))
    {
      return;
    }
    $this->room=$room;
    $this->user=$user;
    $this->key='chatroom_data_'.$this->room;

    $this->cache=Load::Mcache();
    if(!$this->data=$this->cache->get('ca2',$this->key))
    {
      if(!$chroom=Load::DB()->findone('chatroom',['_id'=>$this->room,'dd'=>['$exists'=>false]]))
      {
        Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่มีห้องดังกล่าว'];
        return;
      }
      $this->data=['text'=>[],'wait'=>[],'ban'=>['_id'=>[],'ip'=>[]],'bot'=>[],'shutup'=>[],'last'=>time()];

      $this->data['room']=[
                                      'n'=>$chroom['n'],
                                      'u'=>$chroom['u'],
                                      'w'=>$chroom['w'],
                                      'r'=>$chroom['r'],
                                      'bg'=>$chroom['bg'],
                                      'vj'=>$chroom['vj'],
                                      'li'=>intval($chroom['li']),
                                      'li2'=>intval($chroom['li2']),
                                      'ki'=>intval($chroom['ki']),
                                      'ki2'=>intval($chroom['ki2']),
      ];

      if(is_array($chroom['bt'])&&count($chroom['bt']))
      {
        $bit=1000001;
        for($i=0;$i<count($chroom['bt']);$i++)
        {
          $b=$chroom['bt'][$i];
          if($b['n'])
          {
            $this->data['bot'][$bit]=array (
                                            'n' => $b['n'], //Load::uri(['s3','/guess/'.$q['fd'].'/'.$q['ans'][$rs]['i']])
                                            'i' => ($b['i']?str_replace('http://','https://',$b['i']):FILES_CDN.'chat/avatar/'.rand(1,61).'.png'),
                                            'l' => '',
                                            'ty' => $b['ty'],
                                            'ctrl' => 'all',
                                            'rk'=>0,
                                           );
            $bit++;
          }
        }
      }


      if($chroom['ban'])
      {
        if(is_array($chroom['ban']['_id'])&&count($chroom['ban']['_id']))
        {
          $this->data['ban']['_id']=$chroom['ban']['_id'];
        }
        if(is_array($chroom['ban']['ip'])&&count($chroom['ban']['ip']))
        {
          $this->data['ban']['ip']=$chroom['ban']['ip'];
        }
      }
      $this->data['admin']=$chroom['am'];
      $this->save=true;
    }

    $this->valid=true;
    $this->last=floatval($_GET['last']);
    $this->vid=(Load::$my['logged']?strval($_GET['vid']):'');
    $this->cmd=trim($_GET['cmd']);
    $this->hash=trim($_GET['hash']);
    $this->time=microtime(true);
    $this->time2=time();

    //$img='https://cdn.jarm.com/chat/avatar/'.rand(1,61).'.png';

    $this->mylogged=Load::$my['logged'];
    $this->myid=strval(Load::$my['_id']);
    $this->myname=Load::$my['name'];
    $this->mybux=intval(Load::$my['bu']);
    $this->mybox=0;
    $this->myitem=0;

    if(Load::$my['logged'])
    {
      $this->myimg='https://graph.facebook.com/'.$this->myid.'/picture';
      $this->mylink='https://chat.jarm.com/user/'.$this->myid;
      $this->myadmin=(isset($this->data['admin'][$this->myid])?$this->data['admin'][$this->myid]['lv']:0);
      if(in_array($this->myid,$this->super))
      {
        $this->myadmin=9;
      }
      $this->myitem=intval(Load::$my['ci']);
    }
    else
    {
      $this->myimg='https://cdn.jarm.com/chat/avatar/'.Load::$my['img'].'.png';
      $this->mylink='';
    }

    $this->syntex0=[
                    'ty'=>'ms',
                    'u'=>-1,
                    '_id'=>$this->time,
                    '_sn'=>str_replace('.','_',strval($this->time)),
                    't'=>date('H:i',$this->time),
                    'p'=>'',
                    'm'=>'',
                    'mb'=>1,
                    'c'=>1,
                    'n'=>'ระบบ',
                    'l'=>'',
                    'i'=>'https://s2.jarm.com/profile/00/00/00/s.jpg',
                    'am'=>3,
                    'rk'=>rand(1,5),
                    'inn'=>0,
              ];
    $this->syntex=[
                    'ty'=>'ms',
                    'u'=>$this->myid,
                    '_id'=>$this->time,
                    '_sn'=>str_replace('.','_',strval($this->time)),
                    't'=>date('H:i',$this->time),
                    'p'=>'',
                    'm'=>'',
                    'mb'=>(Load::$my['logged']?1:0),
                    'c'=>1,
                    'n'=>$this->myname,
                    'l'=>$this->mylink,
                    'i'=>$this->myimg,
                    'rk'=>$this->myitem,
                    'am'=>$this->myadmin,
                    'ip'=>$_SERVER['REMOTE_ADDR'],
                    'vid'=>$this->vid,
                    'inn'=>($this->inner?1:0),
              ];
    if(in_array($this->myid,$this->super))
    {

    }
    elseif(!$this->myadmin)
    {
      if($this->myid&&isset($this->data['ban']['_id'][$this->myid]))
      {
        if(intval($this->data['ban']['_id'][$this->myid])<$this->time2)
        {
          unset($this->data['ban']['_id'][$this->myid]);
          $this->save=true;
        }
        else
        {
          Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'banned'];
          $this->ban=true;
        }
      }
      if($this->mybux < -1000000)
      {
        Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณถูกแบนจากแชท เนื่องจากมีคะแนนน้อยเกินไป'];
        Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'banned'];
        $this->ban=true;
      }

      if(isset($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]))
      {
        if(intval($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']])<$this->time2)
        {
          unset($this->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]);
          $this->save=true;
        }
        elseif(!$this->ban)
        {
          Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'banned'];
          $this->ban=true;
        }
      }
    }
  }
  public function getms()
  {
    $_ms=[];
    $super=in_array($this->myid,$this->super);
    //$tmp='';
    $last=$this->last + 0.00009;
    $this->mybox++;
    //1440275390.7728
    //if($super)
    //{
    //	$this->data['text'][]=['_id'=>1440275390.7728];
    //	$this->data['text'][]=['_id'=>1440275390.7729];
    //}
    for($i=0;$i<count($this->data['text']);$i++)
    {
      //$tmp.=" - ".$this->data['text'][$i]['_id']." > ".$last." = ";
      if($this->data['text'][$i]['_id'] > $last)
      {
      //	$tmp.=" true ";
        $m=$this->data['text'][$i];
        $m['i']=str_replace('http://','https://',$m['i']);
        if(!$super)
        {
          $m['ip']='- hidden -';
        }
        if((!$this->last) && ($this->data['text'][$i]['ty']=='sc'))
        {
          $m['m']='';
        }
        if(!$this->data['text'][$i]['p'])
        {
          $_ms[]=$m;
        }
        elseif($this->data['text'][$i]['p']==$this->myid || $this->data['text'][$i]['u']==$this->myid || ($this->data['text'][$i]['p']=='admin'&&$this->myadmin) || $super)
        {
          $_ms[]=$m;
        }
      }
    //	else {
    //		$tmp.=" false ";
    //	}
    //	$tmp.="";
    }
  //	if($super)
  //	{
  //		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'logs','data'=>$tmp];
  //		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'mybox','data'=>$this->mybox];
  //	}
    return $_ms;
  }

  public function inserttext($arg)
  {
    if($this->flood)
    {

    }
    elseif($this->mysystem==1)
    {
      array_push($this->data['text'],array_merge($this->syntex0,$arg));
      $this->time=microtime(true);
      $this->syntex0['_id']=$this->time;
      $this->syntex0['_sn']=str_replace('.','_',strval($this->time));
      $this->syntex0['t']=date('H:i',$this->time);
    }
    elseif($this->mysystem==0)
    {
      array_push($this->data['text'],array_merge($this->syntex,$arg));
      $this->time=microtime(true);
      $this->syntex['_id']=$this->time;
      $this->syntex['_sn']=str_replace('.','_',strval($this->time));
      $this->syntex['t']=date('H:i',$this->time);
    }
    else
    {
      Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>$arg['m']];
    }
    $this->save=true;
  }

  public function save()
  {
    if($this->save)
    {
      if(count($this->data['text'])>30)
      {
        $this->data['text']=array_slice($this->data['text'],10);
      }
      $this->cache->set('ca2',$this->key,$this->data,false,3600*24*7);
    }
  }

  public function randnick()
  {
    require_once(__DIR__.'/chat/chat.api.func.randnick.php');
    return func_randnick().' '.func_randnick();
  }

  public	function saveadmin()
  {
    if(is_array($this->data['admin']))
    {
      Load::DB()->update('chatroom',['_id'=>$this->room],['$set'=>['am'=>$this->data['admin']]]);
      $this->save=true;
    }
  }

  public function nick($n)
  {
    return '<span>'.preg_replace('/\^C([0-9]{1,2})(\,([0-9]{1,2}))?(\,([0-9]{1,2}))?/i','</span><span class="f$1 s$3 b$5">',$n).'</span>';
  }
}

function getuser($cache,$room,$uid)
{
  global $user;
  $nick=getnicks($cache,$room);
  if($nick[$uid])
  {
    return ['pl'=>'','pn'=>$nick[$uid]['n']];
  }
  elseif(is_numeric($uid) && $uid>0)
  {
    if($u=$user->get($uid))
    {
      return ['pl'=>$u['link'],'pn'=>$u['name']];
    }
  }
  return false;
}

function getnicks($cache,$room)
{
  $nick=$cache->get('ca2','chatbox_user_'.$room);
  if(!is_array($nick))$nick=[];
  return $nick;
}

?>
