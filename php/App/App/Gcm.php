<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Gcm extends Service
{
  public function get_gcm()
  {
    $this->pass($_GET['d']);
  }

  public function post_gcm()
  {
    $this->pass($_POST['d']);
  }

  public function pass($arg)
  {
    if($arg)
    {
      if($data = $this->decrypt($arg))
      {
        $db=Load::DB();
        $device='';
        $token='';
        $name='';
        $model='';
        $os='';
        list($type,$tmp) = explode('#',$data,2);
        if($type=='rg01')
        {
          list($device,$name,$version,$token) = explode('#',$tmp,4);
          $device=trim(strval($device));
          $name=trim(strval($name));
          $version=trim(strval($version));
          $token=trim(strval($token));
        }
        elseif($type=='rg02')
        {
          list($device,$model,$os,$name,$version,$token) = explode('#',$tmp,6);
          $device=trim(strval($device));
          $model=trim(strval($model));
          $os=trim(strval($os));
          $name=trim(strval($name));
          $version=trim(strval($version));
          $token=trim(strval($token));
        }
        if($token&&$device&&$name)
        {
          if($gcm=$db->find('droid_gcm',['dv'=>$device,'n'=>$name]))
          {
            if(count($gcm)>1)
            {
              $gcm=false;
              $db->remove('droid_gcm',['dv'=>$device,'n'=>$name]);
            }
            else
            {
              $db->update('droid_gcm',['_id'=>$gcm[0]['_id']],['$set'=>['du'=>Load::Time()->now(),'md'=>$model,'os'=>$os,'tk'=>$token,'v'=>$version,'ip'=>$_SERVER['REMOTE_ADDR']]]);
            }
          }
          if(!$gcm)
          {
            $db->insert('droid_gcm',['du'=>Load::Time()->now(),'dv'=>$device,'md'=>$model,'os'=>$os,'tk'=>$token,'n'=>$name,'v'=>$version,'ip'=>$_SERVER['REMOTE_ADDR']]);
          }
        }
      }

      $rs=['status'=>'ok'];
      if($_GET['callback'])
      {
        header('Content-type: text/javascript');
        echo $_GET['callback'].'('.json_encode($rs).')';
      }
      else
      {
        header('Content-type: application/json');
        echo json_encode($rs);
      }
    }
    exit;
  }
}
?>
