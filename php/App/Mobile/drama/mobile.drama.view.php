<?php

if(!$tv=Load::DB()->findone('tvreturn',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/drama');
}
if($tv['type']=='drama')
{
	Load::$core->assign('parent','/drama');	
}
else
{
	Load::$core->assign('parent','/drama/'.$tv['type']);
}
Load::$core->assign('tv',$tv);

Load::$core->data['content']=Load::$core->fetch('drama.view');



?>
