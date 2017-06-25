<ul class="breadcrumb">
  <li><a href="<?php echo self::uri(['blockly','/'])?>" title="Blockly"><span class="glyphicon glyphicon-home"></span> Blockly</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="<?php echo $this->ncate['sl']?:self::uri(['blockly','/create'])?>" title="สร้างเกมใหม่">สร้างเกมใหม่</a></li>
</ul>

<style>
form .tbox{width:30px; text-align:center; border-radius:0px;}
form table tr td {padding:0px; width:32px !important; height:32px !important; background:#fff; vertical-align:middle; text-align:center;}
form table tr td i{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/map.png) 0px 0px no-repeat; position:absolute; left:0px; top:0px;}
form table tr td.c{background:#00CC00;}
#grid{position:absolute; cursor:pointer; overflow:visible; left:0px; top:0px; z-index:1;width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; background:url(https://cdn.jarm.com/img/game/lionica/ui/grid.png) 0px 0px repeat;}
#map{position:relative; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; background-repeat:repeat;}
#map-bg{position:absolute; width:<?php echo ($this->map['width']*32)+32+16+1?>px;height:<?php echo ($this->map['height']*32)+32+16+1?>px; z-index:0; left:-32px; top:-32px;}
#map-tile{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:1; left:0px; top:0px;}
#map-object{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:2; left:0px; top:0px;}
#map-life{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:3; left:0px; top:0px;}
#map-block{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:9; left:0px; top:0px;}
#map i{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/map.png) 0px 0px no-repeat; position:absolute; left:0px; top:0px; z-index:3}
#map i.bg{z-index:1}
.object{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/map.png) 0px 0px no-repeat; position:relative;}
.object-grid{background:url(https://cdn.jarm.com/img/game/lionica/ui/grid.png) 0px 0px repeat; position:absolute; left:0px; top:0px; z-index:9}
.npc{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/npc.png) 0px 0px no-repeat; position:relative;}
.monster{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/monster.png) 0px 0px no-repeat; position:relative;}
#obj-cur{position:absolute; left:0px; top:0px; width:32px; height:32px; background:rgba(0,0,0,0.5); display:none;}

