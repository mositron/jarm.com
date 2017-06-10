<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{padding:5px 5px 0px 5px}
.table .d p{clear:both}
.table .a{ width:115px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
.table th.c,.table td.c{text-align:center;}
.table th.c .glyphicon{padding: 1px; background: #fff; font-size: 10px; border-radius: 2px; border: 1px solid #ccc;}



.onoffswitch {
    position: relative; width: 71px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
  display:inline-block;
  vertical-align:middle;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 0px solid #999999; border-radius: 0px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner > span {
    display: block; float: left; position: relative; width: 50%; height: 22px; padding: 0; line-height: 22px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner .onoffswitch-active {
    padding-left: 12px;
    background-color: #C2C2C2; color: #FFFFFF;
}
.onoffswitch-inner .onoffswitch-inactive {
    padding-right: 12px;
    background-color: #C2C2C2; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 38px; margin: 0px; text-align: center;
    border: 0px solid #999999;border-radius: 0px;
    position: absolute; top: 0; bottom: 0;
}
.onoffswitch-active .onoffswitch-switch {
    background: #47B507; left: 0;
}
.onoffswitch-inactive .onoffswitch-switch {
    background: #A1A1A1; right: 0;
}
.onoffswitch-active .onoffswitch-switch:before {
    content: " "; position: absolute; top: 0; left: 38px;
    border-style: solid; border-color: #47B507 transparent transparent #47B507; border-width: 11px 7px;
}
.onoffswitch-inactive .onoffswitch-switch:before {
    content: " "; position: absolute; top: 0; right: 38px;
    border-style: solid; border-color: transparent #A1A1A1 #A1A1A1 transparent; border-width: 11px 7px;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('/banner','delbanner',i)}});}
</script>


<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbanner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="150">ชื่อแบนเนอร์:</td><td align="left"><input type="text" name="title" size="35" class="tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<ul class="breadcrumb">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/banner"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์ทั้งหมด</a></li>
  <?php if($this->access):?>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbanner');"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a> &nbsp; &nbsp; </li>
  <?php endif?>
</ul>

<ul class="nav nav-tabs">
  <li<?php echo !$this->site?' class="active"':''?>><a href="/banner">ทั้งหมด</a></li>
  <?php foreach($this->position as $k=>$v):?>
  <li<?php echo $this->site==$k?' class="active"':''?>><a href="/banner/site-<?php echo $k?>"><?php echo $k?></a></li>
  <?php endforeach?>
</ul>


<table class="table" width="100%">
<tr>
    <?php foreach($this->allorder as $k=>$v):?>
    <th class="c"><?php echo $v?>
        <?php if($k==$this->order):?>
            <?php if($this->by!='asc'):?>
            <a href="/banner<?php echo $this->site?'/site-'.$this->site:''?>/order-<?php echo $k?>/by-asc"><span class="glyphicon glyphicon-menu-down"></span></a>
            <?php endif?>
            <?php if($this->by!='desc'):?>
            <a href="/banner<?php echo $this->site?'/site-'.$this->site:''?>/order-<?php echo $k?>/by-desc"><span class="glyphicon glyphicon-menu-up"></span></a>
            <?php endif?>
        <?php else:?>
            <a href="/banner<?php echo $this->site?'/site-'.$this->site:''?>/order-<?php echo $k?>/by-asc"><span class="glyphicon glyphicon-menu-down"></span></a>
            <a href="/banner<?php echo $this->site?'/site-'.$this->site:''?>/order-<?php echo $k?>/by-desc"><span class="glyphicon glyphicon-menu-up"></span></a>
        <?php endif?>
    </th>
    <?php endforeach?>
    <th class="c">สถานะ</th><th class="a c"></th></tr>
<?php for($i=0;$i<count($this->banner);$i++):?>
<tr class="l<?php echo $i%2?>">
<td class=""><?php echo $this->banner[$i]['t']?></td>
<td class="c"><?php echo self::Time()->from($this->banner[$i]['dt1'],'date')?></td>
<td class="c"><?php echo self::Time()->from($this->banner[$i]['dt2'],'date')?></td>
<td class="c"><?php echo number_format($this->banner[$i]['do']??0)?></td>
<td class="c"><span class="label label-<?php echo $this->banner[$i]['pl']?'success':'warning'?>"><?php echo $this->banner[$i]['pl']?'':'ไม่'?>แสดง</span></td>
<td class="a">
<a href="/banner/stats/<?php echo $this->banner[$i]['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
<?php if($this->access):?>
<a href="/banner/<?php echo $this->banner[$i]['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-wrench"></span></a>
<a href="javascript:;" onClick="cdel(<?php echo $this->banner[$i]['_id']?>)" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
<?php endif?>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="7" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
</div>
