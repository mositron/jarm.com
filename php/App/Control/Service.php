<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public static $host_uri;

  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ระบบควบคุม | Jarm.com',
      'description'=>'ระบบควบคุม | Jarm.com',
      'keywords'=>'control, jarm',
      'nav-header'=>'<div><a href="/" title="ควบคุม">ควบคุม</a></div><i></i><ul>
      <li><a href="/news" title=""'.($path=='news'?' class="active"':'').'>ข่าว</a></li>
      <li><a href="/lotto" title=""'.($path=='lotto'?' class="active"':'').'>ตรวจหวย</a></li>
      <li><a href="/user" title=""'.($path=='user'?' class="active"':'').'>ผู้ดูแล</a></li>
      <li><a href="/home-banner" title=""'.($path=='home-banner'?' class="active"':'').'>แบนเนอร์หน้าแรก</a></li>
      <li><a href="/banner" title=""'.($path=='banner'?' class="active"':'').'>แบนเนอร์ทั้งหมด</a></li>
      <li><a href="/job" title=""'.($path=='job'?' class="active"':'').'>รับสมัครงาน</a></li>
      <li><a href="/live" title=""'.($path=='live'?' class="active"':'').'>เครื่องมือ Live</a></li>
      </ul>',
      'hide_adsense'=>true,
      'sc-bottom'=>false,
    ]);
  }

  public function _job()
  {
    Load::Ajax()->register('setjob',$this);
    return Load::$core
      ->assign('msg',Load::DB()->findone('msg',['_id'=>'job']))
      ->fetch('control/job');
  }

  public function setads($i)
  {
    $db=Load::DB();
    if($i)
    {
      $db->update('msg',['_id'=>'ads'],['$set'=>['msg'=>1]]);
      Load::Ajax()->alert('เปิดแสดงโฆษณาเรียบร้อยแล้ว');
    }
    else
    {
      $db->update('msg',['_id'=>'ads'],['$set'=>['msg'=>0]]);
      Load::Ajax()->alert('ปิดโฆษณาเรียบร้อยแล้ว');
    }
    Load::Ajax()->script('setTimeout(function(){window.location.href="/banner";},2000);');
  }

  public function clearcache($domain)
  {
    Load::$core->clean('',true,$domain);
    Load::DB()->insert('logs',['ty'=>'cache','u'=>Load::$my['_id'],'dm'=>$domain]);
    Load::Ajax()
      ->alert('ล้างแคชทั้งหมดเรียบร้อยแล้ว')
      ->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
  }

  public function setjob($frm)
  {
    $ajax=Load::Ajax();
    if($this->check_perm('job',1))
    {
      Load::DB()->update('msg',['_id'=>'job'],['$set'=>['msg'=>trim($frm['detail'])]]);
      $ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    $ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
  }

  public function check_perm($key,$am=1)
  {
    if(Load::$my['am']>=$am)
    {
      return true;
    }
    return false;
  }
}
?>
