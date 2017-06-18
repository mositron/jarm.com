<!--style>
#map{position:relative; width:<?php echo ($this->map['width']*$this->scale)+1?>px;height:<?php echo ($this->map['height']*$this->scale)+1?>px; background-repeat:repeat;}
#map-bg{position:absolute; width:<?php echo ($this->map['width']*$this->scale)+1?>px;height:<?php echo ($this->map['height']*$this->scale)+1?>px; z-index:0; left:0px; top:0px;}
#map-tile{position:absolute; width:<?php echo ($this->map['width']*$this->scale)+1?>px;height:<?php echo ($this->map['height']*$this->scale)+1?>px; z-index:1; left:0px; top:0px;}
#map-object{position:absolute; width:<?php echo ($this->map['width']*$this->scale)+1?>px;height:<?php echo ($this->map['height']*$this->scale)+1?>px; z-index:2; left:0px; top:0px;}
#map-life{position:absolute; width:<?php echo ($this->map['width']*$this->scale)+1?>px;height:<?php echo ($this->map['height']*$this->scale)+1?>px; z-index:3; left:0px; top:0px;}
#map i{display:inline-block; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/map.png) 0px 0px no-repeat; position:absolute; left:0px; top:0px; z-index:3}
#map i.bg{z-index:1}
.obj{display:inline-block; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/map.png) 0px 0px no-repeat; position:relative;}
</style-->

<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/lionica" title="เกมส์สัตว์เลี้ยง "> Lionica (เกมส์สัตว์เลี้ยง)</a></li>
<span class="divider">&raquo;</span>
<li>ข้อมูลแผนที่, NPC, มอนสเตอร์</li>
<span class="divider">&raquo;</span>
<li><a href="/lionica/info/map/<?php echo $this->map['_id']?>" title="แผนที่ <?php echo $this->map['name']?> "> <?php echo $this->map['name']?></a></li>
</ul>


