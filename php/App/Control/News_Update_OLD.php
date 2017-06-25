<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Update
{
  public function __construct($parent,$id)
  {
    Load::Session()->logged();
    $db=Load::DB();
    if(!$parent->news=$db->findone('news',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      Load::move('/news');
    }
    $parent->news=(new \Jarm\App\News\Service(['ignore'=>1]))->fetch($parent->news);
    $parent->news['sv']=Load::getServ($parent->news['sv']);
    Load::$core->data['title']='Admin - แก้ไข: '.$parent->news['t'];
    if((Load::Time()->sec($parent->news['da'])<time()-(3600*24*7)) && ($parent->news['c']!=12))
    {
      #Load::move('/news');
    }

    if($parent->news['u']==Load::$my['_id'] || Load::$my['am'])
    {

    }
    else
    {
      Load::move('/news');
    }
    $error=[];
    if($_POST)
    {
      if(Load::$my['am'] || (($parent->news['u']==Load::$my['_id']) && ((!$parent->news['ds']) || (Load::Time()->sec($parent->news['ds']) > time()-(3600*24)))))
      {
        $db=Load::DB();
        $error=[];
        $arg=[];
        $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
        $arg['d']=stripslashes(trim($_POST['detail']));
        $arg['d']=preg_replace('/\<br([^\>]*)\>/i',' ',$arg['d']);
        $arg['d']=preg_replace_callback('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i',
        function($arg)
        {
          $tmp='';
          if($img = strip_tags($arg[2],'<img><em>'))
          {
            $tmp.='<p'.$arg[1].'>'.$img.'</p>';
          }
          $tmp.='<p'.$arg[1].'><img src="'.$arg[4].'" />'.'</p>';
          if($img = strip_tags($arg[6],'<img><em>'))
          {
            $tmp.='<p'.$arg[1].'>'.$img.'</p>';
          }
          return $tmp;
        },
        $arg['d']);

        $arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i',[$this,'checkout_nofollow'],$arg['d']);
        # add title to image(alt)
        $arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?jarm.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2jarm.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);
        # remove title from image
        $arg['d']=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?jarm.com\/([^"]*)"([^\>]*)\>/i','<img\1 src="http://\4jarm.com/\5"\6>',$arg['d']);

        $split='<p';
        $blank=false;
        $detail=[];
        $serror=false;
        $last_txt='';
        $tmp=explode($split,$arg['d']);
        for($i=0;$i<count($tmp);$i++)
        {
          if(trim($tmp[$i]))
          {
            $d=trim($split.$tmp[$i]);
            $is_img=((stripos($d,'<img')!== false)?true:false);
            if(!$is_img)
            {
              $is_img=((stripos($d,'[embed-')!== false)?true:false);
              if(!$is_img)
              {
                $is_img=((stripos($d,'<iframe')!== false)?true:false);
              }
            }
            $pure_txt = trim(str_replace([' ','&nbsp;'],'',strip_tags($d,'<img><iframe>')));
            if(!$is_img)
            {
              if(!$pure_txt)
              {
                $blank=true;
                continue;
              }
            }
            if($blank)
            {
              $blank=false;
              if(count($detail)>0 && !$is_img)
              {
                $detail[]='<p> &nbsp; </p>';
              }
            }
            $detail[]=$d;
            $last_txt=$pure_txt;
          }
        }
        $arg['d']=implode("\r\n",$detail);

        $_cs=explode('_',trim($_POST['cate']));
        $arg['c']=intval($_cs[0]);
        $arg['cs']=intval($_cs[1]);
        $arg['cs2']=intval($_cs[2]);
        $arg['url']=mb_strtolower(trim($_POST['url']),'utf-8');
        $arg['exl']=intval($_POST['exlink']);
        $arg['tags']=array_values(array_filter(array_unique(array_map('trim',(array)$_POST['tags']))));
        if((mb_substr($arg['url'],0,4,'utf-8')!='http')&&$arg['exl'])
        {
          $arg['exl']=0;
        }
        if(Load::$my['am'])
        {
          $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);
          $arg['rc']=($_POST['recommend']?1:0);
          $arg['wt']=0;
        }
        elseif(isset($_POST['waiting']))
        {
          $arg['wt']=($_POST['waiting']?1:0);
        }

        if(!$arg['t'])
        {
          $error['title']='กรุณากรอกชื่อข่าว';
        }

        if((!$arg['d'])&&(!$arg['exl']))
        {
          $error['detail']='กรุณากรอกรายละเอียดข่าว';
        }
        elseif(mb_stripos($arg['d'],'kapook.com',0,'utf-8')>-1)
        {
          $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก kapook.com';
          $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
        }
        elseif(mb_stripos($arg['d'],'sanook.com',0,'utf-8')>-1)
        {
          $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก sanook.com';
          $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
        }
        elseif(mb_stripos($arg['d'],'akamaihd.net',0,'utf-8')>-1)
        {
          $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก akamaihd.net';
          $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
        }
        elseif(mb_stripos($arg['d'],'fbcdn.net',0,'utf-8')>-1)
        {
          $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก fbcdn.net';
          $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
        }
        if(!isset(Load::$conf['news'][$arg['c']]))
        {
          $error['category']='กรุณาเลือกชนิดของข่าว';
        }

        if(!count($error))
        {
          if($arg['pl'])
          {
            if(!$parent->news['ds'])
            {
              $arg['ds']=Load::Time()->now();
            }
            if(!$parent->news['di'])
            {
              $arg['di']=Load::Time()->now();
            }
          }
          $arg['de']=Load::Time()->now();
          if(!$parent->news['fd'])
          {
            $parent->news['fd'] = $arg['fd'] = date('Y/m/').$parent->news['_id'];
          }
          $db->update('news',['_id'=>$parent->news['_id']],['$set'=>$arg]);
          if($f=$_FILES['o']['tmp_name'])
          {
            $size=@getimagesize($f);
            switch (strtolower($size['mime']))
            {
              case 'image/gif':
              case 'image/jpg':
              case 'image/jpeg':
              case 'image/bmp':
              case 'image/wbmp':
              case 'image/png':
              case 'image/x-png':
                if($size[0]>=100 && $size[1]>=100)
                {
                  $q=Load::Upload()->post($parent->news['sv'],'news-post','@'.$f,['folder'=>$parent->news['fd']]);
                  if($q['status']=='OK')
                  {
                    $parent->news['img']=$q['data']['n'];
                    $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['img'=>$q['data']['n']]]);
                  }
                }
            }
          }

          $parent->news['c']=$arg['c'];
          $parent->news['cs']=$arg['cs'];

          if(!$parent->news['img'])
          {
            if($arg['pl'])
            {
              $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
              Load::move('/news/'.$parent->news['_id'].'?no-image');
            }
          }

          if((!in_array($arg['c'],[11,12,28,32])) && ($parent->news['_id']>53815))
          {
            if($arg['pl'])
            {
              $fig = explode('<img',str_replace(['[embed-','<iframe'],'<img',$arg['d']));
              if(count($fig)<7)
              {
                $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
                Load::move('/news/'.$parent->news['_id'].'?figure');
              }
              else
              {
                // 1,2,3,4,5
                $nocaption = -1;
                for($i=0;$i<count($fig)-1;$i++)
                {
                  if(preg_match('/<p([^>]*)>(.*?)<\/p>(.*?)<p/is',$fig[$i],$c))
                  {
                    $caption=trim(str_replace([' ','&nbsp;'],'',$c[2]));
                    if(empty($caption))
                    {
                      $nocaption = $i;
                      break;
                    }
                  }
                  else
                  {
                    $nocaption = $i;
                    break;
                  }
                }
                if($nocaption>-1)
                {
                  $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
                  Load::move('/news/'.$parent->news['_id'].'?caption='.($nocaption+1));
                }
                else
                {
                  $summary = mb_strlen(trim(str_replace([' ','&nbsp;'],'',strip_tags($fig[0]))),'utf-8');
                  if($summary>200)
                  {
                    $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['pl'=>0]]);
                    Load::move('/news/'.$parent->news['_id'].'?summary='.$summary);
                  }
                }
              }
            }
          }


          $parent->news=(new \Jarm\App\News\Service(['ignore'=>1]))->fetch(array_merge($parent->news,$arg));
          list($scheme,$key)=explode('://',$parent->news['link']);
          Load::$core->delete($key);
          if($arg['pl'])
          {
            if((!$parent->news['ds']) || Load::Time()->sec($parent->news['ds']) > (time()-3600))
            {
              list($host,$path)=explode('/',$key,2);
              Load::$core
                ->delete('jarm.com/home')
                ->delete('news.jarm.com/home')
                ->clear($host);
            }
          }

          Load::move('/news/'.$parent->news['_id'].'?completed');
        }
        else
        {
          $parent->news=array_merge($parent->news,$arg);
        }
      }
    }

    $parent->news['rc']=($parent->news['rc']??0);
    $parent->news['exl']=($parent->news['exl']??0);
    $parent->news['tags']=($parent->news['tags']??[]);
    return Load::$core
      ->assign('news',$parent->news)
      ->assign('error',$error)
      ->assign('user',Load::User()->get($parent->news['u']))
      ->fetch('control/news.update');
  }

  public function checkout_nofollow($arg)
  {
    if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(jarm|boxzaracing|doodroid|teededball|autocar)\.(.*)$/',$arg[1]))
    {
      return 	'<a href="'.$arg[1].'" target="_blank">';
    }
    elseif(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(google|youtube|facebook|liveleak|flyheight|weibo|dailymotion|instagram|twitter|pantip)\.(.*)$/',$arg[1]))
    {
      return 	'<a href="'.$arg[1].'" target="_blank" rel="nofollow">';
    }
    else
    {
      return 	'<a href="'.$arg[1].'" target="_blank" rel="nofollow">';
  //		return 	'<a href="https://out.jarm.com/#'.base64_encode($arg[1]).'" target="_blank">';
    }
  }
}
?>
