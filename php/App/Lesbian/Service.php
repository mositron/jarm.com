<?php
namespace Jarm\App\Lesbian;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $zone;
  public $type;
  public $province;
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'เลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน เลสรุก เลสรับ เลสไบ เลสทูเวย์ เลสหาเพื่อน หาเพื่อนเลสเบี้ยน หาเพื่อนทอม หาเพื่อนดี้ หญิงรักหญิง',
      'description'=>'เลสเบี้ยน ทอม ดี้ เลสคิง เลสควีน เลสรุก เลสรับ เลสไบ เลสทูเวย์ เลสหาเพื่อน หาเพื่อนเลสเบี้ยน หาเพื่อนทอม หาเพื่อนดี้ หญิงรักหญิง แลกเปลี่ยนพูดคุย หาเพื่อน หาคู่ได้ที่นี่',
      'keywords'=>'เลสเบี้ยน, ทอม, ดี้, เลสคิง, เลสควีน, เลสรุก, เลสรับ, เลสไบ, เลสทูเวย์, เลสหาเพื่อน, หาเพื่อนเลสเบี้ยน, หาเพื่อนทอม, หาเพื่อนดี้, หญิงรักหญิง',
      'nav-header'=>'<div><a href="/" title="เลสเบี้ยน ทอมดี้">เลสเบี้ยน</a></div><i></i><ul>
      <li><a href="/friend" title="หาเพื่อนเลสเบี้ยน หาเพื่อนทอมดี้"'.($path=='friend'?' class="active"':'').'>หาเพื่อนเลสเบี้ยน ทอมดี้</a></li>
      <li><a href="'.Load::uri(['chat','/lesbian']).'" title="แชทเลสเบี้ยน แชทห้องเลสเบี้ยน แชทหาเพื่อนเลสเบี้ยน">แชทหาเพื่อนเลสเบี้ยน</a></li>
      </ul>'
    ]);

    $this->zone=[
      '1'=>['n'=>'กรุงเทพและปริมณฑล','l'=>[2,19,24,29,60,62]],
      '2'=>['n'=>'ภาคเหนือ','l'=>[5,13,14,23,26,34,37,38,40,41,45,53,54,75,76]],
      '3'=>['n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>[4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77]],
      '4'=>['n'=>'ภาคตะวันตก','l'=>[3,17,30,39,51]],
      '5'=>['n'=>'ภาคตะวันออก','l'=>[7,8,9,16,31,50]],
      '6'=>['n'=>'ภาคกลาง','l'=>[2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72]],
      '7'=>['n'=>'ภาคใต้','l'=>[1,12,15,22,25,32,35,36,42,47,49,58,59,68]]
    ];
    $this->type=[''=>'เลสเบี้ยน','les1'=>'ทอม','les2'=>'ดี้','les3'=>'เลสคิง','les4'=>'เลสควีน','les5'=>'เลสไบ','les6'=>'เลสทูเวย์'];
    $this->province=require(__CONF.'province.php');

    Load::$core->assign('province',$this->province)
      ->assign('zone',$this->zone)
      ->assign('type',$this->type);

  }

  public function sendreport($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();

    if($f=$db->findone('msn',['_id'=>intval($arg['friend']),'dd'=>['$exists'=>false]]))
    {
       if(Load::$my && ((Load::$my['_id']==$f['u'])||(Load::$my['am'] &&Load::$my['am']>0)))
       {
         $db->update('msn',['_id'=>$f['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
         Load::Upload()->post('s3','delete','msn/'.$f['fd'].'/'.$f['pt']);
         $ajax->alert('ลบข้อความเรียบร้อยแล้ว');
       }
       elseif($arg['reason'])
       {
        $mail=Load::Mail();
        $mail->to=$f['em'];
        $mail->subject = 'ลิ้งค์สำหรับลบข้อความ - Jarm Friend หาเพื่อน หาแฟน หากิ๊ก หาคู่';
        Load::$core->assign('f',$f);
        Load::$core->assign('code',md5($f['_id'].Load::$conf['friend']['key_delete'].$f['em']));
        $mail->message = Load::$core->fetch('friend.report');
        $mail->send();
        $ajax->alert('ส่งลิ้งค์สำหรับการลบข้อความไปยัง '.$f['em'].' เรียบร้อยแล้ว');
       }
       else
       {
         $db->update('msn',['_id'=>$f['_id']],['$set'=>['sp'=>intval($f['sp'])+1,'sd'=>Load::Time()->now()]]);
         $ajax->alert('รายงานข้อความนี้เรียบร้อยแล้ว');
       }
      Load::$core->delete('lesbian.jarm.com/home');
      Load::$core->delete('lesbian.jarm.com/friend');
    }

  }

  public function setrec($id)
  {
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
