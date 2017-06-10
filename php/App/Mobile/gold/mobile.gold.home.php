<?php

$db=Load::DB();


Load::$core->assign('msg',$db->findone('msg',['_id'=>'gold']));



Load::$core->data['content']=Load::$core->fetch('gold.home');



?>
