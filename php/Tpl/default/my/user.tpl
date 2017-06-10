<?php /*<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/jarm.user.css">*/?>
<div class="col-content">
  <ul class="breadcrumb">
    <li><a href="/">แผงควบคุม</a></li>
    <li class="active"><a href="<?php echo $this->profile['link']?>">โปรไฟล์</a></li>
  </ul>
  <?php if($this->my['am'] && intval($this->my['am'])>=9):?>
    <div style="padding:5px 5px; border:1px solid #FFF5D2; background:#FFFDEA; margin-bottom:5px;">
        <h4 align="center">ข้อมูลสำหรับแอดมิน (lv. 9+)</h4>
        <div style="padding:2px 5px"> ID: <?php echo $this->profile['_id']?><br>
            อีเมล์: <?php echo $this->profile['em']?><br>
            สิทธิ์ของผู้ดูแล: <?php echo intval($this->profile['am'])?><br>
            ยืนยันอีเมล์/เฟสบุ๊ค:
            <?php if($this->profile['st']):?>
            ยืนยันสมัครสมาชิกแล้ว
            <?php else:?>
            ยังไม่ยืนยัน -
            <input type="button" class="button" value=" ยืนยันการสมัครสมาชิกให้บุคคลนี้ " onClick="_.box.confirm({title:'ยืนยันการสมัครสมาชิก',detail:'ต้องการยืนยันการสมัครสมาชิกให้บุคคลนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','setverify')}})">
            <?php endif?>
            <br>
            IP:
            <?php $ip=(is_array($this->profile['ip'])?array_keys($this->profile['ip']):[$this->profile['ip']])?>
            <?php foreach($ip as $v):?>
            <a href="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress=<?php echo $v?>" target="_blank"><?php echo $v?></a><br>
            <?php endforeach?>
        </div>
        <div style="padding:5px; background:#FFF5D2">
            <input type="button" class="button" value="เพื่อนแนะนำ" onClick="_.box.confirm({title:'ตั้งเป็นเพื่อนแนะนำ',detail:'คุณต้องการตั้งสมาชิกนี้เป็นเพื่อนแนะนำหรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','setrec')}})">
            <input type="button" class="button" value="เพิ่มบ๊อก" onClick="_.box.load('/dialog/point/<?php echo $this->profile['_id']?> #add_point')">
            <?php if(intval($this->my['am'])>=9):?>
            <input type="button" class="button" value=" แบนสมาชิก " onClick="if(confirm('ต้องการแบนสมาชิกนี้หรือไม่'))_.box.confirm({title:'แบนสมาชิก',detail:'คุณต้องการแบนสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','setban')}});">
            <?php endif?>
            <input type="button" class="button" value="ลบรูปโปรไฟล์" onClick="_.box.confirm({title:'ลบรูปภาพโปรไฟล์',detail:'คุณต้องการลบรูปภาพโปรไฟล์ของสมาชิกนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','resetavatar')}})">
            <?php if(intval($this->my['am'])>=9):?>
            <input type="button" class="button" value="ซ่อนโพสทั้งหมด" onClick="_.box.confirm({title:'ซ่อนโพสทั้งหมดต่อสาธารณะชน',detail:'ต้องการซ่อนโพสทั้งหมดของบุคคลนี้ ไม่ให้สมาชิกคนอื่นที่ไม่ใช่เพื่อนเห็นหรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','sethideall')}});">
            <?php endif?>
        </div>
    </div>
    <?php endif?>
    <style>
.pf { min-height:100px !important}

.pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}

.pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
.pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}
</style>
    <div>
        <div style="position:relative">
            <table width="100%" class="tbservice" cellpadding="5" cellspacing="0" border="0">
              <tr>
                  <td class="colum"></td>
                    <td>
                <img src="<?php echo $this->profile['img-n']?>" class="img-uid-my" alt="<?php echo $this->profile['name']?>">
                </td>
                </tr>
                <tr>
                    <td class="colum">ชื่อ: </td>
                    <td><?php echo $this->profile['name']?></td>
                </tr>
                <tr>
                    <td class="colum">คะแนนโหวต: </td>
                    <td><?php echo number_format(intval($this->profile['pf']['vt']['m']))?> / <?php echo number_format(intval($this->profile['pf']['vt']['a']))?> (คะแนนประจำเดือนนี้/คะแนนทั้งหมด)</td>
                </tr>
                <?php
