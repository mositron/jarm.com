<?php
namespace Jarm\Core;

class Html
{
  protected static $db=[];
  protected static $swfupload;
  public function __construct()
  {
  }
  public function tr($title,$fld,$value,$input='input',$prop=[],$arg=[],$arg2=[])
  {
    return '<tr><td class="colum">'.$title.':</td>'.$this->td($fld,$value,$input,$prop,$arg,$arg2).'</tr>';
  }
  public function td($fld,$value,$input='input',$prop=[],$arg=[],$arg2=[])
  {
    $func='';
    if(is_array($fld))
    {
      $func=' func="'.implode(',',$fld).'"';
      $fld=implode('_',$fld);
    }
    list($key,$val)=$this->form($fld,$value,$input,$prop,$arg,$arg2);
    if(isset($prop['enabled'])&&!$prop['enabled'])$val='';
    if(!$prop['tag'])$prop['tag']='td';
    return '<'.$prop['tag'].' class="'.(isset($prop['enabled'])&&!$prop['enabled']?'':'edit'.($prop['bclick']?'2':'')).($prop['class']?' '.$prop['class']:'').'"'.($prop['extra']?' '.$prop['extra']:'').($prop['width']?' width="'.$prop['width'].'"':'').''.($prop['title']?' title="'.$prop['title'].'"':'').''.($prop['height']?' height="'.$prop['height'].'"':'').''.($prop['align']?' align="'.$prop['align'].'"':'').''.($prop['full']?' full="'.$prop['full'].'"':'').((isset($prop['button'])&&!$prop['button'])?' nb="1"':'').((isset($prop['btdetail'])&&!$prop['btdetail'])?' nt="1"':'').($prop['colspan']?' colspan="'.$prop['colspan'].'"':'').'>'.$prop['text1'].'<span id="_'.$fld.'" ref="'.$input.'" sp="'.(isset($prop['space'])?'yes':'').'"'.$func.' class="ed">'.($key!=''?$key:'&nbsp;').'</span><strong id="_'.$fld.'_input" class="ed">'.$val.'</strong>'.$prop['text2'].($prop['text']?'<em class="ed">'.$prop['text'].'</em>':'').($prop['help']?'<div style="border:1px solid #ddd; background:#f5f5f5; padding:5px; margin-top:5px">'.$prop['help'].'</div>':'').'</'.$prop['tag'].'>';
  }
  public function form($fld,$value,$input='input',$prop=[],$arg=[],$arg2=[])
  {
    if(is_array($value))
    {
      $valshow = $value[0];
      $value = $value[1];
    }
    switch($input)
    {
      default:
        return [$valshow?$valshow:htmlspecialchars(isset($prop['number_format'])?number_format($value,$prop['number_format']):$value, ENT_NOQUOTES),'<input type="text" class="tbox" size="'.($prop['size']?$prop['size']:'30').'" id="tmp_'.$fld.'" name="tmp_'.$fld.'" value="'.htmlspecialchars($value, ENT_QUOTES).'"'.($prop['required']?' required':'').'>'];
        break;
      case 'textarea':
        return [$valshow?$valshow:nl2br(htmlspecialchars($value, ENT_NOQUOTES)),'<textarea class="tbox" cols="'.($prop['cols']?$prop['cols']:'50').'" rows="'.($prop['rows']?$prop['rows']:'5').'" id="tmp_'.$fld.'" name="tmp_'.$fld.'"'.($prop['required']?' required':'').'>'.htmlspecialchars($value, ENT_NOQUOTES).'</textarea>'];
      case 'date':
      case 'birth':
        if($input=='birth')
        {
          $arg['startyear']=date('Y')-120;
          $arg['stopyear']=date('Y')-10;
        }
        Load::Time();
        $html=$this->select2('tmp_'.$fld.'_day',date('j',Load::Time()->sec($value)),1,31,1,2,0,$prop);
        $html.='<select id="tmp_'.$fld.'_month" name="tmp_'.$fld.'_month" class="tbox"'.($prop['required']?' required':'').'>'.(isset($prop['space'])?'<option value="">'.$prop['space'].'</option>':'');
        $n = date('n',Load::Time()->sec($value));
        for($i=1;$i<=12;$i++)$html.='<option value="'.substr("0".$i,-2).'"'.($n==$i?' selected':'').'>'.Load::Time()->month[$i-1].'</option>';
        $html.="</select>\r\n";
        $Y = date('Y',Load::Time()->sec($value));
        $html.=$this->select2('tmp_'.$fld.'_year',$Y,($arg['startyear']?$arg['startyear']:date('Y')-1),($arg['stopyear']?$arg['stopyear']:date('Y')+1),-1,4,543,$prop);
        return [Load::Time()->from($value,'date'),$html];
      case 'time':
        Load::Time();
        return [Load::Time()->from($value,'time'),$this->select2('tmp_'.$fld.'_hh',intval(substr($value,0,2)),0,23,1,2,0,$prop).':'.$this->select2('tmp_'.$fld.'_nn',intval(substr($value,3,2)),0,59,1,2,0,$prop)];
      case 'datetime':
        $tmp=$this->form($fld,substr($value,0,10),'date',$prop,$arg);
        $tmp2=$this->form($fld,substr($value,11),'time',$prop,$arg);
        return [$tmp[0]?$tmp[0].' - '.$tmp2[0]:''.$tmp[1].' - '.$tmp2[1]];
      case 'select':
        if(!$arg&&$arg2['value'])
        {
          $arg=[];
          $l=explode("\n",trim($arg2['value']));
          for($i=0;$i<count($l);$i++)
          {
            $n=explode(',',$l[$i],2);
            $arg[$n[0]]=trim($n[1]);
          }
        }
        return $this->select(($prop['notmp']?'':'tmp_').$fld,$value,$prop,$arg);
      case 'checkbox':
        if(!$arg&&$arg2['value'])
        {
          $arg=[];
          $l=explode("\n",trim($arg2['value']));
          for($i=0;$i<count($l);$i++)
          {
            $n=explode(',',$l[$i],2);
            $arg[$n[0]]=trim($n[1]);
          }
        }
        return $this->checkbox(($prop['notmp']?'':'tmp_').$fld,$value,$prop,$arg);
    }
  }
  public function select2($fld,$value,$start,$stop,$step=1,$size=2,$incval=0,$prop=[])
  {
    for($i=$start;$i<=$stop;$i=$i+abs($step))
    {
      $html=($step>0?$html:'').'<option value="'.substr("0000".$i,-$size).'"'.($value!=''&&intval($value)==$i?' selected':'').'>'.substr("0000".($i+$incval),-$size).'</option>'.($step>0?'':$html);
    }
    return '<select id="'.$fld.'" name="'.$fld.'" class="tbox'.($prop['required']?' validate required':'').'"'.($prop['required']?' required':'').'>'.(isset($prop['space'])?'<option value="">'.$prop['space'].'</option>':'').$html.'</select>'."\r\n";
  }
  public function select($fld,$value,$prop=[],$arg=[])
  {
    $html='<select id="'.$fld.'" name="'.$fld.'" class="tbox'.($prop['required']?' validate required':'').'"'.($prop['required']?' required':'').'>';
    if(isset($prop['space']))
    {
      $html.='<option value="">'.$prop['space'].'</option>';
    }
    if(is_array($arg))
    {
      foreach($arg as $key=>$val)
      {
        if($key==$value)
        {
          $html.='<option value="'.$key.'" selected>'.$val.'</option>';
          $_value=$val;
        }
        else
        {
          $html.='<option value="'.$key.'">'.$val.'</option>';
        }
      }
    }
    $html.="</select>\r\n";
    return $prop['form']?$html:[(!$_value&&(!$prop['empty']&&!isset($prop['space']))?$value:$_value),$html];
  }
  public function checkbox($fld,$value,$prop=[],$arg=[])
  {
    $_value=array_map('trim',explode(',',$value));
    $html='';
    $c =' name="'.$k.($prop['form']?'[]':'').'"';
    $c .=' class="tbox '.$fld.' show-tooltip-w'.($e?' input_error':'').' '.$v['type'].'"';
    foreach($arg as $key=>$val)
    {
      $html.='<label><input type="checkbox" id="s_'.$fld.'" '.$c.' value="'.$key.'"'.(in_array($key,$_value)?' checked':'').'> '.$val.' </label>';
    }
    return $prop['form']?$html:[$value,$html];
  }
}
