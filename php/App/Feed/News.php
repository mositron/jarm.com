<?php
namespace Jarm\App\Feed;
use Jarm\Core\Load;

class News
{
  public function __construct($cate=[])
  {
    $formats=[
      ''=>'json',
      'json'=>'json',
      'xml'=>'xml',
      'rss'=>'rss',
      'iframe'=>'iframe'
    ];
    if(isset($formats[Load::$path[1]]))
    {
      $format=$formats[Load::$path[1]];
    }
    else
    {
      Load::move('/',true);
    }
    
    Load::cache();
    $db=Load::DB();
    $sitename = 'Jarm News';
    $siteurl = Load::uri(['news']);
    $arg=['dd'=>['$exists'=>false],'pl'=>1];
    if(count($cate)>=1)
    {
      $arg['c']=$cate[0];
      if(isset(Load::$conf['news'][$arg['c']]))
      {
        $sitename=Load::$conf['news'][$arg['c']]['t'];
        if(Load::$conf['news'][$arg['c']]['sl'])
        {
          $siteurl=Load::$conf['news'][$arg['c']]['sl'];
        }
      }
    }
    else
    {
      $arg['c']=['$nin'=>[11,12]];
    }
    if(count($cate)>=2)
    {
      $arg['cs']=$cate[1];
    }


    $data=[];
    if($tmp=(new \Jarm\App\News\Service(['ignore'=>1]))->find($arg,['_id'=>1,'t'=>1,'d'=>1,'sv'=>1,'fd'=>1,'c'=>1,'cs'=>1,'da'=>1,'exl'=>1,'url'=>1],['sort'=>['_id'=>-1],'limit'=>50]))
    {
      foreach($tmp as $v)
      {
        $link=$v['link'];
        $data[]=[
          'guid'=>$v['_id'],
          'title'=>$v['t'],
          'description'=>mb_substr(trim(str_replace(['&nbsp;',' '],[' ',' '],strip_tags($v['d']))),0,250,'utf-8').'... <a href="'.$link.'" target="_blank">อ่านต่อ</a>',
          'image'=>'https://'.$v['sv'].'.jarm.com/news/'.$v['fd'].'/s.jpg',
          'link'=>$link,
          'pubDate'=>date('r',Load::Time()->sec($v['da']))
        ];
      }
    }
    if($format=='json')
    {
      Load::$core->data['content']=json_encode(['type'=>'news','category'=>$cate,'updated'=>date('r'),'format'=>$format,'data'=>$data]);
    }
    elseif($format=='rss'||$format=='xml')
    {
      Load::$core->data['content']='<?xml version="1.0" encoding="UTF-8"?>
  <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
  <title>'.$sitename.'</title>
  <description><![CDATA[
  ข่าว ข่าวเด่น ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย อัพเดทเรื่องอินเทรนด์
  ]]></description>
  <copyright>jarm.com</copyright>
  <language>th-th</language>
  <link>'.$siteurl.'</link>
  <lastBuildDate>'.date('r').'</lastBuildDate>
  <generator>Jarm Feed</generator>
  <ttl>15</ttl>
  <image>
  <url>https://cdn.jarm.com/img/global/logo.png</url>
  <title>'.$sitename.'</title>
  <link>'.$siteurl.'</link>
  <description><![CDATA[
  ข่าว ข่าวเด่น ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย อัพเดทเรื่องอินเทรนด์
  ]]></description>
  <width>600</width>
  <height>360</height>
  </image>
  <atom:link href="'.URI.'" rel="self" type="application/rss+xml" />
  ';
      for($i=0;$i<count($data);$i++)
      {
        Load::$core->data['content'].='<item>
  <title><![CDATA['.$data[$i]['title'].'
  ]]></title>
  <description><![CDATA[
  '.$data[$i]['description'].'
  ]]></description>
  <enclosure url="'.$data[$i]['image'].'" type="image/jpeg" />
  <link>'.$data[$i]['link'].'</link>
  <guid>'.$data[$i]['link'].'</guid>
  <pubDate>'.$data[$i]['pubDate'].'</pubDate>
  </item>
  ';
      }
      Load::$core->data['content'].='</channel>
  </rss>';
    }

    while(@ob_end_clean());
    if($format=='json')
    {
      header('Content-type: application/json');
      if(Load::$path[2])
      {
        echo Load::$path[2].'('.Load::$core->data['content'].')';
      }
      else
      {
        echo Load::$core->data['content'];
      }
    }
    elseif($format=='rss'||$format=='xml')
    {
      header('Content-Type: application/xml');
    //	header('Content-Type: application/rss+xml; charset=utf-8');
      echo Load::$core->data['content'];
    }
    exit;
  }
}
?>