if($this->pf[0]['gd']):
echo '<tr><td class="colum">เพศ: </td><td><span>'.$this->pf[0]['gd'].'</span></td></tr>';
endif;
if($this->pf[0]['rl']):
echo '<tr><td class="colum">สถานะความสัมพันธ์: </td><td><span>'.$this->pf[0]['rl'].'</span></td></tr>';
endif;
if($this->pf[0]['bd']):
echo '<tr><td class="colum">วันเกิด: </td><td><span>'.$this->pf[0]['bd'].'</span></td></tr>';
endif;
if($this->pf[0]['pr']):
echo '<tr><td class="colum">จังหวัด: </td><td><span>'.$this->pf[0]['pr'].'</span></td></tr>';
endif;
?>
                <tr>
                    <td class="colum">ของขวัญ: </td>
                    <td><?php if($this->gift):?>
                        <div>
                            <?php foreach($this->gift as $v):$p=$this->user->get($v['p']);?>
                            <img src="https://s1.jarm.com/gift/64/<?php echo $v['gf']?>.png" class="show-tooltip-s" alt="" title="<strong><?php echo $v['n']?><strong><br>มอบโดย <?php echo $p['name']?>">
                            <?php endforeach?>
                        </div>
                        <?php endif?>
                        <?php if($this->profile['_id']!=$this->my['_id']):?>
                        <input type="button" class="button" value=" ส่งของขวัญให้ <?php echo $this->profile['name']?>" onClick="!_.my?_.box.alert('กรุณาล็อคอิน'):_.box.load('/dialog/gift/<?php echo $this->profile['_id']?> #gift_send')">
                        <?php endif?>
                        <div style=" padding:5px; color:#c00"><strong>ของขวัญ</strong> จะหายไปทันทีเมื่อหมดอายุ</div></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="background:#f0f0f0; text-align:center; font-weight:bold;">Friends Collection</td>
                </tr>
                <?php if($this->profile['st']>=1):?>
                <?php if($this->profile['pet']):;?>
                <?php if($this->profile['pet']['own']): $own=$this->user->get($this->profile['pet']['own']);?>
                <tr>
                    <td class="colum">เจ้าของ: </td>
                    <td><a href="/user/<?php echo $own['link']?>" class="h"> <img src="<?php echo $own['img']?>" style="width:24px; vertical-align:middle"> <?php echo $own['name']?></a></td>
                </tr>
                <?php endif?>
                <?php if($this->profile['pet']['col']&&count($this->profile['pet']['col'])>0):?>
                <tr>
                    <td class="colum">Collection: </td>
                    <td><?php if($this->profile['_id']==$this->my['_id']):?>
                        <?php $j=0;foreach($this->profile['pet']['col'] as $v): if($co=$this->user->get($v)):?>
                        <p><a href="/user/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a> - ค่าตัว <?php echo $co['pet']['price']?> บ๊อก (<a href="javascript:;" onClick="_.box.confirm({title:'ขายคืนให้ Jarm',detail:'คุณสามารถขายคืนได้ในราคา 30% จากราคาล่าสุดเท่านั้น ต้องการดำเนินการต่อหรือไม่',click:function(){_.ajax.gourl('/<?php echo $this->profile['link']?>','sellpet',<?php echo $co['_id']?>);}})">ขายคืน</a>)</p>
                        <?php endif;endforeach;?>
                        <?php else:?>
                        <?php $j=0;foreach($this->profile['pet']['col'] as $v): if($co=$this->user->get($v)):?>
                        <?php echo $j>0?', ':''?><a href="/user/<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a>
                        <?php $j++;endif;endforeach;?>
                        <?php endif?></td>
                </tr>
                <?php endif?>
                <?php endif?>
                <tr>
                    <td class="colum">ค่าตัว: </td>
                    <td><strong><?php echo number_format(max($this->profile['pet']['price'],10))?></strong> บ๊อก</td>
                </tr>
                <?php if($this->profile['_id']!=$this->my['_id']):?>
                <tr>
                    <td></td>
                    <td><input type="button" class="button blue" value=" ซื้อ <?php echo $this->profile['name']?> " onClick="_.box.confirm({title:'ซื้อเป็น Collection',detail:'คุณต้องการซื้อบุคคลนี้ในราคา <?php echo number_format(max($this->profile['pet']['price'],10))?> บ๊อกหรือไม่<div style=\'padding:5px;border:1px solid #e0e0e0;margin:5px 0px\'><strong>กติกา</strong><br>- ทุกการซื้อ 1 ครั้ง มูลค่าคนที่ถูกซื้อจะเพิ่มไป 40%<br>- หากมีคนมาซื้อต่อคุณ คุณจะได้กำไร 10% จากราคาที่เคยซื้อไว้<br>- คนที่ถูกซื้อจะได้ประมาณ 7% ของราคาที่ถูกซื้อ<br><br>หากไม่พอใจ สามารถขายคืนเข้า Boxza ได้ บ๊อกคืน 30% ของราคาล่าสุด<br><br>ขอให้สนุกกับ Friend\’s Collection ของ Boxza นะครับ</div>',click:function(){_.ajax.gourl('<?php echo URL?>','buypet');}})"></td>
                </tr>
                <?php endif?>
                <?php else:?>
                <tr>
                    <td class="colum">ค่าตัว: </td>
                    <td>- ไม่สามารถตีราคาได้ เรื่องจากบุคคลนี้ยังไม่ยืนยันการสมัครสมาชิก - </td>
                </tr>
                <?php endif?>
                <tr>
                    <td class="colum">แนะนำตัว: </td>
                    <td><?php echo !empty($this->profile['pf']['if'])?nl2br($this->profile['pf']['if']):'-'?></td>
                </tr>
                <tr>
                    <td class="colum">โปรไฟล์ลิ้งค์: </td>
                    <td><a href="<?php echo $this->profile['link']?>"><?php echo $this->profile['link']?></a></td>
                </tr>
                <tr>
                    <td class="colum">บ๊อก/เครดิต: </td>
                    <td><?php echo number_format(intval($this->profile['cd']['p']))?> บ๊อก</td>
                </tr>
                <tr>
                    <td class="colum">บั๊ก/คะแนน: </td>
                    <td><?php echo number_format(intval($this->profile['if']['ch']['sc']))?> บั๊ก</td>
                </tr>
                <tr>
                    <td class="colum">Facebook: </td>
                    <td> <?php if($this->profile['sc']['fb']['id']):?><a href="https://www.facebook.com/<?php echo $this->profile['sc']['fb']['id']?>" target="_blank"><?php echo $this->profile['sc']['fb']['id']?></a><?php else:?>-<?php endif?></td>
                </tr>
                <tr>
                    <td class="colum">Twitter: </td>
                    <td> <?php if(isset($this->profile['sc']['tw']['id'])):?><a href="https://twitter.com/<?php echo $this->profile['sc']['tw']['name']?>" target="_blank"><?php echo $this->profile['sc']['tw']['name']?></a><?php else:?>-<?php endif?></td>
                </tr>
                <tr>
                    <td class="colum">Google+: </td>
                    <td> <?php if(isset($this->profile['sc']['gg']['id'])):?><a href="https://plus.google.com/<?php echo $this->profile['sc']['gg']['id']?>" target="_blank"><?php echo $this->profile['sc']['gg']['name']?></a><?php else:?>-<?php endif?></td>
                </tr>
                <tr>
                    <td class="colum">สมัครสมาชิกเมื่อ: </td>
                    <td><?php echo self::Time()->from($this->profile['da'],'datetime')?></td>
                </tr>
                <tr>
                    <td class="colum">ออนไลน์ล่าสุด: </td>
                    <td><?php echo self::Time()->from($this->profile['du'],'datetime')?></td>
                </tr>
            </table>
            <div style="position: absolute;top: 2px;right: 2px;text-align: center;border: 1px solid #DDD;padding: 5px;border-radius: 5px; background-color:#fff;">
                <p>คะแนนโหวต</p>
                <span id="vresult" class="vresulf-<?php echo mb_strlen(intval($this->profile['pf']['vt']['m']),'utf-8')?>"><?php echo number_format(intval($this->profile['pf']['vt']['m']))?></span>
                <p><span class="v-plus show-tooltip-s" onClick="_.ajax.gourl('<?php echo URL?>','vote','+')" title="โหวตเพิ่มคะแนน"><i></i></span><span class="v-minus show-tooltip-s" onClick="_.ajax.gourl('<?php echo URL?>','vote','-')" title="โหวตลบคะแนน"><i></i></span></p>
            </div>
        </div>
    </div>
</div>
<script>
$('._pf-av,._pf-hd').hover(function(){$(this).find('.chg-img').css('display','inline-block');},function(){$(this).find('.chg-img').css('display','none');});
</script>
