<?php

if($chat->myadmin||in_array($chat->myid,$chat->super))
{
  $par=explode(' ',$chat->cmd,3);
  $uid=(strtolower(trim($par[0])));
  $room=intval(trim($par[1]));
  $nroom=getroom($room);

  $al = ($chat->data['admin'][$uid]?intval($chat->data['admin'][$uid]['lv']):0);
  if($room==$chat->room)
  {
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถย้ายไปยังห้องเดิมได้'];
  }
  elseif(!in_array($room,['1','2','3']))
  {
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่มีห้องดังกล่าว'];
  }
  elseif($chat->myadmin < $al)
  {
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่สามารถย้ายบุคคลที่มีอำนาจผู้ดูแลสูงกว่าได้'];
  }
  elseif($uid&&$room&&$nroom)
  {
    $nick=getnicks($chat->cache,$chat->room);
    if($uid==1)
    {
      $chat->mysystem=1;
      $chat->inserttext(array('ty'=>'kick','m'=>'เตะสวนกลับ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] ไปยังห้อง <a href="javascript:;" onclick="_.sroom(\''.$room.'\');">ห้อง'.$nroom.'</a> ด้วยข้อหา "ระบบตะสวนกลับอัตโนมัติ"','par'=>['uid'=>$chat->myid,'room'=>$room],'c'=>21));
    }
    elseif($nick[$uid])
    {
      $chat->inserttext(array('ty'=>'kick','m'=>'เตะ <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] ไปยังห้อง <a href="javascript:;" onclick="_.sroom(\''.$room.'\');">ห้อง'.$nroom.'</a> '.($par[2]?' ด้วยข้อหา "'.$par[2].'"':''),'par'=>['uid'=>$uid,'room'=>$room],'c'=>21));
    }
    else
    {
      Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าวในห้องนี้'];
    }
  }
}
else
{
  Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิทธิ์ใช้งานส่วนนี้'];
}


function getroom($r)
{
  switch($r)
  {
    case 1:
      return 'ทั่วไป';
    case 2:
      return 'เกย์';
    case 3:
      return 'เลสเบี้ยน';
    case 4:
      return 'ผู้หญิง';
    case 5:
      return 'ฟุตบอล';
    case 6:
      return 'รถแต่ง';
    case 7:
      return 'ส่วนตัว';
    default:
      return '';
  }
}

?>