</style>
<div id="obj-cur"></div>
<form action="<?php echo URL?>" method="post" name="edit" onSubmit="draw.save(this);return false;" class="form-horizontal">
<style>
#warp:after{content:"";display:block;clear:both;}
#tools{text-align:left;}
#tools .bar-heading{margin:0px;}
#tools li a{display:block;font-size:18px;border-right:12px solid #000;}
#tools li a:hover{background:#f7f7f7;}
#tools li a span{padding-left:10px;display:block;border-bottom:1px solid #f0f0f0;height:40px;line-height:40px;}
#tools li.-bg a{color:#0c0;border-color:#0c0;}
#tools li.-tile a{color:#099;border-color:#099;}
#tools li.-obj a{color:#fc0;border-color:#fc0;}
#tools li.-npc a{color:#90c;border-color:#90c;}
#tools li.-monster a{color:#c30;border-color:#c30;}
#area{overflow:hidden;margin-top:40px;}
#area>div{background:#f5f5f5;border:1px solid #eee;position:relative;overflow:auto;height:<?php echo ($this->map['height']*32)+33?>px;}
#map-warp{padding:32px 0px 32px 32px;width:<?php echo ($this->map['width']*32)+33?>px;height:<?php echo ($this->map['height']*32)+33?>px;margin:-16px;}
.mod{width:<?php echo ($this->map['width']*32)+33?>;display:none;position:absolute;left:0px;top:0px;background:rgba(0,0,0,0.5);color:#fff;padding:10px;z-index:1001;}
.mod h4{background:rgba(0,0,0,0.6);margin:0px 0px 10px 0px;padding:5px;color:#fff;}
.mod>div{height:296px;overflow:auto;}
.mod span{display:inline-block; line-height:32px; height:32px; width:100px; border-radius:5px; background:#f0f0f0; color:#000; text-shadow:1px 1px 0px #fff; border:1px solid #fff; margin:0px 5px 0px 0px; text-align:center;}
.mod a{display:inline-block;line-height:0px;border:1px solid rgba(0,0,0,0.6);padding:0px;}
.mod a.text{height:32px; text-align:center; line-height:32px; padding:0px 10px;}
.mod i{display:inline-block; background:url(https://cdn.jarm.com/img/game/lionica/sprite/map.png) 0px 0px no-repeat}
.mod .s-npc i{background:url(https://cdn.jarm.com/img/game/lionica/sprite/npc.png) 0px 0px no-repeat}
.mod .s-monster i{background:url(https://cdn.jarm.com/img/game/lionica/sprite/monster.png) 0px 0px no-repeat}
#summary{padding:40px 30px 0px;}
</style>
<script>
var mod;
function op(t)
{
  var v=t?$(t).parent().attr('class'):'';
  if(mod!=v&&v)
  {
    $('.mod').css('display','none');
    $('.mod'+v).css('display','block');
    mod=v;
  }
  else
  {
    $('.mod').css('display','none');
    mod='';
  }
}

var swing,swing_tmr4,swing_tmr,swing_idx=0,time=0;
$(function(){
  swing=$('.swing');
  swing4();
  swinging();
});

function swing4()
{
  clearTimeout(swing_tmr4);
  swing_idx++
  if(swing_idx>2)swing_idx=0;
  swing_tmr4=setTimeout(function(){swing4()},250);
}

function swinging()
{
  swing_tmr=requestAnimationFrame(swinging);
  var now=new Date().getTime(),dt=now-time;
  if(dt<100)
  {
    return;
  }
  time=now;
  var x=swing_idx*32;
  swing.each(function(){
    var v=$(this);
    v.css('background-position','-'+(v.data('sprite-x')+x)+'px -'+v.data('sprite-y')+'px');
  });

  var canvas = $('#map-life').get(0);
  var img_npc = $('#img_npc').get(0);
  var img_monster = $('#img_monster').get(0);
  var ctx = canvas.getContext("2d");

  ctx.clearRect(0, 0, <?php echo ($this->map['width']*32)+1?>, <?php echo ($this->map['width']*32)+1?>);

  $.each(map.monster,function(k,v){
    var j=k.split('_'),y2=j[0],x2=j[1];
    var p=master.monster[v].sprite;
    ctx.drawImage(img_monster, (Math.floor(p[1])*32*3)+x,(Math.floor(p[0])*48*4),32,48,x2*32,(y2*32)-16,32,48);
    //console.log(v+' - '+((Math.floor(p[1])*32*3)+x)+':'+(Math.floor(p[0])*48*4)+' > '+x2+':'+y2+' > '+(x2*32)+':'+((y2*32)-16));
  });
  $.each(map.npc,function(k,v){
    var j=k.split('_'),y2=j[0],x2=j[1];
    var p=master.monster[v].sprite;
    ctx.drawImage(img_npc, (Math.floor(p[1])*32*3)+x,(Math.floor(p[0])*48*4),32,48,x2*32,(y2*32)-16,32,48);
    //console.log(v+' - '+((Math.floor(p[1])*32*3)+x)+':'+(Math.floor(p[0])*48*4)+' > '+x2+':'+y2+' > '+(x2*32)+':'+((y2*32)-16));
  });
}
</script>
<div id="warp">
<div id="tools" class="col-xs-3">
<h3 class="bar-heading">เครื่องมือ</h3>
<ul>
  <li class="-bg"><a href="javascript:;" onclick="op(this)"><span>พื้นดิน / Background</span></a></li>
  <li class="-tile"><a href="javascript:;" onclick="op(this)"><span>พื้นดิน(ชุด) / Tileset</span></a></li>
  <li class="-obj"><a href="javascript:;" onclick="op(this)"><span>วัตถุ / Object</span></a></li>
  <li class="-npc"><a href="javascript:;" onclick="op(this)"><span>NPC</span></a></li>
  <li class="-monster"><a href="javascript:;" onclick="op(this)"><span>Monster</span></a></li>
</ul>
</div>
<div id="area" class="col-xs-5">
  <div>
  <div class="mod mod-bg">
    <h4>พื้นดิน <small></small></h4>
    <div>
      <?php foreach($this->block['bg'] as $k=>$v):?>
      <a href="javascript:;" onClick="draw.bg([<?php echo $v['x']?>,<?php echo $v['y']?>])"><i style="background-position:<?php echo $v['x']*-32?>px <?php echo $v['y']*-32?>px;width:32px;height:32px;" title="<?php echo $k?>"></i></a>
      <?php endforeach?>
    </div>
  </div>
  <div class="mod mod-tile">
    <h4>ชุดพื้นดิน <small></small></h4>
    <div>
      <?php foreach($this->block['tile'] as $k=>$v):?>
      <a href="javascript:;" class="s-tile s-tile-<?php echo $v['y']?>-<?php echo $v['x']?>" onClick="draw.select('tile','<?php echo $v['y']?>-<?php echo $v['x']?>')"><i style="background-position:<?php echo $v['x']*-32?>px <?php echo $v['y']*-32?>px;width:32px;height:32px;" title="<?php echo $k?>"></i></a>
      <?php endforeach?>
    </div>
  </div>
  <div class="mod mod-npc">
    <h4>NPC <small></small></h4>
    <div>
      <?php foreach($this->npc as $k=>$v):?>
        <a href="javascript:;" class="s-npc" onClick="draw.select('npc',<?php echo $k?>)"><i style="background-position:-<?php echo ($v['sprite'][1]*32*3)+32?>px -<?php echo ($v['sprite'][0]*48*4)?>px;width:32px;height:48px;" title="<?php echo $k?>"></i></a>
      <?php endforeach?>
    </div>
  </div>
  <div class="mod mod-monster">
    <h4>Monster <small></small></h4>
    <div>
  <?php foreach($this->monster as $k=>$v):?>
    <a href="javascript:;" class="s-monster" onClick="draw.select('monster',<?php echo $k?>)"><i class="<?php echo $v['swing']?' swing':''?>" data-sprite-x="<?php echo ($v['sprite'][1]*32*3)?>" data-sprite-y="<?php echo ($v['sprite'][0]*48*4)?>" style="background-position:-<?php echo ($v['sprite'][1]*32*3)+32?>px -<?php echo ($v['sprite'][0]*48*4)?>px;width:32px;height:48px;" title="<?php echo $v['name']?>"></i></a>
  <?php endforeach?>
    </div>
  </div>
  <div class="mod mod-obj">
    <h4>วัตถุ <small></small></h4>
    <div>
    <?php foreach($this->block['object'] as $k=>$v):?>
     <div class="object" style="width:<?php echo ($v['w']*32)+1?>px;height:<?php echo ($v['h']*32)+1?>px; background-position:<?php echo $v['x']*-32?>px <?php echo $v['y']*-32?>px">
     <div class="object-grid" data-offset="[<?php echo $v['x']?>,<?php echo $v['y']?>]" style="width:<?php echo ($v['w']*32)+1?>px;height:<?php echo ($v['h']*32)+1?>px;">
     </div>
     </div>
    <?php endforeach?>
    </div>
  </div>
<?php /*
 <?php foreach($this->monster['boss'] as $k=>$v):?>
 <li><a href="javascript:;" class="s-life-<?php echo $k?>" onClick="draw.select('life','<?php echo $k?>')"><i style="background:url(https://cdn.jarm.com/img/game/lionica/life/<?php echo $k?>.png) 50% 0% no-repeat;<?php echo $v['size']?'width:'.$v['size']['w'].'px;height:'.$v['size']['h'].'px;':'width:32px;height:48px;'?>" title="<?php echo $k?>"></i></a></li>
 <?php endforeach?>
 <?php foreach($this->monster['animal'] as $k=>$v):?>
 <li><a href="javascript:;" class="s-life-<?php echo $k?>" onClick="draw.select('life','<?php echo $k?>')"><i style="background:url(https://cdn.jarm.com/img/game/lionica/life/<?php echo $k?>.png) -32px 0px no-repeat;width:32px;height:48px;" title="<?php echo $k?>"></i></a></li>
 <?php endforeach?>
 <li><span>Delete:</span></li>
 */?>
 <!--<li><a href="javascript:;" class="s-del-block text" onClick="draw.select('del','block')">Block</a></li>
 <li><a href="javascript:;" class="s-del-tile text" onClick="draw.select('del','tile')">Tileset</a></li>
 <li><a href="javascript:;" class="s-del-object text" onClick="draw.select('del','object')">Object</a></li>
 <li><a href="javascript:;" class="s-del-life text" onClick="draw.select('del','life')">NPC / Monster / Warp / Farm / Animal</a></li>
-->
  <div id="map-warp">
    <div id="map">
      <canvas id="map-bg" width="<?php echo ($this->map['width']*32)+65?>" height="<?php echo ($this->map['height']*32)+65?>"></canvas>
      <canvas id="map-tile" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
      <canvas id="map-object" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
      <canvas id="map-life" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
      <canvas id="map-block" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
      <div id="grid"></div>
    </div>
  </div>
</div>
</div>
<div id="summary" class="col-xs-4">
  <div class="form-group">
    <label>ชื่อ</label>
    <input type="text" class="form-control" name="name" id="map-name" value="<?php echo $this->map['name']?>">
  </div>
  <div class="form-group">
    <label>จุดเกิด</label>
    <input type="text" class="form-control" name="start" id="map-start" value="<?php echo is_array($this->map['start'])?implode(',',$this->map['start']):$this->map['start']?>">
  </div>
</div>
</div>
</form>
<div style="width:1px; height:1px; overflow:hidden" id="backhide">
<img id="img" src="https://cdn.jarm.com/img/game/lionica/sprite/map.png">
<img id="img_npc" src="https://cdn.jarm.com/img/game/lionica/sprite/npc.png">
<img id="img_monster" src="https://cdn.jarm.com/img/game/lionica/sprite/monster.png">
</div>

<script>
var cur='',down='',last='',tool={type:'',content:''},
master={
  npc:<?php echo json_encode($this->npc)?>,
  monster:<?php echo json_encode($this->monster)?>
},
map={
	width:<?php echo $this->map['width']?>,
	height:<?php echo $this->map['height']?>,
	bg:<?php echo $this->map['bg']?json_encode($this->map['bg']):'[0,0]'?>,
	tile:<?php echo $this->map['tile']?json_encode($this->map['tile']):'{}'?>,
	object:<?php echo $this->map['object']?json_encode($this->map['object']):'{}'?>,
	life:<?php echo $this->map['life']?json_encode($this->map['life']):'{}'?>,
	block:<?php echo $this->map['block']?json_encode($this->map['block']):'{}'?>,
	npc:<?php echo $this->map['npc']?json_encode($this->map['npc']):'{}'?>,
	monster:<?php echo $this->map['monster']?json_encode($this->map['monster']):'{}'?>,
};

var draw={
	save:function(e)
	{
		var arg={};
		arg.name=$('#map-name').val();
		arg.start=$('#map-start').val();
		arg.bg=map.bg;
		arg.tile=map.tile;
		arg.object=map.object;
		arg.life=map.life;
		arg.block=map.block;
		_.ajax.gourl('<?php echo URL?>','setmap',arg);
	},
	select:function(t,c)
	{
    if(!obj_click)
    {
      op('');
    }
		var ky=t+'-'+c;
		$('#obj-cur').css('display','none');
		if(ky==cur)
		{
			cur='';
			tool.type='';
			$('.s-'+ky).css('border','1px solid #fff');
		}
		else
		{
			if(cur)
			{
				$('.s-'+cur).css('border','1px solid #fff');
			}
			if(t=='object')
			{
				var sp=c.split('-'),
				x=Math.floor(sp[0]),
				y=Math.floor(sp[1]),
				w=Math.floor(sp[2]),
				h=Math.floor(sp[3]);
				offset=$(arguments[2]).data('offset');
				cur=t+'-'+(x+offset[0])+'-'+(y+offset[1])+'-'+w+'-'+h;
				tool={type:'object',content:(x+offset[0])+'-'+(y+offset[1])+'-'+w+'-'+h};
				$('#obj-cur').remove();
				$(arguments[2]).parent().append('<div id="obj-cur"></div>');
				$('#obj-cur').css({'left':(x*32),'top':(y*32),'width':w*32,'height':h*32,'display':'block','z-index':0});
			}
			else
			{
				cur=ky;
				tool={type:t,content:c};
				$('.s-'+ky).css('border','1px solid #000');
			}
		}
	},
  life:function(type,y,x)
	{
    op('');
		var v=map[type][y+'_'+x]||'';
    if(!v)return;
		var p=master[type][v].sprite;
		var canvas = $('#map-life').get(0);
		var img = $('#img_'+type).get(0);
		var ctx = canvas.getContext("2d");
		ctx.drawImage(img, (Math.floor(p[1])*32*3)+32,(Math.floor(p[0])*48*4),32,48,x*32,(y*32)-16,32,48);
    console.log('ctx.drawImage(img, '+((Math.floor(p[1])*32*3)+32)+','+((Math.floor(p[0])*48*4))+','+(32)+','+(48)+','+(x*32)+','+((y*32)-16)+','+(32)+','+(48)+');');
	},
	block:function(y,x)
	{
		var v=map.block[y+'_'+x]||'';
		if(v)
		{
			var cv = $('#map-block').get(0);
			var img = $('#img').get(0);
			var co = cv.getContext("2d");
			co.drawImage(img, 0, 0, 32, 32, x*32, y*32, 32, 32);
		}
	},
	object:function(y,x)
	{
		var v=map.object[y+'_'+x]||[],p,t=$('#map'),sp,vl=[];
		if(v.length>0)
		{
			var cv_object = $('#map-object').get(0);
			var img = $('#img').get(0);
			var co = cv_object.getContext("2d");
			for(var i=0;i<v.length;i++)
			{
				p=v[i].split('-');
				co.drawImage(img, (Math.floor(p[0])*32), (Math.floor(p[1])*32),(Math.floor(p[2])*32),(Math.floor(p[3])*32),x*32,y*32,(Math.floor(p[2])*32),(Math.floor(p[3])*32));
			}
		}
	},
	tile1:function(y,x)
	{
		var v=map.tile[y+'_'+x]||[],p,t=$('#map'),sp,vl=[];
		if(v.length>0)
		{
			var cv = $('#map-tile').get(0);
			var img = $('#img').get(0);
			var ct = cv.getContext("2d");
			for(var i=0;i<v.length;i++)
			{
				var partsData = draw.tiling.create(draw.findtile(y,x,v[i]));
				var j, partDat, part,sp=v[i].split('-'),sx=Math.floor(sp[1])*32,sy=Math.floor(sp[0])*32;
				for (j = 0; j < partsData.length; j++)
				{
					partDat = partsData[j];
					ct.drawImage(img, (sx+partDat[1][1]), (sy+partDat[1][0]),16,16,(x*32)+partDat[0][1],(y*32)+partDat[0][0],16,16);
				}
			}
		}
	},
	tile:function(y,x)
	{
		var x1=Math.max(0,x-1);
		var x2=Math.min(map.width,x+1);
		var y1=Math.max(0,y-1);
		var y2=Math.min(map.height,y+1);
		for (y = y1; y <= y2; y += 1)
		{
			for (x = 0; x <= x2; x += 1)
			{
				draw.tile1(y,x);
			}
		}
	},
	tiling:
	{
		TILE_SIZE:[32, 32],
		TILE_PART_SIZE:[16, 16],
		TILE_SET_SIZE:[64, 96],
		TILE_SPECIFICATIONS:{
			'a': {
				'00000': [64, 32],
				'10000': [32, 32],
				'00010': [64,  0],
				'10010': [32,  0],
				'00001': [ 0, 32]
			},
			'b': {
				'00000': [64, 16],
				'10000': [32, 16],
				'01000': [64, 48],
				'11000': [32, 48],
				'00001': [ 0, 48]
			},
			'c': {
				'00000': [48, 16],
				'01000': [48, 48],
				'00100': [80, 16],
				'01100': [80, 48],
				'00001': [16, 48]
			},
			'd': {
				'00000': [48, 32],
				'00100': [80, 32],
				'00010': [48,  0],
				'00110': [80,  0],
				'00001': [16, 32]
			}
		},
		todata:function(data){
			var a = [0, 0, 0, 0, 0];
			var b = [0, 0, 0, 0, 0];
			var c = [0, 0, 0, 0, 0];
			var d = [0, 0, 0, 0, 0];
			if (data[0]) { a[0] += 1; b[0] += 1; }
			if (data[1]) b[4] += 1;
			if (data[2]) { b[1] += 1; c[1] += 1; }
			if (data[3]) c[4] += 1;
			if (data[4]) { c[2] += 1; d[2] += 1;}
			if (data[5]) d[4] += 1;
			if (data[6]) { a[3] += 1; d[3] += 1; }
			if (data[7]) a[4] += 1;
			return [
				draw.tiling.TILE_SPECIFICATIONS.a[a.join('')],
				draw.tiling.TILE_SPECIFICATIONS.b[b.join('')],
				draw.tiling.TILE_SPECIFICATIONS.c[c.join('')],
				draw.tiling.TILE_SPECIFICATIONS.d[d.join('')]
			];
		},
		tobound:function(data){
			var bd = [0, 0, 0, 0, 0, 0, 0, 0];
			var n = data; // Compact variable name
			if (n[0][1] === 0) bd[0]++; // top
			if (n[0][1] === 1 && n[0][2] === 0 && n[1][2] === 1) bd[1]++; // top-right
			if (n[1][2] === 0) bd[2]++; // right
			if (n[1][2] === 1 && n[2][2] === 0 && n[2][1] === 1) bd[3]++; // bottom-right
			if (n[2][1] === 0) bd[4]++; // bottom
			if (n[2][1] === 1 && n[2][0] === 0 && n[1][0] === 1) bd[5]++; // bottom-left
			if (n[1][0] === 0) bd[6]++; // left
			if (n[1][0] === 1 && n[0][0] === 0 && n[0][1] === 1) bd[7]++; // top-left
			return bd;
		},
		create:function(data){
			var data = draw.tiling.tobound(data);
			var partsData = draw.tiling.todata(data);
			return [// Merge part position in tile
				[[0, 0],                                         partsData[0]],
				[[0, draw.tiling.TILE_PART_SIZE[0]],                     partsData[1]],
				[[draw.tiling.TILE_PART_SIZE[1], draw.tiling.TILE_PART_SIZE[0]], partsData[2]],
				[[draw.tiling.TILE_PART_SIZE[1], 0],                     partsData[3]]//,
			];
		}
	},
	bg:function(s)
	{
		map.bg=[Math.floor(s[0]),Math.floor(s[1])];
    if(map.bg[0]==0&&map.bg[1]==0)
    {
      return;
    }
		var canvas = $('#map-bg').get(0);
		var img = $('#img').get(0);
		var ctx = canvas.getContext("2d");
		for(var y=0;y<map.height+2;y++)
		{
			for(var x=0;x<map.width+2;x++)
			{
				ctx.drawImage(img, map.bg[0]*32, map.bg[1]*32,32,32,x*32,y*32,32,32);
			}
		}
    op('');
	},
	action:function(y,x)
	{
		if(tool.type)
		{
			if(tool.type=='del')
			{
				if(tool.content=='life'||tool.content=='block')
				{
					delete map[tool.content][y+'_'+x];
				}
				else
				{
					map[tool.content][y+'_'+x]=[];
				}
				var canvas = $('#map-'+tool.content).get(0);
				var ctx = canvas.getContext("2d");
				ctx.clearRect(x*32,y*32,32,32);
			}
			else
			{
        if(tool.type=='life'||tool.type=='block')
				{
					map[tool.type][y+'_'+x]=tool.content;
					draw[tool.type](y,x);
				}
				else if(tool.type=='npc'||tool.type=='monster')
				{
          delete map['npc'][y+'_'+x];
          delete map['monster'][y+'_'+x];
					map[tool.type][y+'_'+x]=tool.content;
					draw.life(tool.type,y,x);
				}
				else
				{
          console.log(tool.type);
					var v=map[tool.type][y+'_'+x]||[],j=-1;
					for(var i in v)
					{
						if(tool.content==v[i])
						{
							j=i;
							break;
						}
					}
					if(j>-1)
					{
						v.splice(j,1);
					}
					v.push(tool.content);
					map[tool.type][y+'_'+x]=v;
					draw[tool.type](y,x);
				}
			}
		}
	},
	find:function(v,f,type)
	{
		var vl=[],p;
		if(type=='all')
		{
			for(var i=0;i<v.length;i++)
			{
				if(v[i]==f)
				{
					return true;
				}
			}
		}
		else if(type=='type')
		{
			for(var i=0;i<v.length;i++)
			{
				p=v[i].split('-');
				if(p[0]==f)
				{
					return true;
				}
			}
		}
		return false;
	},
	findtile:function(y,x,tile)
	{
		var getTileType = function(y,x, t, l){
			var n = map.tile[(y+t)+'_'+(x+l)]||[];
			if (n.length==0) return 0;
			if(draw.find(n,tile,'all'))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		};
		return [
			[
				getTileType(y,x, -1, -1),
				getTileType(y,x, -1, 0),
				getTileType(y,x, -1, +1)
			],
			[
				getTileType(y,x, 0, -1),
				getTileType(y,x, 0, 0),
				getTileType(y,x, 0, +1)
			],
			[
				getTileType(y,x, +1, -1),
				getTileType(y,x, +1, 0),
				getTileType(y,x, +1, +1)
			]
		];
	}
}

$(function(e){
	for(var y=0;y<map.height;y++)
	{
		for(var x=0;x<map.width;x++)
		{
			draw.object(y,x);
    	draw.tile1(y,x);
    	draw.life('monster',y,x);
    	draw.life('npc',y,x);
    	draw.block(y,x);
		}
	}
	if(map.bg)
	{
		draw.bg(map.bg);
	}
});

$('#map').click(function(e){
  console.log('click');
	var x=Math.floor((e.pageX - $('#map').offset().left)/32),
	y=Math.floor((e.pageY - $('#map').offset().top)/32);
	if(cur)
	{
		draw.action(y,x);
	}
  console.log('click = x: '+x+', y: '+y+', cur: '+cur);
}).mousedown(function(e) {
    down=cur;
}).mouseup(function(e) {
	down='';
}).mousemove(function(e) {
	var x=Math.floor((e.pageX - $('#map').offset().left)/32),
	y=Math.floor((e.pageY - $('#map').offset().top)/32);
	if(down&&cur)
	{
		last=down;
		draw.action(y,x);
    var dobj=map.object[y+'_'+x]||[],dtile=map.tile[y+'_'+x]||[];
    console.log('mousemove = x: '+x+', y: '+y+', tile: '+dtile.join(', ')+', object: '+dobj.join(', '));
	}
});

var obj_click=false;
$('.object-grid').mousedown(function(e) {
	var x=Math.floor((e.pageX - $(this).parent().offset().left)/32),
	y=Math.floor((e.pageY - $(this).parent().offset().top)/32);
    down=x+'-'+y;
    obj_click=true;
}).mouseup(function(e) {
	if(down)
	{
		var x=Math.floor((e.pageX - $(this).parent().offset().left)/32),
		y=Math.floor((e.pageY - $(this).parent().offset().top)/32);
		sp=down.split('-'),
		w=Math.max(((x-Math.floor(sp[0]))+1),1),
		h=Math.max(((y-Math.floor(sp[1]))+1),1);
    obj_click=false;
		draw.select('object',down+'-'+w+'-'+h,this);
	}
	down='';
}).mousemove(function(e) {
	if(down)
	{
		var x=Math.floor((e.pageX - $(this).parent().offset().left)/32),
		y=Math.floor((e.pageY - $(this).parent().offset().top)/32);
		sp=down.split('-'),
		w=Math.max(((x-Math.floor(sp[0]))+1),1),
		h=Math.max(((y-Math.floor(sp[1]))+1),1);
		draw.select('object',down+'-'+w+'-'+h,this);
	}
});//.disableSelection();
</script>
