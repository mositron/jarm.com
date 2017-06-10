
<div class="_bs"><div style="margin:4px">ผลลัพธ์ <?php echo $this->count?> รายการ</div><p class="clear"></p></div>

<div id="tbresult" class="row">
<?php for($i=0;$i<count($this->images);$i++):$v=$this->images[$i]?>
<div class="col-sm-2">


<?php if($v['rp']&&$v['img'])
    {
      $fbid='';
      $fburl = explode('/',$v['img']);
      if(count($fburl)>1)
      {
        $purl = explode('_',$fburl[count($fburl)-1]);
        if (count($purl) > 3)
        {
          $fbid = $purl[count($purl)-4].'_'. $purl[count($purl)-3];
        }
      }
?>
<a href="<?php echo str_replace($v['rp'],'/p600x600/',$v['img'])?>" target="_blank"><img src="<?php echo str_replace($v['rp'],'/s200x200/',$v['img'])?>"></a>
<?php
    }
    elseif($v['fd']&&$v['n'])
    {
      //$image[]=array('id'=>$v['_id'],'title'=>$v['p'],'fbid'=>(string)$v['fbid'],'thumbnail'=>'http://s2.jarm.com/fbimage/'.$v['fd'].'/'.$v['n'].'_s.jpg','image'=>'http://s2.jarm.com/fbimage/'.$v['fd'].'/'.$v['n'].'_n.jpg');
?>
<a href="<?php echo self::uri(['s3','/fbimage/'.$v['fd'].'/'.$v['n'].'_n.jpg'])?>" target="_blank"><img src="<?php echo self::uri(['s3','/fbimage/']).$v['fd'].'/'.$v['n'].'_s.jpg'?>" class="img-responsive"></a>

<?php
    }
?>
<p><?php echo $v['p']?></p>
<p><?php echo $v['dd']?'<span class="label label-warning">ซ่อน</span> <a href="javascript:;" onclick="adel('.$v['_id'].',1)" class="btn btn-xs btn-default">แสดง</a>':'<span class="label label-success">แสดง</span> <a href="javascript:;" onclick="adel('.$v['_id'].',0)" class="btn btn-xs btn-default">ซ่อน</a>'?></p>
</div>
<?php
endfor;
?>
</div>
<div align="center"><?php echo $this->pager?></div>
