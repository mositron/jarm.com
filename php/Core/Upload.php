<?php
namespace Jarm\Core;
class Upload
{
  public function __construct()
  {
  }
  public function getkey(string $url,$par): ?string
  {
    if(Load::$my && intval(Load::$my['st'])>=0)
    {
      $data=['_id'=>Load::$my['_id'],'par'=>$par];
      $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
      $s = strtr(base64_encode(hash_hmac('sha256', $d, $data['_id'].'-up-to-'.trim($url,'/'), true)), '+/', '-_');
      return $s.'.'.$d;
    }
    return null;
  }
  public function post(string $serv,string $method,string $file,$data='',bool $decode=true)
  {
    $serv = Load::getServ($serv);
    if(isset(Load::$conf['server']['files'][$serv]))
    {
      $tmp=json_encode($data);
      $key=md5($method.Load::$conf['upload']['key'].$tmp);
      if(substr($file,0,1)=='@')
      {
        $file=new \CurlFile(substr($file,1));
      }
      $json=Load::Http()->get(Load::$conf['server']['files'][$serv]['upload'].'/'.$serv,['key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp]);
      return $decode?json_decode($json,true):$json;
    }
    else
    {
      return ['status'=>'FAIL','message'=>'no server'];
    }
  }
}
?>
