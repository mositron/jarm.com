<?php
namespace Jarm\App\Lesbian;
use Jarm\Core\Load;

class Chat extends Service
{
  public function get_chat()
  {
    Load::$core->data['title']='แชทเลสเบี้ยน์ ห้องแชทชาวเลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน เลสรุก เลสรับ พูดคุยของชาวเลสเบี้ยน สนทนาตามประสาชาวเลสเบี้ยน์';
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];
    Load::$core->data['content']=Load::$core->fetch('lesbian/chat');
  }
}

/*
'' => 'home',
'home' => 'home',
'friend'=>'friend',
'admin'=>'admin',
'report'=>'report',
'chat'=>'chat',
*/
?>
