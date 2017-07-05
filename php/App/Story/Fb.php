<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;

class Fb extends Service
{
  public function get_fb()
  {
    $db=Load::DB();
    $sitename = 'Jarm Story';
    $siteurl = Load::uri(['story']);
    $arg=['dd'=>['$exists'=>false],'pl'=>['$in'=>[1,2]]];

    $data=[];
    $skip=0;
    $limit=100;
    $sort=['di'=>-1,'ds'=>-1];
    $start_time = Load::Time()->from('2017-06-28 11:30:00');

    if($tmp=$db->find('story_post',$arg,[],['sort'=>$sort,'skip'=>$skip,'limit'=>$limit]))
    {
      foreach($tmp as $v)
      {
        $link='https://story.jarm.com/'.$v['bl'].'/'.$v['_id'].'/'.$v['l'];
        $ct = $v['d'];
        $ct = str_replace('"//www.','"https://www.',$ct);
        $ct = str_replace(
                          ['http://s1.boxza.com','http://s2.boxza.com','http://s3.boxza.com','http://s4.boxza.com','http://f1.jarm.com','http://f2.jarm.com','http://f3.jarm.com','http://f4.jarm.com'],
                          ['https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com','https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com'],
                        $ct);
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
            $d=$this->call_em($d);
            $detail[]=$d;
            $last_txt=$pure_txt;
            $last_img=$is_img;
           }
        }
        $ct=implode("\r\n",$detail);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i',[$this,'call_img'],$ct);
        $ct = preg_replace('/\<p([^\>]*)\>(.*)\<iframe([^\>]+)src="([^"]+)"([^\<]+)\<\/iframe\>(.*)\<\/p\>/i','<figure class="op-interactive">'."\r\n".'<iframe src="${4}" width="320" height="180"></iframe>'."\r\n".'</figure>',$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-youtube\]\=(.*)\<\/p\>/i',[$this,'call_youtube'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-instagram\]\=(.*)\<\/p\>/i',[$this,'call_instagram'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\]\=(.*)\<\/p\>/i',[$this,'call_facebook'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\-video\]\=(.*)\<\/p\>/i',[$this,'call_facebook_video'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\]\=(.*)\<\/p\>/i',[$this,'call_twitter'],$ct);
        $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\-video\]\=(.*)\<\/p\>/i',[$this,'call_twitter_video'],$ct);

        $ct=preg_replace_callback('/<\/figure>(\s+)<!--caption-(.+)-->/i',[$this,'call_convert_em'],$ct);
        $ct=preg_replace('/<!--caption-(.+)-->/i','<p><em>${1}</em></p>',$ct);