<style>
.img-monster{display:inline-block; width:32px; height:48px; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/monster.png) 0px 0px no-repeat;}
.img-npc{display:inline-block; width:32px; height:48px; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/npc.png) 0px 0px no-repeat;}
.img-block{width:50px; text-align:center;}
.table td.img-cap{text-align:right; width:95px; background:#f5f5f5; color:#555; text-shadow:1px 1px 0px #fff;}
.table td.img-cap small{font-size:10px}
.table td,.table th{padding:4px; line-height:1.6em;}
</style>
<div style="padding:5px">
<h2>แผนที่: <?php echo $this->map['name']?></h2>
<p>
<img src="http://s0.boxza.com/static/images/game/lionica/info/map/<?php echo $this->map['_id']?>.png">
</p>

<?php if(is_array($this->npc)):?>
<h4>NPC</h4>
<table class="table" width="100%">
<?php foreach($this->npc as $k=>$v):?>
<tr>
<td rowspan="2" class="img-block">
<i class="img-npc" style="background-position:<?php echo $v['css']?>"></i>
</td>
<td colspan="2"><?php echo $v['name']?> - <?php echo $v['detail']?></td>
</tr>
<tr><td class="img-cap">ตำแหน่ง</td><td><?php echo $v['loc']?></td></tr>
<?php endforeach?>
</table>
<?php endif?>

<?php if(is_array($this->monster)):?>
<h4>Monster</h4>
<table class="table" width="100%">
<?php foreach($this->monster as $k=>$v):?>
<tr>
<td rowspan="3" class="img-block">
<i class="img-monster" style="background-position:<?php echo $v['css']?>"></i>
</td>
<td colspan="8"><?php echo $v['name']?></td>
</tr>
<tr><td class="img-cap">LV <small>(เลเวล)</small></td><td><?php echo $v['lv']?></td><td class="img-cap">HP <small>(เลือด)</small></td><td><?php echo $v['hp']?></td><td class="img-cap">Element <small>(ธาตุ)</small></td><td><?php echo $this->element[$v['ele']]?></td><td class="img-cap">Exp <small>(ประสบการณ์)</small></td><td><?php echo $v['exp']?></td></tr>
<tr><td class="img-cap">Atk <small>(โจมตี)</small></td><td><?php echo $v['atk']?></td><td class="img-cap">Def <small>(ป้องกัน)</small></td><td><?php echo $v['def']?></td><td class="img-cap">Hit <small>(แม่นยำ)</small></td><td><?php echo $v['hit']?></td><td class="img-cap">Flee <small>(หลบหลีก)</small></td><td><?php echo $v['free']?></td></tr>
<?php endforeach?>
</table>
<?php endif?>
</div>

 
<div class="fb-comments" data-href="http://game.boxza.com/lionica/info/map/<?php echo $this->map['_id']?>" data-num-posts="50" data-width="710"></div>
 
<!--div id="map">
<canvas id="map-bg" width="<?php echo ($this->map['width']*$this->scale)+1?>" height="<?php echo ($this->map['height']*$this->scale)+1?>"></canvas>
<canvas id="map-tile" width="<?php echo ($this->map['width']*$this->scale)+1?>" height="<?php echo ($this->map['height']*$this->scale)+1?>"></canvas>
<canvas id="map-object" width="<?php echo ($this->map['width']*$this->scale)+1?>" height="<?php echo ($this->map['height']*$this->scale)+1?>"></canvas>
<canvas id="map-life" width="<?php echo ($this->map['width']*$this->scale)+1?>" height="<?php echo ($this->map['height']*$this->scale)+1?>"></canvas>
<div id="grid"></div>
</div>
<input name="editmon" type="submit" value=" บันทึก " class="button blue">
</form>
<div style="width:1px; height:1px; overflow:hidden" id="backhide">
<img id="img" src="http://s0.boxza.com/static/images/game/lionica/sprite/map.png">
</div>

<script>
var cur='',down='',last='',tool={type:'',content:''},
map={
	width:<?php echo $this->map['width']?>,
	height:<?php echo $this->map['height']?>,
	scale:<?php echo $this->scale?>,
	per:<?php echo 32/$this->scale?>,
	bg:<?php echo $this->map['bg']?json_encode($this->map['bg']):'[0,0]'?>,
	tile:<?php echo $this->map['tile']?json_encode($this->map['tile']):'{}'?>,
	object:<?php echo $this->map['object']?json_encode($this->map['object']):'{}'?>,
	life:<?php echo $this->map['life']?json_encode($this->map['life']):'{}'?>,
};

var draw={
	save:function(e)
	{
		
	},
	select:function(t,c)
	{
	},
	life:function(y,x)
	{
		
	},
	block:function(y,x)
	{
		
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
				co.drawImage(img, (Math.floor(p[0])*32), (Math.floor(p[1])*32),(Math.floor(p[2])*32),(Math.floor(p[3])*32),x*map.scale,y*map.scale,(Math.floor(p[2])*map.scale),(Math.floor(p[3])*map.scale));
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
					ct.drawImage(img, (sx+partDat[1][1]), (sy+partDat[1][0]),16,16,((x*32)+partDat[0][1])/map.per,((y*32)+partDat[0][0])/map.per,16/map.per,16/map.per);
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
		var canvas = $('#map-bg').get(0);
		var img = $('#img').get(0);
		var ctx = canvas.getContext("2d");
		for(var y=0;y<map.height;y++)
		{
			for(var x=0;x<map.width;x++)
			{
				ctx.drawImage(img, map.bg[0]*32, map.bg[1]*32,32,32,x*map.scale,y*map.scale,map.scale,map.scale);
			}
		}
	},
	action:function(y,x)
	{
		if(tool.type)
		{
			if(tool.type=='del')
			{
				
			}
			else
			{
				if(tool.type=='life'||tool.type=='block')
				{
					map[tool.type][y+'_'+x]=tool.content;
					draw[tool.type](y,x);
				}
				else
				{
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

$(window).load(function(e){
	for(var y=0;y<map.height;y++)
	{
		for(var x=0;x<map.width;x++)
		{
			draw.object(y,x);
        	draw.tile1(y,x);
		}
	}
	if(map.bg)
	{
		draw.bg(map.bg);	
	}
});

</script-->