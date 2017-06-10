<?php

Load::Ajax()->register(['newcontent','delcontent']);

Load::$core->data['title']=$content_type[$type]['n'].' | '.Load::$core->data['title'];

$content=$db->find('team_content',['type'=>$type,'status'=>1],[],['sort'=>['_id'=>1]]);

Load::$core->data['content']=Load::$core->assign('content',$content)
                ->fetch('announce.home');


function newcontent($par)
{
  if(team::$my['grade']==99)
  {
    $arg=[];
    $arg['status']=1;
    $arg['type']=5;
    $arg['u']=team::$my['_id'];
    $arg['ue']=team::$my['_id'];
    $arg['da']=Load::Time()->now();
    $arg['de']=Load::Time()->now();
    $arg['title']=trim($par['title']);
    $id=Load::DB()->insert('team_content',$arg);
    team::move('/announce/update/'.$id.'?added');
  }
}
function delcontent($id)
{
  if(team::$my['grade']==99)
  {
    Load::DB()->update('team_content',['_id'=>intval($id)],['$set'=>['status'=>0,'ud'=>team::$my['_id'],'dd'=>Load::Time()->now()]]);
    team::move(URL);
  }
}
?>
