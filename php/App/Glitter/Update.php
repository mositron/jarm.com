<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class Update extends Service
{
  public function _update()
  {
    Load::Session()->logged();
    $db=Load::DB();
    $arg=['_id'=>intval(Load::$path[0]),'u'=>Load::$my['_id']];
    if(Load::$my['am'])
    {
      unset($arg['u']);
    }
    if(!$glitter=$db->findone('glitter',$arg))
    {
      Load::move('/manage');
    }
    Load::Ajax()->register('updateglitter');

    if(Load::$my['am'])
    {
      if($f=$_FILES['o']['tmp_name'])
      {
        $error=[];
        $size=@getimagesize($f);
        $type='jpg';
        switch (strtolower($size['mime']))
        {
          case 'image/gif':
            $type='gif';
            break;
          case 'image/jpg':
          case 'image/jpeg':
          case 'image/bmp':
          case 'image/wbmp':
          case 'image/png':
          case 'image/x-png':
            break;
        }
        $u=Load::User()->get($glitter['u']);
        $q=Load::Upload()->post($glitter['sv'],'glitter-post','@'.$f,['id'=>intval(Load::$path[0]),'folder'=>$glitter['fd'],'name'=>$u['name'],'time'=>Load::Time()->from(Load::Time()->now(),'datetime')]);
        if($q['status']=='OK')
        {
          $db->update('glitter',['_id'=>intval(Load::$path[0])],['$set'=>['ty'=>$type,'zp'=>'glitter.jarm.com-'.intval(Load::$path[0]).'.zip']]);
        }
        Load::move(URL.'?updated');
      }
    }
    return Load::$core
      ->assign('glitter',$glitter)
      ->fetch('glitter/update');
  }

  public function updateglitter($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if($arg['cate'] && !is_array($arg['cate']))$arg['cate']=[$arg['cate']];
    $arg['detail']=trim(mb_substr(strip_tags($arg['detail']),0,1000,'utf-8'));
    if(mb_strlen($arg['detail'],'utf-8')<10)
    {
      $ajax->alert('กรุณากรอกข้อความของกลิตเตอร์อย่างน้อย 10 ตัวอักษร');
    }
    elseif(!$arg['cate'] || count($arg['cate'])<1)
    {
      $ajax->alert('กรุณาเลือกประเภทของกลิตเตอร์');
    }
    else
    {
      $db->update('glitter',['_id'=>intval(Load::$path[0])],['$set'=>['t'=>$arg['detail'],'c'=>array_map('intval',$arg['cate'])]]);
      #Load::$core->delete('glitter_home',0);
      $ajax->alert('บันทึกข้อมูลกลิตเตอร์เรียบร้อยแล้ว')
            ->script('setTimeout(function(){window.location.href="'.URL.'";},2000);');
    }
  }
}
?>
