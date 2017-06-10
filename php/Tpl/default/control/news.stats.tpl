<style>
.bn{display:inline-block; padding:0px; height:20px; line-height:20px; width:20px; overflow:hidden; text-align:center; background:#CBEFF2; color:#000; text-shadow:1px 1px 0px #fff; vertical-align:middle;}
.bn.bn-a,.bn.bn-a1{background:#F3CECE;}
.bn.bn-f,.bn.bn-a6{background:#F7EBE1;}
.bn.bn-h,.bn.bn-i,.bn.bn-h1{background:#D6D4F4;}
.bn.bn-h2,.bn.bn-h3{background:#F1C5F0;}
.bn.bn-b{background:#CCC;}
.bn.bn-b1,.bn.bn-b2,.bn.bn-l,.bn.bn-r{background:#F1F2CB;}

.table .r{width:250px; text-align:right;}

.devices{padding:0px; margin:0px;}
.devices li{height:22px; line-height:22px; border-bottom:1px dashed #eee; list-style:inside circle; padding:0px 5px; font-size:13px;}
.devices li:nth-child(even){background: #f5f5f5;}
.devices2 li:nth-child(even){background:none !important;}
.devices2 li:nth-child(odd){background:#f5f5f5;}

</style>

<ul class="breadcrumb">
<li><a href="/" title="ข่าว ข่าววันนี้">ข่าว</a></li>
<span class="divider">&raquo;</span>
<li><a href="/news">ระบบจัดการข้อมูล</a></li>
<span class="divider">&raquo;</span>
<li>สถิติ</li>
</ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">สถิติ</h2>

<table class="table" width="100%">
<tbody>
<tr><td class="r">ข่าว</td><td><?php echo $this->news['t']?></td></tr>
<tr><td class="r">รูปภาพ</td><td>
<img src="https://<?php echo $this->news['sv']?>.jarm.com/news/<?php echo $this->news['fd']?>/t.jpg" class="img-responsive"><br>
</td></tr>
<tr><td class="r">เขียนเมื่อ</td><td><?php echo self::Time()->from($this->news['da'],'datetime')?></td></tr>
<tr><td class="r">แสดงผลบนเว็บ</td><td><?php echo number_format(intval($this->news['do']))?> ครั้ง</td></tr>
<tr><td class="r">แสดงผลบน Instant Article</td><td><?php echo number_format(intval($this->news['is']))?> ครั้ง</td></tr>
<tr><td class="r">แสดงผลทั้งหมด</td><td><?php echo number_format(intval($this->news['do'])+intval($this->news['is']))?> ครั้ง</td></tr>
<tr><td class="r">การเผยแพร่</td><td><?php echo $this->news['pl']?'':'ไม่'?>แสดง</td></tr>
</tbody>
</table>

<?php if(self::$my && self::$my['am']>=9):?>
<div style="margin:10px">
    <h3 class="bar-heading">เพิ่มลดจำนวนการแสดงผล</h3>
    <div style="padding:5px 5px 2px; border-bottom:1px dashed #ccc; text-align:right">
      <input type="number" class="dm-do form-control" style="width:100px;padding:2px 5px;height:22px;vertical-align:middle;display:inline-block;" name="do" value="">
      <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','addview',$('.dm-do').val())" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
    </div>
    <div style="max-height:217px;" class="noscroll">
        <table class="table table-hover" width="100%">
            <thead><tr><th>จำนวน</th><th style="width:150px">โดย</th><th style="width:150px;text-align:right">เวลา</th></tr></thead>
            <tbody><?php $this->user=self::user();if($this->logs):?><?php foreach($this->logs as $v):?><?php $u=$this->user->get($v['u'],true);?><tr><td><?php echo $v['do']?></td><td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td><td class="w130 text-right"><span class="ago" datetime="<?php echo self::Time()->sec($v['da'])?>"><?php echo self::Time()->from($v['da'],'ago')?></span> ที่ผ่านมา</td></tr><?php endforeach?><?php endif?></tbody>
        </table>
    </div>
</div>
<?php endif?>
<br><br>
