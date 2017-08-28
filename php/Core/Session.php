<?php
namespace Jarm\Core;
class Session
{
  public function __construct()
  {
    if(!empty($_COOKIE[Load::$conf['session']['name']]))
    {
      list($s,$p) = explode('.', $_COOKIE[Load::$conf['session']['name']], 2);
      $sig = base64_decode(strtr($s, '-_', '+/'));
      $data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
      if(strtoupper($data['algorithm']) == 'HMAC-SHA256')
      {
        if($sig == hash_hmac('sha256', $p, Load::$conf['session']['key'].$data['_id'], true))
        {
          $connect=false;
          $user=Load::User();
          if($my=$user->get($data['_id'],false))
          {
            $status=intval($my['st']);
            if($status<0||$status>1)
            {
              return false;
            }
            if(!$my['du'] || (Load::Time()->sec($my['du']))+900<time())
            {
              $connect=true;
              $my['du']=Load::Time()->now();
            }
          }
          if($my)
          {
            Load::$my=$my;
            if($connect)
            {
              $md5=md5($my['_id']);
              $user->update($my['_id'],['$set'=>['du'=>Load::Time()->now(),'ip'=>($my['ip']=$_SERVER['REMOTE_ADDR'])]]);
              #Load::$core->set('user/'.substr($md5,0,3).'/'.substr($md5,3,3).'/'.substr($md5,6,3).'/'.$md5,$my,900);
            }
            return true;
          }
        }
      }
    }
    setcookie(Load::$conf['session']['name'],'',time()+86400,'/',(defined('DOMAIN')?DOMAIN:'jarm.com'));
  }

  public function logged(): void
  {
    if(!Load::$my)
    {
      Load::move(['oauth','/login/?redirect_uri='.urlencode(URI)]);
    }
  }

  public function logout(): void
  {
    setcookie(Load::$conf['session']['name'],'',time()+86400,'/',(defined('DOMAIN')?DOMAIN:'jarm.com'));
  }

  public function set(array $user,bool $redirect=true): ?string
  {
    $status=intval($user['st']);
    if($status<0)
    {
      if($status==-1)
      {
        setcookie(Load::$conf['block'],'YES-'.$user['_id'],time()+2592000,'/',(defined('DOMAIN')?DOMAIN:'jarm.com'),false,true);
        $p=trim((string)$_SERVER['REMOTE_ADDR']);
        if(substr($p,0,8)!='192.168.')
        {
          $db=Load::DB();
          if($idp=$db->findone('block_ip',['ip'=>$p]))
          {
            $db->update('block_ip',['_id'=>$idp['_id']],['$set'=>['du'=>Load::Time()->now()],'$push'=>['us'=>['u'=>$user['_id'],'t'=>Load::Time()->now()]]]);
          }
          else
          {
            $db->insert('block_ip',['du'=>Load::Time()->now(),'ip'=>$p,'us'=>[['u'=>$user['_id'],'t'=>Load::Time()->now()]]]);
          }
        }
        Load::move('https://jarm.com/?error=-1');
      }
    }
    elseif($status<=1)
    {
      $data=['_id'=>$user['_id'],'name'=>$user['if']['fn'].' '.$user['if']['ln'],'img'=>'http://'.$user['sv'].'.jarm.com/profile/'.$user['if']['fd'].'/s.'.($user['pf']['av']?$user['pf']['av']:'jpg')];
      $data['algorithm'] = 'HMAC-SHA256';
      $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
      $s = strtr(base64_encode(hash_hmac('sha256', $d, Load::$conf['session']['key'].$data['_id'], true)), '+/', '-_');
      setcookie(Load::$conf['session']['name'],$s.'.'.$d,time()+($user['aways']?2592000:86400),'/',(defined('DOMAIN')?DOMAIN:'jarm.com'),false,true);
      if($redirect)
      {
        Load::move(URI);
      }
      return $s.'.'.$d;
    }
    return '';
  }
}
?>
