<?php
namespace Jarm\App\Oauth;
use Jarm\Core\Load;

class Logout extends Service
{
  public function _logout()
  {
    Load::Session()->logout();

    if($_GET['appid'] && isset(Load::$conf['apps'][$_GET['appid']]))
    {
      $r=Load::$conf['apps'][$_GET['appid']];
      $data=['_id'=>Load::$my['_id']];
      $data['algorithm'] = 'HMAC-SHA256';
      $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
      $s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
      Load::move($r['uri'].'logout/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
    }
    elseif($_GET['redirect_uri'])
    {
      Load::move($_GET['redirect_uri']);
    }
    else
    {
      Load::move(['','/']);
    }
  }
}
?>
