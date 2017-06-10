
<div class="_bs"><div style="margin:4px">ผลลัพธ์ <?php echo $this->count?> รายการ</div><p class="clear"></p></div>
<div id="tbresult">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table">
<tr class="text-center">
<?php foreach($this->allorder as $key=>$val):?>
<th> &nbsp; <?php echo $val?></th>
<?php endforeach?>
<th></th>
    </tr>
<?php for($i=0;$i<count($this->app);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<?php foreach($this->allorder as $key=>$val):?>
<?php if($key=='p'):?>
<td width="60" class="tab_<?php echo $key?>"><?php if($this->app[$i]['img']):?><img src="https://s4.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg" style="width:60px"><?php endif?></td>
<?php elseif($key=='s'):?>
<td class="tab_<?php echo $key?>" width="100">
<?php if(!$this->app[$i]['pl']):?>
ไม่แสดง
<?php else:?>
<strong>กำลังเผยแพร่</strong>
<?php endif?>
</td>
<?php elseif($key=='t'):?>
<td class="tab_<?php echo $key?>"><?php echo $this->app[$i][$key]?>
<?php if($this->app[$i]['pl']):?>
<br><a href="https://guess.jarm.com/game/<?php echo $this->app[$i]['_id']?>" target="_blank">https://guess.jarm.com/game/<?php echo $this->app[$i]['_id']?></a>
<?php endif?>
<br><?php echo self::Time()->from($this->app[$i]['da'],'datetime')?>
</td>
<?php else:?>
<td class="tab_<?php echo $key?>"><?php echo $this->app[$i][$key]?></td>
<?php endif?>
<?php endforeach?>
    <td width="60" style="text-align:right">
    	<a href="/manage/<?php echo $this->app[$i]['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span></a>
      <a href="javascript:;" onClick="adel(<?php echo $this->app[$i]['_id']?>)" class="btn btn-mini btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
     </td>
   </tr>
<?php endfor?>
<?php if(!count($this->app)):?>
<tr><td colspan="<?php echo count($this->allorder)+1?>" valign="middle" height="200" class="text-center"><div style="text-align:center"><span style="color:#ddd; font-size:3จpx; letter-spacing:5px">- ไม่มีข้อมูล -</span></div></td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>



<style>
.tab__id{width:50px;}
.tab_s{font-weight:bold; color:#F60}
.tab_s strong{ color:#690}
.tab_s strong.ex{ color:#000}
.tab_t{ text-align:left}
.tab_s .cl{padding:5px; text-align:center; margin:5px 0px 0px 0px; border:1px solid #f0f0f0; background-color:#f8f8f8; color:#000; text-shadow:1px 1px 0px #fff; font-weight:normal}
.tbservice .l0 td,.tbservice .l1 td{border-left:1px solid #fff;border-top:1px solid #fff;}
.tbservice .l1 td{background-color:#fafafa;}
.tbservice .l0 td.tab_<?php echo $this->order?>{background-color:#f8f8f8;}
.tbservice .l1 td.tab_<?php echo $this->order?>{background-color:#f5f5f5;}
</style>