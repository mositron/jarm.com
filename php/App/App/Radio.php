<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Radio extends Service
{
  public function get_radio()
  {
    $serv=[
      'get_radio'=>'json_radio',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]?:'json_radio'}();
    exit;
  }

  public function json_radio()
  {
    $tmp=require(__CONF.'radio.php');

    $radio=[];
    foreach($tmp as $k=>$v)
    {
      if($v['py']['streamer'])
      {
        $v['file']=$v['py']['streamer'].'/'.$v['py']['file'];
      }
      else
      {
        $v['file']=$v['py']['file'];
      }
      $v['swf']=($v['py']['swf']?$v['py']['swf']:'');
      unset($v['ty'],$v['py']);
      $radio[$k]=$v;
    }

    $data=[
      'status'=>'ok',
      'content'=>$radio,
      'mode'=>'radio',
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }
}
?>
