<?php
namespace Jarm\App\Api;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  private $content=[];
  public function __construct()
  {
  }

  public function _me()
  {
    if(in_array(Load::$path[1],['tag','team']))
    {
      $who=['uid'=>Load::$my['_id']];
      if(Load::$path[1]=='tag')
      {
        if(Load::$my)
        {
          $u=[];
          $q=strtolower(trim(trim($_GET['q'])));
          if(!empty($q))
          {
            if($result=Load::DB()->find('tags',['_id'=>new \MongoDB\BSON\Regex($q,'i')],['_id'=>1,'amount'=>1],['sort'=>['amount'=>-1],'limit'=>10]))
            {
              foreach($result as $user)
              {
                $u[]=[
                  '_id'=>$user['_id'],
                  'n'=>str_replace($q,'<strong>'.$q.'</strong>',$user['_id']),
                  'amount'=>$user['amount'],
                ];
              }
            }
          }
          $this->content[] = ['method'=>'tag','data'=>$u];
        }
      }
      elseif(Load::$path[1]=='team')
      {
        if(Load::$my)
        {
          $u=[];
          $q=strtolower(trim(trim($_GET['q'])));
          if(!empty($q))
          {
            $qa = array_values(array_unique(array_filter(explode(' ',$q))));
            $s = [];
            for($i=0;$i<count($qa);$i++)
            {
              $s[] = ['$or'=>[
                    ['n'=> new \MongoDB\BSON\Regex($qa[$i],'i')],
                    ['t'=> new \MongoDB\BSON\Regex($qa[$i],'i')]
                  ]
              ];
            }
            if(count($s)==1)
            {
              $s=$s[0];
            }
            elseif(count($s)>1)
            {
              $a=['$and'=>$s];
              $s=$a;
            }
            $s['dd']=['$exists'=>false];
            if($result=Load::DB()->find('football_team',$s,['_id'=>1,'_ng'=>1,'n'=>1,'t'=>1,'fd'=>1,'l'=>1,'png'=>1],['limit'=>20]))
            {
              foreach($result as $v)
              {
                $u[]=[
                  '_id'=>$v['_id'],
                  'name'=>$v['n'].($v['t']?' ('.$v['t'].')':''),
                  'img'=>'https://s3.jarm.com/football/team/'.$v['fd'].'/s.png',
                  'link'=>'http://www.teededball.com/team/'.$v['l']
                ];
              }
            }
          }
          $this->content[]=['method'=>'team','data'=>$u];
        }
      }
    }
    $this->echo();
  }

  public function _oauth()
  {
    if(in_array(Load::$path[1],['login','logout']))
    {
      if(Load::$path[1]=='login')
      {
        $status=['status'=>'FAIL','message'=>'กรุณากรอกข้อมูลให้ครบถ้วน'];
        if(isset($_POST['email'])&&isset($_POST['password']))
        {
          $db=Load::DB();
          $fields=Load::User()->fields;
          $fields['pw']=1;
          if($u=$db->findOne('user',['em'=>strtolower(trim($_POST['email']))],$fields))
          {
            if($u['pw']==md5(md5($_POST['password'])))
            {
              if($_POST['status'])
              {
                if(!$u['name']=$u['if']['dp'])
                {
                  $u['name']=$u['if']['fn'].' '.$u['if']['ln'];
                }
                $status=['status'=>'OK','data'=>['_id'=>$u['_id'],'em'=>$u['em'],'n'=>$u['name'],'am'=>intval($u['am'])]];
              }
              else
              {
                $u['aways']=1;
                unset($u['pw']);
                $status=['status'=>'OK','cookie'=>Load::Session()->set($u,false)];
              }
            }
            else
            {
              $status=['status'=>'FAIL','message'=>'อีเมล์หรือรหัสผ่านไม่ถูกต้อง'];
            }
          }
          else
          {
            $status=['status'=>'FAIL','message'=>'อีเมล์หรือรหัสผ่านไม่ถูกต้อง'];
          }
        }
        elseif(isset($_POST['fblogin']))
        {
          $arg = explode('#',$this->aes256Decrypt(Load::$conf['api']['key_login'],base64_decode($_POST['fblogin'])),3);
          if($arg[1])
          {
            $email=strtolower($arg[1]);
            $db=Load::DB();
            $fields=Load::User()->fields;
            if($u=$db->findOne('user',['em'=>$email],$fields))
            {
              $u['aways']=1;
              unset($u['pw']);
              $status=['status'=>'OK','cookie'=>Load::Session()->set($u,false)];
            }
            else
            {
              $status=['status'=>'FAIL','message'=>'ไม่มีอีเมล์นี้อยู่ใน jarm.com'];
            }
          }
        }
        $this->content[]=['method'=>'oauth','data'=>$status];
      }
      elseif(Load::$path[1]=='logout')
      {
        Load::Session()->logout();
        Load::$my=NULL;
        $this->content[]=['method'=>'oauth','data'=>['status'=>'OK','cookie'=>'']];
      }
    }
    $this->echo();
  }

  private function echo()
  {
    $this->content[]=['method'=>'logged','data'=>Load::$my?strval(Load::$my['_id']):''];
    while(@ob_end_clean());
    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($this->content).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($this->content);
    }
    exit;
  }

  public function aes256Decrypt($key, $data)
  {
    if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
    $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    $padding = ord($data[strlen($data) - 1]);
    return substr($data, 0, -$padding);
  }
}

?>
