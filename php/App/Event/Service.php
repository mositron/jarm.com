<?php
namespace Jarm\App\Event;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
  }

  public function get_gold()
  {
    Load::cache();
    Load::$core->data['title']='รายชื่อผู้เข้าร่วมกิจกรรม';
    Load::$conf['db']['collection']['event_gold']='s4';
    $u=Load::DB()->find('event_gold',['ty'=>'comment'],[],['sort'=>['_id'=>1]]);
    $tmp='<h2 class="bar-heading">รายชื่อผู้เข้าร่วมกิจกรรม</h2>'.
    '<p style="padding:10px 0px 5px;margin:0px;border-bottom:1px dashed #f5f5f5">- <a href="https://www.facebook.com/229722963822965_1256201037841814" target="_blank"> โพสต์ของกิจกรรมครั้งที่ 1</a></p>'.
    '<p style="padding:5px 0px 0px">- <a href="https://www.facebook.com/229722963822965_1265291296932788" target="_blank"> โพสต์ของกิจกรรมครั้งที่ 2</a></p>'.
    '<table class="table table-bordered">'.
    '<thead><tr><th style="width:70px;">Number</th><th>Name</th><th style="width:100px;">Type</th></tr></thead>'.
    '<tbody>';
    for($i=0;$i<count($u);$i++)
    {
      $ty='';
      if($u[$i]['ty']=='like')
      {
        $ty='like';
        if($u[$i]['p']=='229722963822965_1256201037841814')
        {
          $ty.=' #1';
        }
        elseif($u[$i]['p']=='229722963822965_1265291296932788')
        {
          $ty.=' #2';
        }
      }
      elseif($u[$i]['ty']=='comment')
      {
        $ty='comment';
        if($u[$i]['p']=='229722963822965_1256201037841814')
        {
          $ty.=' #1';
        }
        elseif($u[$i]['p']=='229722963822965_1265291296932788')
        {
          $ty.=' #2';
        }
      }
      $tmp.='<tr>'.
      '<td>'.($i+1).'</td>'.
      '<td><a href="https://www.facebook.com/app_scoped_user_id/'.$u[$i]['fb'].'" target="_blank">'.$u[$i]['n'].'</a></td>'.
      '<td><a href="https://www.facebook.com/'.($u[$i]['p2']?:$u[$i]['p']).'" target="_blank">'.$ty.'</a></td></tr>';
    }
    $tmp.='</tbody></table>';
    return $tmp;
  }
}
?>
