<?php
namespace Jarm\App\Feed;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Jarm Feed - บริการข้อมูลภายใน jarm.com',
      'description'=>'Jarm Feed - ศูนย์รวมข้อมูลต่างๆภายใน jarm.com เพื่อนำไปใช้งานต่อภายในเว็บของคุณ',
      'keywords'=>'jarm, feed, ข้อมูล, ศูนย์รวม, data',
    ]);
  }

  public function get_home()
  {
    Load::$core->data['content']=Load::$core->fetch('feed/home');
  }

  public function _webhook()
  {
    $token = '';
    $page_token='';
    //$_GET['hub_mode']
    //$_GET['hub_challenge']
    //$_GET['hub_verify_token']

    Load::DB()->insert('logs',['ty'=>'webhook','post'=>$_POST,'get'=>$_GET]);
    if($_GET['hub_verify_token']==$token)
    {
      echo $_GET['hub_challenge'];
    }
    //https://graph.facebook.com/v2.6/me/messages?access_token
    if($_POST['object']=='page')
    {
      $reply='';
      $sender=$_POST['entry'][0]['messaging'][0]['sender']['id'];
      $ms=$_POST['entry'][0]['messaging'][0]['message'];
      if(strpos($ms,'เวลา')!==false)
      {
        $reply='ตอนนี้เวลา '.Load::Time()->from(Load::Time()->now(),'datetime');
      }
      if($reply!='')
      {
        $url='https://graph.facebook.com/v2.6/me/messages?access_token='.$page_token;
        $json=Load::Http()->get($url,
        ['recipient'=>['id'=>$sender],'message'=>['text'=>$reply]]);
      }
    }
      /*
      {
      "object":"page",
      "entry":[
        {
          "id":"PAGE_ID",
          "time":1460245674269,
          "messaging":[
            {
              "sender":{
                "id":"USER_ID"
              },
              "recipient":{
                "id":"PAGE_ID"
              },
              "timestamp":1460245672080,
              "message":{
                "mid":"mid.1460245671959:dad2ec9421b03d6f78",
                "seq":216,
                "text":"hello"
              }
            }
          ]
        }
      ]
    }
    */
    exit;
  }

  public function get_data()
  {
    $types=[
      'news'=>'News',
      'facebook'=>'Facebook',
      'facebook.dev'=>'Facebook_Dev',
      'line'=>'Line',
    ];

    $serv=explode('-',Load::$path[0]);
    if(isset($types[$serv[0]]))
    {
      $type=$types[$serv[0]];
      array_shift($serv);
      $cate=[];
      foreach($serv as $v)
      {
        if($cid=intval($v))
        {
          $cate[]=$cid;
        }
      }
      $cate=array_unique($cate);
      new $type($cate);
    }
    else
    {
      Load::move('/',true);
    }
  }
}
?>
