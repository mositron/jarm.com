<?php
namespace Jarm\App\Tv;
use Jarm\Core\Load;

class Cron extends Service
{
  public function get_cron()
  {
    define('APP_VERSION','0.1'); // กำหนดเอง
    define('APP_ID',Load::$conf['tv']['app_id']);
    define('DEV_CODE',Load::$conf['tv']['dev_code']);
    define('DEV_KEY',Load::$conf['tv']['dev_key']);

    //get_cate();
    $db=Load::DB();
    if($last_cate=$db->find('tv_cate',[],[],['sort'=>['ds'=>1],'limit'=>2]))
    {
      for($i=0;$i<count($last_cate);$i++)
      {
        $c=intval($last_cate[$i]['id']);
        $this->get_list($c);
      }
    }

    if($c=$db->find('tv_list',['waiting'=>1],[],['limit'=>10]))
    {
      for($i=0;$i<count($c);$i++)
      {
        $this->get_episode($c[$i]['content_season_id']);
        $db->update('tv_list',['_id'=>$c[$i]['_id']],['$set'=>['ds'=>Load::Time()->now()],'$unset'=>['waiting'=>1]]);
      }
    }
    /*
    if($c=$db->find('tv_episode',['waiting'=>1],[],['limit'=>100]))
    {
      for($i=0;$i<count($c);$i++)
      {
        get_part($c[$i]['content_season_id'],$c[$i]['episode_id']);
        $db->update('tv_episode',['_id'=>$c[$i]['_id']],['$set'=>['ds'=>Load::Time()->now()],'$unset'=>['waiting'=>1]]);
      }
    }
    */
    exit;
  }

  public function get_cate()
  {
    $html=Load::Http()->get('http://api.otv.co.th/api/index.php/v3/Category/index/'.APP_ID.'/'.APP_VERSION);
    $json=json_decode($html,true);
    #print_r($json);
    if($json['status']=='1' || $json['status_detail']=='success')
    {
      if(is_array($json['items']))
      {
        $db=Load::DB();
        foreach($json['items'] as $v)
        {
          $v['id']=intval($v['id']);
          $v['link']=Load::Format()->link($v['name_en'],false);
          if($c=$db->findone('tv_cate',['id'=>$v['id']]))
          {
            unset($v['id'],$v['link']);
            $db->update('tv_cate',['_id'=>$c['_id']],['$set'=>$v]);
          }
          else
          {
            $db->insert('tv_cate',$v);
            echo 'get_cate->insert: '.$v['name_th'].'<br>';
          }
        }
      }
    }
  }

  public function get_list($cate_id)
  {
    $cate_id=intval($cate_id);
    $html=Load::Http()->get('http://api.otv.co.th/api/index.php/v3/Lists/index/'.DEV_CODE.'/'.DEV_KEY.'/'.APP_ID.'/'.APP_VERSION.'/'.$cate_id);
    $json=json_decode($html,true);
    #print_r($json);
    if($json['status']=='1' || $json['status_detail']=='success')
    {
      if(is_array($json['items']))
      {
        $db=Load::DB();
        foreach($json['items'] as $v)
        {
          $v['cate_id']=$cate_id;
          $v['content_id']=intval($v['content_id']);
          $v['content_season_id']=intval($v['content_season_id']);
          $v['release']=Load::Time()->from($v['release']);
          $v['modified_date']=Load::Time()->from($v['modified_date']);

          if($c=$db->findone('tv_list',['content_id'=>$v['content_id'],'content_season_id'=>$v['content_season_id']]))
          {
            unset($v['content_id'],$v['content_season_id']);
            if(!$c['ds'] || Load::Time()->sec($c['ds'])<Load::Time()->sec($v['modified_date']))
            {
              $v['waiting']=1;
              echo 'get_list->waiting: '.$v['name_th'].'<br>';
            }
            $db->update('tv_list',['_id'=>$c['_id']],['$set'=>$v]);
          }
          else
          {
            $db->insert('tv_list',$v);
            echo 'get_list->insert: '.$v['name_th'].' - '.$v['content_id'].'<br>';
          }
        }
      }
    }
    $db->update('tv_cate',['id'=>$cate_id],['$set'=>['count'=>$db->count('tv_list',['cate_id'=>$cate_id]),'ds'=>Load::Time()->now()]]);
  }

