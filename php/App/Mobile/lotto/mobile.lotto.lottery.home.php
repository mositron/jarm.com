<?php


$db=Load::DB();

$lotto=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1,'l'=>1,'a2'=>1,'a3'=>1,'a4'=>1,'a5'=>1],['sort'=>['tm'=>-1],'limit'=>24]);

Load::$core->assign('parent','/lotto');
Load::$core->assign('lotto',$lotto);

Load::$core->data['content']=Load::$core->fetch('lotto.lottery.home');

?>