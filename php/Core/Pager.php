<?php
namespace Jarm\Core;
class Pager
{
  public function __construct($key="default")
  {
  }

  public function navigation(int $rpp,int $count,$href='',?int &$page=1,?string $qstring=''): array
  {
    $fpage=$pager=$page1=$page2='';
    if(is_array($href))
    {
      $fpage=$href[1];
      $href=$href[0];
    }
    $pages=ceil($count/$rpp);
    if(is_null($page))
    {
      $page=1;
    }
    if($page=='last')$page=$pages;
    if($page>$pages)$page=$pages;
    if($page<1)$page=1;
    if($page>1)
    {
      $fp=($page-1);
      $page1='<li class="prev"><a href="'.$href.($fp>1?$fpage.$fp.$qstring:'').'"> ก่อนหน้า </a></li>';
    }
    if($page<$pages&&$pages>1)$page2='<li class="next"><a href="'.$href.$fpage.($page+1).$qstring.'"> ถัดไป </a></li>';
    if($count)
    {
      $pagerarr=[];
      $start_p=($page>5?$page-5:0);
      $stop_p=$start_p+10;
      for($i=1;$i<=$pages; $i++)
      {
        if (($i!=$pages&&$i!=1)&&($start_p>$i||$stop_p<$i))
        {
          if(!$dotted)$pagerarr[]='<li class="disabled"><a href="#">...</a></li>';
          $dotted=true;
          continue;
        }
        $dotted=false;
        if($i!=$page)
        {
          $fp=$href.($i>1?$fpage.$i.$qstring:'');
          $pagerarr[]='<li class="page"><a href="'.$fp.'">'.$i.'</a></li>';
        }
        else $pagerarr[]='<li class="active"><a href="#">'.$i.'</a><li>';
      }
      $pager=join("",$pagerarr);
    }
    $pagertop='<ul class="pagination">'.$page1.' '.$pager.' '.$page2.'</ul>';
    return [$pages>1?$pagertop:'',($page-1)*$rpp,$page];
  }
}
?>