  public function get_episode($content_season_id)
  {
    $content_season_id=intval($content_season_id);
    $html=Load::Http()->get('http://api.otv.co.th/api/index.php/v3/Episodelist/index/'.DEV_CODE.'/'.DEV_KEY.'/'.APP_ID.'/'.APP_VERSION.'/'.$content_season_id);
    $json=json_decode($html,true);
    #print_r($json);
    if($json['status']=='1' || $json['status_detail']=='success')
    {
      if(is_array($json['episode_list']))
      {
        $db=Load::DB();
        foreach($json['episode_list'] as $v)
        {
          $v['content_season_id']=$content_season_id;
          $v['episode_id']=intval($v['episode_id']);
          $v['date']=Load::Time()->from($v['date'].' 23:59:59');
          $v['modified_date']=Load::Time()->from($v['modified_date']);

          $update=false;
          $episode_id=$v['episode_id'];
          //$json['episode_detail']['part_items']
          if($c=$db->findone('tv_episode',['episode_id'=>$v['episode_id']]))
          {//episode_id:
            $_id=$c['_id'];
            unset($v['episode_id']);
            if(!$c['ds'] || Load::Time()->sec($c['ds'])<Load::Time()->sec($v['modified_date']))
            {
              $update=true;
              echo 'get_episode->waiting: '.$v['name_th'].' - '.$episode_id.'<br>';
            }
            $db->update('tv_episode',['_id'=>$c['_id']],['$set'=>$v]);
          }
          else
          {
            $update=true;
            $_id=$db->insert('tv_episode',$v);
            echo 'get_episode->insert: '.$v['name_th'].' - '.$v['episode_id'].'<br>';
          }

          if($update)
          {
            $part=$this->get_part($episode_id);
            $part_app=$this->get_part_app($episode_id);
            echo 'get_episode->update-part: count='.count($part).'<br>';
            echo 'get_episode->update-part-app: count='.count($part_app).'<br>';
            if(count($part)>0)
            {
              $db->update('tv_episode',['_id'=>$_id],['$set'=>['ds'=>Load::Time()->now(),'part_items'=>$part]]);
            }
            if(count($part_app)>0)
            {
              $db->update('tv_episode',['_id'=>$_id],['$set'=>['ds'=>Load::Time()->now(),'part_items_app'=>$part_app]]);
            }
          }
        }
      }
    }
    else
    {
      echo 'error: get_episode - '.'http://api.otv.co.th/api/index.php/v3/Episodelist/index/'.DEV_CODE.'/'.DEV_KEY.'/'.APP_ID.'/'.APP_VERSION.'/'.$content_season_id;
      echo '<br>';
      print_r($json);
      echo '<br>';
    }
  }


  public function get_part($episode_id)
  {
    $episode_id=intval($episode_id);
    $html=Load::Http()->get('http://api.otv.co.th/api/index.php/v3/Episode/oplay',
    ['dev_code'=>DEV_CODE,
    'dev_key'=>DEV_KEY,
    'app_id'=>APP_ID,
    'app_version'=>APP_VERSION,
    'ep_id'=>$episode_id
    ]);
    $json=json_decode($html,true);
    #print_r($json);
    if($json['status']=='1' || $json['status_detail']=='success')
    {
      if(is_array($json['episode_detail'])&&is_array($json['episode_detail']['part_items']))
      {
        return $json['episode_detail']['part_items'];
      }
    }
    echo 'get_part - '.$episode_id.'<br>';
    //print_r($json);
    return [];
  }


  public function get_part_app($episode_id)
  {
    $episode_id=intval($episode_id);
    $html=Load::Http()->get('http://api.otv.co.th/api/index.php/v3/Episode/detail/'.DEV_CODE.'/'.DEV_KEY.'/'.APP_ID.'/'.APP_VERSION.'/'.$episode_id);
    $json=json_decode($html,true);
    #print_r($json);
    if($json['status']=='1' || $json['status_detail']=='success')
    {
      if(is_array($json['episode_detail'])&&is_array($json['episode_detail']['part_items']))
      {
        return $json['episode_detail']['part_items'];
      }
    }
    echo 'get_part_app - '.$episode_id.'<br>';
    return [];
  }
}
?>