        $author=Load::User()->get($v['u']);
        $data[]=[
          'guid'=>'jarm.story.'.$v['_id'],
          'stats'=>Load::uri(['story','/stats/'.$v['_id']]),
          'title'=>$v['t'],
          'content'=>$ct,
          'author'=>$author['name'],
          'added'=>$v['ds'],
          'no_ads'=>$v['na'],
          'updated'=>($v['de']&&Load::Time()->sec($v['de'])>Load::Time()->sec($v['di']))?$v['de']:$v['di'],
          'description'=>mb_substr(trim(str_replace(['&nbsp;',' '],[' ',' '],strip_tags($v['d']))),0,250,'utf-8').'... <a href="'.$link.'" target="_blank">อ่านต่อ</a>',
          'image'=>(count($v['img'])>0?Load::uri([Load::getServ($v['sv']),'/story/'.$v['fd'].'/'.$v['img'][0]]):''),
          'link'=>$link,
          'pubDate'=>date('r',Load::Time()->sec($v['ds']))
        ];
      }
    }

    Load::$core->data['content']='<?xml version="1.0" encoding="UTF-8"?>
  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
  <title>'.$sitename.' | '.$skip.'</title>
  <description><![CDATA[Jarm Story]]></description>
  <link>'.$siteurl.'</link>
  ';
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
  Load::$core->data['content'].='<item>
  <title><![CDATA['.$data[$i]['title'].']]></title>
  <content:encoded><![CDATA[
  <!doctype html>
  <html lang="th" prefix="op:http://media.facebook.com/op#">
  <head>
  <title>'.$data[$i]['title'].'</title>
  <meta charset="utf-8">
  <meta property="fb:article_style" content="default">
  '.($data[$i]['no_ads']?'':'<meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default">').'
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
    <time class="op-modified" dateTime="'.date('c',Load::Time()->sec($update_time)).'">'.Load::Time()->from($update_time,'datetime').'</time>';
    if(!$data[$i]['no_ads'])
    {
      Load::$core->data['content'].='<section class="op-ad-template">';
      foreach ($conf['social']['facebook']['audience'] as $v)
      {
        Load::$core->data['content'].='<figure class="op-ad"><iframe width="300" height="250" style="border:0; margin:0;" src="https://www.facebook.com/adnw_request?placement='.$v.'&adtype=banner300x250"></iframe></figure>';
      }
      Load::$core->data['content'].='</section>';
    }
  Load::$core->data['content'].='
  </header>
  '.$data[$i]['content'].'
  <footer>
    <aside><p>ติดต่อโฆษณา: 0880-900-800</p><p>อีเมล์: ads@jarm.com</p></aside>
    <small>&copy; 2017 jarm.com</small>
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
    }
    Load::$core->data['content'].='</channel>
  </rss>';

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
    $txt.='<figure data-feedback="fb:likes, fb:comments"><img src="'.$arg[4].'" />'.$em.'</figure>';
    return $txt;
  }
  public function call_em($d)
  {
    $left = trim(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($d,'<img><em>')));
    if(substr($left,0,4)=='<em>')
    {
      return '<!--caption-'.trim(strip_tags($d)).'-->';
    }
    return $d;
  }
  public function call_convert_em($arg)
  {
    //$ct = preg_replace_callback('/<\/figure>(\s+)<!--caption-(.+)-->/is',[$this,'call_convert_em'],$ct);
    return '<figcaption>'.$arg[2].'</figcaption></figure>';
  }
  public function charlen($str)
  {
    return mb_strlen(
            trim(
              preg_replace('!\s+!', ' ',
                str_replace('&nbsp;',' ',strip_tags($str))
              )
            ),
            'utf-8'
          );
  }
  public function str_word_count_utf8($str)
  {
    return count(
            preg_split('~[^\p{L}\p{N}\']+~u',
              preg_replace('!\s+!', ' ',
                str_replace('&nbsp;',' ',strip_tags($str))
              )
            )
          );
  }

  public function call_ads($txt)
  {
    $tmp = '';
    if(isset(Load::$conf['tmp']['ads'][Load::$conf['tmp']['cur']]))
    {
      $tmp = Load::$conf['tmp']['ads'][Load::$conf['tmp']['cur']]."\r\n";
    }
    Load::$conf['tmp']['cur']++;
    return $tmp;
  }
  public function call_instagram($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(substr($link,0,4)=='http')
    {
      return '<figure class="op-interactive"><iframe><blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="6" style="width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><a href="'.$link.'" target="_blank"></a></blockquote><script async defer src="https://platform.instagram.com/en_US/embeds.js"></script></iframe></figure>';
    }
    else
    {
      return '<p>[embed-instagram]='.$txt[3].'</p>';
    }
  }
  public function call_youtube($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(preg_match('#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x',$link,$c))
    {
      return '<figure class="op-interactive"><iframe src="https://www.youtube.com/embed/'.$c[2].'" width="320" height="180"></iframe></figure>';
    }
    else
    {
      return '<p>[embed-youtube]='.$txt[3].'</p>';
    }
  }
  public function call_facebook($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(substr($link,0,4)=='http')
    {
      return '<figure class="op-interactive"><iframe>
      <div class="fb-post" data-href="'.$link.'"></div><div id="fb-root"></div>
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.9&appId=678076615655643";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, \'script\', \'facebook-jssdk\'));</script>
      </iframe></figure>';
    }
    else
    {
      return '<p>[embed-facebook]='.$txt[3].'</p>';
    }
  }
  public function call_facebook_video($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(substr($link,0,4)=='http')
    {
      return '<figure class="op-interactive"><iframe src="https://www.facebook.com/plugins/video.php?href='.urlencode($link).'" width="320" height="180"></iframe></figure>';
    }
    else
    {
      return '<p>[embed-facebook-video]='.$txt[3].'</p>';
    }
  }

  public function call_twitter($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(substr($link,0,4)=='http')
    {
      return '<figure class="op-interactive"><iframe>
      <blockquote class="twitter-tweet" data-lang="th"><a href="'.$link.'"></a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
      </iframe></figure>';
    }
    else
    {
      return '<p>[embed-twitter]='.$txt[3].'</p>';
    }
  }
  public function call_twitter_video($txt)
  {
    $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
    if(substr($link,0,4)=='http')
    {
      return '<figure class="op-interactive"><iframe>
      <blockquote class="twitter-video" data-lang="th"><a href="'.$link.'"></a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
      </iframe></figure>';
    }
    else
    {
      return '<p>[embed-twitter-video]='.$txt[3].'</p>';
    }
  }
}
?>
