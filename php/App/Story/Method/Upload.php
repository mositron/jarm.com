<?php
namespace Jarm\App\Story\Method;
use Jarm\Core\Load;

class Upload
{
  private $story;
  public function __construct($story)
  {
    Load::Session()->logged();
    $this->story = $story;
  }

  public function get()
  {
    $db=Load::DB();
    if($this->blog=$db->findone('story_blog',['dd'=>['$exists'=>false],'l'=>Load::$path[1]]))
    {
      if($this->post=$db->findone('story_post',['_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false],'b'=>$this->blog['_id']]))
      {
        if($f=$_FILES['image']['tmp_name'])
        {
          $type='';
          $size=@getimagesize($f);
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
              $type='gif';
              break;
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/png':
            case 'image/x-png':
            case 'image/wbmp':
            case 'image/bmp':
              $type='jpg';
              break;
          }
          if($type)
          {
            if($size[0]>50&&$size[1]>50)
            {
              $q=Load::Upload()->post($this->post['sv'],'upload','@'.$f,['name'=>time(),'folder'=>'story/'.$this->post['fd'],'width'=>680,'height'=>3000,'fix'=>'inboth','type'=>$type]);

              $url='https://'.$this->post['sv'].'.jarm.com/story/'.$this->post['fd'].'/'.$q['data']['n'];
              $status=['status'=>'OK','data'=>['url'=>$url,'w'=>$q['data']['w'],'h'=>$q['data']['h']]];
              echo json_encode($status);
            }
          }
        }
      }
    }
    exit;
  }
}
?>
