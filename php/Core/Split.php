<?php
namespace Jarm\Core;

class Split
{
  public $f=[];
  public function __construct()
  {

  }
  public function get(string $url,int $start,array $all=[],array $allorder=[],array $allby=[]): array
  {
    $this->f=[];
    for($i=$start;$i<count(Load::$path);$i++)
    {
      if(in_array(Load::$path[$i],$all))
      {
        if($this->f[Load::$path[$i]]=Load::$path[$i+1])
        {
          if(Load::$path[$i]!='page')$url.=Load::$path[$i].'/'.Load::$path[$i+1].'/';
        }
        $i++;
      }
      elseif(preg_match('/^(['.implode('|',$all).']+)\-(.*)$/i',Load::$path[$i],$p))
      {
        $this->f[$p[1]]=$p[2];
        if($p[1]!='page')$url.=$p[1].'-'.$p[2].'/';
      }
    }
    if(count($allorder)>0)
    {
      $keyorder=array_keys($allorder);
      if((isset($this->f['order'])&&!array_key_exists($this->f['order'],$allorder))||!isset($this->f['order'])) $this->f['order']=$keyorder[0];
    }
    if(count($allby)>0)
    {
      $keyby=array_keys($allby);
      if((isset($this->f['by'])&&!array_key_exists($this->f['by'],$allby))||!isset($this->f['by'])) $this->f['by']=$keyby[0];
    }
    if(array_key_exists('page',$this->f)&&$this->f['page']<1) $this->f['page']=1;
    $this->f['url']=$url;
    return $this->f;
  }
}
?>
