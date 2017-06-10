<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class Trend extends Service
{
  public function get_trend()
  {
    $db=Load::DB();
/*
    $l = $db->find('trend_key');
    for($i=0;$i<count($l);$i++)
    {
      $db->update('trend_key',['_id'=>$l[$i]['_id']],['$set'=>['lkey'=>mb_strtolower($l[$i]['key'],'utf-8')]]);
    }
*/
    $html=Load::Http()->get('https://www.google.co.th/trends/hottrends/atom/feed?pn=p33');

    $time=time();
    $words=[];
    # https://www.google.co.th/trends/hottrends/atom/feed?pn=p33

    $trends = new \SimpleXmlElement($html);

     foreach($trends->channel->item as $v)
     {
       $v2=$v->children('ht', true);
       $key = [
         'key'=>trim(strval($v->title)),
         'lkey'=>mb_strtolower(trim(strval($v->title)),'utf-8'),
         'desc'=>trim(strval($v->description)),
         'date'=>intval(date('Ymd',strtotime(strval($v->pubDate)))),
         'img'=>strval($v2->picture),
         'count'=>intval(str_replace([',','+',],'',strval($v2->approx_traffic))),
        'pl'=>1,
      ];
      $words[]=$key;
     }

    if(count($words)>0 && $words[0]['date'])
    {
        $db->update('trend_key',['date'=>$words[0]['date']],['$set'=>['pl'=>0]]);
    }

    $wc = count($words);
    $cin = 0;
    for($i=0;$i<$wc;$i++)
    {
      $words[$i]['time']=Load::Time()->from($time+$wc-$i);
      if($find=$db->findone('trend_key',['lkey'=>$words[$i]['lkey']]))
      {
        if($find['dd'])
        {
          $words[$i]['deleted']=true;
        }
        else
        {
          $wset = $words[$i];
          unset($wset['key'],$wset['lkey']);
          if($find['date']<$words[$i]['date'])
          {
            $words[$i]['insert']=true;
          }
          else
          {
            unset($wset['date']);
          }
          $db->update('trend_key',['_id'=>$find['_id']],['$set'=>$wset]);
          $words[$i]['_id']=$find['_id'];
        }
      }
      else
      {
        $words[$i]['_id']=$db->insert('trend_key',$words[$i]);
        $words[$i]['insert']=true;
      }


      if((!$words[$i]['deleted']) && (($cin<2) || $words[$i]['insert']))
      {
        $search = get_search($words[$i]['lkey']);
        for($j=0;$j<count($search);$j++)
        {
          if($news=$db->findone('trend_news',['url'=>$search[$j]['url']]))
          {
            if(!in_array($words[$i]['lkey'],$news['key']))
            {
                $db->update('trend_news',['_id'=>$news['_id']],['$push'=>['key'=>$words[$i]['lkey']]]);
            }
          }
          else
          {
            $search[$j]['du']=Load::Time()->from('2015-01-01 00:00:00');
            $db->insert('trend_news',$search[$j]);
          }
        }
        $cin++;
      }
    }
    exit;
  }
}
?>
