<?php
namespace Jarm\App\Feed;
use Jarm\Core\Load;

class Line
{
  public function __construct()
  {
    $db=Load::DB();
    $sitename = 'Jarm News';
    $siteurl = Load::uri(['news']);
    $arg=['dd'=>['$exists'=>false],'line'=>1,'pl'=>['$in'=>[1,2]],'c'=>['$nin'=>[8,11,25,28,29,35]],'ds'=>['$gte'=>Load::Time()->now(-3600*24*3)]];
    /*
    $arg['$and']=[
      ['d'=>['$not'=>new \MongoDB\BSON\Regex('\[embed\-','i')]],
      ['d'=>['$not'=>new \MongoDB\BSON\Regex('\<iframe','i')]]
    ];
    */
    $data=[];
    $skip=0;
    $limit=50;
    $space_img=5;
    $sort=['ds'=>-1];
    $start_time = Load::Time()->from('2016-12-16 15:30:00');

    if($tmp=(new \Jarm\App\News\Service(['ignore'=>1]))->find($arg,['_id'=>1,'u'=>1,'t'=>1,'d'=>1,'sv'=>1,'fd'=>1,'c'=>1,'cs'=>1,'da'=>1,'ds'=>1,'di'=>1,'de'=>1,'exl'=>1,'url'=>1],['sort'=>$sort,'skip'=>0,'limit'=>20]))
    {
      foreach($tmp as $v)
      {
        $link=$v['link'];

        $ct = $v['d'];
        $ct = str_replace('"//www.','"http://www.',$ct);
        $ct = str_replace(
                          ['http://s1.boxza.com','http://s2.boxza.com','http://s3.boxza.com','http://s4.boxza.com','http://f1.jarm.com','http://f2.jarm.com','http://f3.jarm.com','http://f4.jarm.com'],
                          ['https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com','https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com'],
                        $ct);
                        /*
        $ct = str_replace(
                          ['f1.jarm.com','f2.jarm.com','f3.jarm.com','f4.jarm.com'],
                          ['cache.jarm.com/f1','cache.jarm.com/f2','cache.jarm.com/f3','cache.jarm.com/f4'],
                        $ct);
                        */
        $ct = str_ireplace(['<br />','<br>','<br/>'],"\r\n",$ct);
        $ct = preg_replace_callback('/\<div([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/div\>/i',[$this,'call_div_img'],$ct);
        $ct = preg_replace_callback('/\<div([^\>]*)\>(.*)\<\/div\>/i',[$this,'call_div'],$ct);
        $ct = preg_replace('/\<div([^\>]*)\>/i','',$ct);
        $ct = preg_replace('/\<\/div\>/i','',$ct);

        $split='<p';
        $blank=false;
        $detail=[];
        $serror=false;
        $last_txt='';
        $tmp=explode($split,$ct);
        for($i=0;$i<count($tmp);$i++)
        {
          if(trim($tmp[$i]))
          {
            $d=trim(($i>0?$split:'').$tmp[$i]);
            if(stripos($d,$v['t'])!==false)
            {
              continue;
            }
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
              if(count($detail)>0 && !$is_img && !$last_img)
              {
                $detail[]='<p> &nbsp; </p>';
              }
            }
            $detail[]=$d;
            $last_txt=$pure_txt;
            $last_img=$is_img;
           }
        }
        $ct=implode("\r\n",$detail);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i',[$this,'call_img'],$ct);
  /*
        $ct = preg_replace('/\<p([^\>]*)\>(.*)\<iframe([^\>]+)src="([^"]+)"([^\<]+)\<\/iframe\>(.*)\<\/p\>/i','<p-remove><figure class="op-interactive">'."\r\n".'<iframe src="${4}" width="320" height="180"></iframe>'."\r\n".'</figure>',$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-youtube\]\=(.*)\<\/p\>/i',[$this,'call_youtube'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-instagram\]\=(.*)\<\/p\>/i',[$this,'call_instagram'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\]\=(.*)\<\/p\>/i',[$this,'call_facebook'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\-video\]\=(.*)\<\/p\>/i',[$this,'call_facebook_video'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\]\=(.*)\<\/p\>/i',[$this,'call_twitter'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\-video\]\=(.*)\<\/p\>/i',[$this,'call_twitter_video'],$ct);
  */
        /* begin - get count ads */
        $split='<p';
        $spl=explode($split,$ct);
        $lines=count($spl);
        for($i=0;$i<$lines;$i++)
        {
          if(strpos($spl[$i],'<image')!==false)
          {

            //$spl[$i].='<fb:ads><!--'.($ads_index+1).'#line:'.$i.'/'.($lines-1).'#img:'.$ads_img.'/'.$ads_imgs.'#txt-len:'.$ads_len.'#txt-line:'.$ads_txt.'#words:'.$ads_words.'-->';

          }
          else
          {
            $t=trim(str_replace(['<p-remove>','</p>'],'',$spl[$i]));
            if($t!="")
            {
              $z1=strpos($t,'<');
              $z2=strpos($t,'>');
              if(($z1>$z2)||($z1===false && $z2!==false))
              {
                $t=substr($t,$z2+1);
              }
              while(mb_substr($t,0,6,'utf-8')=='&nbsp;')
              {
                $t=trim(mb_substr($t,6,null,'utf-8'));
              }
              $spl[$i]='<text>
  <content>
  <![CDATA[
  '.$t.'
  ]]>
  </content>
  </text>
  ';
            }
          }
        }

        $ct = str_replace(['<p-remove>','-remove>','</p>'],'',implode('',$spl));

        preg_match('/http\:\/\/(.+)\.jarm\.com(.+)/i',$link,$page);
        $author = Load::User()->get($v['u']);

        $relate='';
        $rel=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['_id'=>['$lt'=>$v['_id']],'pl'=>1,'c'=>$v['c']],[],['limit'=>3]);
        for($o=0;$o<count($rel);$o++)
        {
          $n2=$rel[$o];
          $relate.='<article>
  <title><![CDATA[
  '.$n2['title'].'
  ]]></title>
  <url>'.$n2['link'].'</url>
  <thumbnail>'.$n2['img_t'].'</thumbnail>
  </article>
  ';
        }
        $data[]=[
          '_id'=>$v['_id'],
          'cate'=>$v['c'],
          'guid'=>'jarm.news.'.$v['_id'],
          'stats'=>Load::uri(['news','/stats/'.$v['_id']]),
          'page'=>'fb:'.$page[1],
          'title'=>$v['t'],
          'content'=>$ct,
          'author'=>$author['name'],
          'added'=>$v['ds'],
          'updated'=>($v['de']&&Load::Time()->sec($v['de'])>Load::Time()->sec($v['di']))?$v['de']:$v['di'],
          'description'=>mb_substr(trim(str_replace(['&nbsp;',' '],[' ',' '],strip_tags($v['d']))),0,250,'utf-8').'... <a href="'.$link.'" target="_blank">อ่านต่อ</a>',
          'image'=>Load::uri([Load::getServ($v['sv']),'/news/'.$v['fd'].'/m.jpg']),
          'link'=>$link,
          'pubDate'=>date('r',Load::Time()->sec($v['ds'])),
          'relate'=>$relate
        ];
      }
    }

    Load::$core->data['content']='<?xml version="1.0" encoding="UTF-8"?>
  <articles>
  <UUID>'.$data[0]['_id'].'</UUID>
  <time>'.(Load::Time()->sec($data[0]['added'])*1000).'</time>
  ';
    $now = time() * 1000;
    $three_day = (time() + (3600*24*31)) * 1000;
    for($i=0;$i<count($data);$i++)
    {
      $u = $data[$i]['updated']?$data[$i]['updated']:$data[$i]['added'];
      if(Load::Time()->sec($u) > Load::Time()->sec($start_time))
      {
        $update_time = $u;
      }
      else
      {
        $update_time = $start_time;
      }

  $cate = 'ทั่วไป';
  if(Load::$conf['news'][$data[$i]['cate']])
  {
    $cate=Load::$conf['news'][$data[$i]['cate']]['t'];
  }
  /*
  $cate_sub='';
  if($data[$i]['cate']==3)
  {
    $cate='Tech/Car';
    $cate_sub='';
  }
  elseif(in_array($data[$i]['cate'],[4,5,24,26]))
  {
    $cate='Entertainment';
    $cate_sub='';
  }
  elseif($data[$i]['cate']==27)
  {
    $cate='Fashion/Beauty';
    $cate_sub='';
  }
  elseif(in_array($data[$i]['cate'],[20,31,32,33,34]))
  {
    $cate='Lifestyle';
    $cate_sub='';
  }
  */
  Load::$core->data['content'].='<article>
  <ID>'.$data[$i]['_id'].'</ID>
  <nativeCountry>TH</nativeCountry>
  <language>TH</language>
  <publishCountries>
    <country>TH</country>
  </publishCountries>
  <startYmdtUnix>'.$now.'</startYmdtUnix>
  <endYmdtUnix>'.$three_day.'</endYmdtUnix>
  <title><![CDATA[
  '.$data[$i]['title'].'
  ]]></title>
  <category>'.$cate.'</category>
  <publishTimeUnix>'.(Load::Time()->sec($data[$i]['added'])*1000).'</publishTimeUnix>
  <publishTime>'.Load::Time()->from($data[$i]['added'],'datetime').'</publishTime>
  <updateTimeUnix>'.(Load::Time()->sec($update_time)*1000).'</updateTimeUnix>
  <updateTime>'.Load::Time()->from($update_time,'datetime').'</updateTime>
  <contents>
  '.$data[$i]['content'].'
  </contents>
  <author>'.$data[$i]['author'].'</author>
  <sourceUrl>'.$data[$i]['link'].'</sourceUrl>
  <recommendArticles>'.$data[$i]['relate'].'</recommendArticles>
  </article>';
  /*
  Load::$core->data['content'].='<item>
  <title><![CDATA['.$data[$i]['title'].']]></title>
  <content:encoded><![CDATA[
  <!doctype html>
  <html lang="th" prefix="op:http://media.facebook.com/op#">
  <head>
  <title>'.$data[$i]['title'].'</title>
  <meta charset="utf-8">
  <meta property="fb:article_style" content="default">
  <meta property="fb:use_automatic_ad_placement" content="false">
  <meta property="fb:likes_and_comments" content="enable">
  <meta property="fb:app_id" content="'.Load::$conf['social']['facebook']['appid'].'">
  <link rel="canonical" href="'.$data[$i]['link'].'">
  <author>'.$data[$i]['author'].'</author>
  </head>
  <body>
  <article>
  <header>
  <h1>'.$data[$i]['title'].'</h1>
  <address><a>'.$data[$i]['author'].'</a></address>
  <time class="op-published" dateTime="'.date('c',Load::Time()->sec($data[$i]['added'])).'">'.Load::Time()->from($data[$i]['added'],'datetime').'</time>
  <time class="op-modified" dateTime="'.date('c',Load::Time()->sec($update_time)).'">'.Load::Time()->from($update_time,'datetime').'</time>
  </header>
  '.$data[$i]['content'].'
  <footer>
    <aside><p>ติดต่อโฆษณา: 0880-900-800</p><p>อีเมล์: ads@jarm.com</p></aside>
    <small>&copy; 2016 jarm.com</small>
  </footer>
  <figure class="op-tracker"><iframe>
  <script type="text/javascript">
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");
  ga("create", "UA-31362918-1", "jarm.com");
  ga("send", "pageview", {title:"'.addslashes($data[$i]['title']).'"});</script><script type="text/javascript" src="'.$data[$i]['stats'].'"></script></iframe></figure>
  </article>
  </body>
  </html>
  ]]></content:encoded>
  <enclosure url="'.$data[$i]['image'].'" type="image/jpeg" />
  <link>'.$data[$i]['link'].'</link>
  <guid>'.$data[$i]['guid'].'</guid>
  <pubDate>'.$data[$i]['pubDate'].'</pubDate>
  </item>
  ';
  */
    }
    Load::$core->data['content'].='</articles>';



    while(@ob_end_clean());
    header('Content-Type: application/xml');
    echo Load::$core->data['content'];
    exit;
  }

  public function call_div($arg)
  {
    $txt = '';
    $center = trim(str_replace([' ','&nbsp;',"\r","\n"],'',$arg[2]));
    if(!empty($center))
    {
      $txt .= '<p>'.trim($arg[2]).'</p><!--call_div-->';
    }
    return $txt;
  }

  public function call_div_img($arg)
  {
    $txt = '';
    $left = trim(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($arg[2],'<img>')));
    if(!empty($left))
    {
      $txt .= '<p>'.trim(strip_tags($arg[2],'<img>')).'</p><!--call_div_img_left-->';
    }
    $right = trim(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($arg[6],'<img><em>')));
    if(substr($right,0,4)=='<em>' && substr($right,-5)=='</em>')
    {
        $txt .= '<p><img src="'.$arg[4].'">'.strip_tags($arg[6]).'</p><!--call_div_img_em-->';
    }
    else
    {
      $txt .= '<p><img src="'.$arg[4].'"></p><!--call_div_img-->';
      if(!empty($right))
      {
        $txt .= '<p>'.trim(strip_tags($arg[6],'<img>')).'</p><!--call_div_img_right-->';
      }
    }
    return $txt;
  }

  public function call_img($arg)
  {
    $txt = '';
    $left = trim(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($arg[2],'<img>')));
    if(!empty($left))
    {
      $txt .= '<p>'.trim(strip_tags($arg[2],'<img>')).'</p><!--call_img-->';
    }
    if($em = trim(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($arg[6]))))
    {
      $em = '<figcaption>'.trim(strip_tags($arg[6])).'</figcaption>';
    }
    else
    {
      $em = '';//'<!--img-caption-'.fix::$img_index.'-->';
    }
    $txt.='<p-remove><image>
  <url>'.$arg[4].'</url>
  <description>'.$em.'</description>
  </image>
  ';
  /*
  <text>
  <content> //Mandatory
  <![CDATA[ String // html
  string&lt;p&gt;&lt;a&gt;&lt;/a&gt;&lt;br/&gt;&lt;b/&gt;...&lt;/p&gt; ]]>
  </content>
  </text>
  */
    return $txt;
  }

}
?>
