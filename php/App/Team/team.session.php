<?php
class team_session
{
  public static $cookie='jarm-team';
  public static $domain='jarm.com';
  public function __construct()
  {
    if(!empty($_COOKIE[self::$cookie]))
    {
      list($s,$p) = explode('.', $_COOKIE[self::$cookie], 2);
      $sig = base64_decode(strtr($s, '-_', '+/'));
      $data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);
      if(strtoupper($data['algorithm']) == 'HMAC-SHA256')
      {
        if($sig == hash_hmac('sha256', $p, Load::$conf['session']['key'].$data['_id'], true))
        {
          $connect=false;
          $user=team::user();
          if($my=$user->get($data['_id'],false))
          {
            $status=intval($my['st']);
            if($status<0||$status>1)
            {
              return false;
            }
            if(!$my['du'] || Load::Time()->sec($my['du'])+900<time())
            {
              $connect=true;
              $my['du']=Load::Time()->now();
            }
          }
          if($my)
          {
            team::$my=$my;
            if($connect)
            {
              $user->update($my['_id'],['$set'=>['du'=>Load::Time()->now(),'ip'=>($my['ip']=$_SERVER['REMOTE_ADDR'])]]);
              Load::$core->set('team/user/'.Load::Folder()->fd($my['_id'],true),$my,true);
            }
            return true;
          }
        }
      }
    }
    setcookie(self::$cookie,'',time()+86400,'/',self::$domain);
  }

  public function logged()
  {
    if(!team::$my)
    {
      team::move('/oauth/?redirect_uri='.urlencode(URI));
    }
  }

  public function logout()
  {
    setcookie(self::$cookie,'',time()+86400,'/',self::$domain);
  }

  public function set($user,$redirect=true)
  {
    $user['aways']=true;
    $status=intval($user['st']);
    if($status<0)
    {
      if($status==-1)
      {
        team::move(['team','/?error=-1']);
      }
    }
    elseif($status<=1)
    {
      $data=['_id'=>$user['_id'],'name'=>$user['th']['first'].' '.$user['th']['last'],'img'=>'https://f4.jarm.com/team/profile/'.$user['if']['fd'].'/s.'.($user['pf']['av']?$user['pf']['av']:'jpg')];
      $data['algorithm'] = 'HMAC-SHA256';
      $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
      $s = strtr(base64_encode(hash_hmac('sha256', $d, Load::$conf['session']['key'].$data['_id'], true)), '+/', '-_');
      setcookie(self::$cookie,$s.'.'.$d,time()+($user['aways']?2592000:86400),'/',self::$domain,false,true);
      if($redirect)
      {
        team::move(URI);
      }
      return $s.'.'.$d;
    }
    return '';
  }
}
?>
