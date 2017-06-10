<?php
list($id,$link)=explode('-',Load::$path[1],2);

$db=Load::DB();
if(!$lotto=$db->findone('lotto',array('_id'=>intval($id),'dd'=>['$exists'=>false],'pl'=>1)))
{
	Load::move('/lotto/lottery');
}

$tm=Load::Time()->from($lotto['tm'],'date');
Load::$core->data['title'] = 'ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง งวดที่ '.$tm;
Load::$core->data['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล ย้อนหลังงวดที่ '.$tm.'  ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง อัพเดทรวดเร็ว';
Load::$core->data['keywords'] = $tm.', ตรวจหวยย้อนหลัง, ตรวจสลากกินแบ่งย้อนหลัง, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, หวยย้อนหลัง, เลขเด็ด, หวยเด็ด';

Load::$core->assign('parent','/lotto/lottery');
Load::$core->assign('lotto',$lotto);
Load::$core->data['content']=Load::$core->fetch('lotto.lottery.view');
?>