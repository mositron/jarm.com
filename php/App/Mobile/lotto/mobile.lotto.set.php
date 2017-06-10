<?php



$db=Load::DB();
$set=$db->find('lotto_set',[],[],['sort'=>['_id'=>-1],'limit'=>31]);

$index=$db->findone('msg',['_id'=>'lotto_set']);



Load::$core->assign('set',$set);
Load::$core->assign('parent','/lotto');

Load::$core->data['content']=Load::$core->fetch('lotto.set');

?>