<style>
#map{position:relative; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; background-repeat:repeat;}
#map-bg{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:0; left:0px; top:0px;}
#map-tile{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:1; left:0px; top:0px;}
#map-object{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:2; left:0px; top:0px;}
#map-life{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:3; left:0px; top:0px;}
#map-block{position:absolute; width:<?php echo ($this->map['width']*32)+1?>px;height:<?php echo ($this->map['height']*32)+1?>px; z-index:4; left:0px; top:0px;}
#map i{display:inline-block; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/map.png) 0px 0px no-repeat; position:absolute; left:0px; top:0px; z-index:3}
#map i.bg{z-index:1}
.obj{display:inline-block; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/map.png) 0px 0px no-repeat; position:relative;}
.obj-grid{background:url(http://s0.boxza.com/static/images/game/lionica/ui/grid.png) 0px 0px repeat; position:absolute; left:0px; top:0px; z-index:9}
#obj-cur{position:absolute; left:0px; top:0px; width:32px; height:32px; background:rgba(0,0,0,0.5); display:none;}
.sprite li{float:left; margin:0px;}
.sprite span{display:inline-block; line-height:32px; height:32px; width:100px; border-radius:5px; background:#f0f0f0; color:#000; text-shadow:1px 1px 0px #fff; border:1px solid #fff; margin:0px 5px 0px 0px; text-align:center;}
.sprite a{display:inline-block; line-height:0px; border:1px solid #fff;}
.sprite a.text{height:32px; text-align:center; line-height:32px; padding:0px 10px;}
.sprite i{display:inline-block; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/map.png) 0px 0px no-repeat}
</style>
<div id="obj-cur"></div>
<form action="<?php echo URL?>" method="post" name="edit" onSubmit="draw.save(this);return false;" class="form-horizontal">
<div class="control-group">
<label class="control-label">ชื่อ</label>
<div class="controls"><input type="text" name="name" id="map-name" value="<?php echo $this->map['name']?>"></div>
</div>
<div class="control-group">
<label class="control-label">จุดเกิด</label>
<div class="controls"><input type="text" name="start" id="map-start" value="<?php echo is_array($this->map['start'])?implode(',',$this->map['start']):$this->map['start']?>"></div>
</div>
 
 
<div id="map">
<canvas id="map-bg" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
<canvas id="map-tile" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
<canvas id="map-object" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
<canvas id="map-life" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
<canvas id="map-block" width="<?php echo ($this->map['width']*32)+1?>" height="<?php echo ($this->map['height']*32)+1?>"></canvas>
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
	bg:<?php echo $this->map['bg']?json_encode($this->map['bg']):'[0,0]'?>,
	tile:<?php echo $this->map['tile']?json_encode($this->map['tile']):'{}'?>,
	object:<?php echo $this->map['object']?json_encode($this->map['object']):'{}'?>,
	life:<?php echo $this->map['life']?json_encode($this->map['life']):'{}'?>,
	block:<?php echo $this->map['block']?json_encode($this->map['block']):'{}'?>,
};

var draw={
	save:function(e)
	{
		
	},
	select:function(t,c)
	{
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
	life:function(y,x)
	{
		var v=map.life[y+'_'+x]||'',p,sp;
		if(v)
		{
			var cv_object = $('#map-life').get(0);
			var img=$('<img>').load(function(e){
				var co = cv_object.getContext("2d");
				co.drawImage($(this).get(0), 32, 0, 32, 48, x*32, (y*32)-16, 32, 48);
				$(this).remove();
            }).appendTo($('#backhide')).attr('src','http://s0.boxza.com/static/images/game/lionica/life/'+v+'.png');
		}
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
		var canvas = $('#map-bg').get(0);
		var img = $('#img').get(0);
		var ctx = canvas.getContext("2d");
		for(var y=0;y<map.height;y++)
		{
			for(var x=0;x<map.width;x++)
			{
				ctx.drawImage(img, map.bg[0]*32, map.bg[1]*32,32,32,x*32,y*32,32,32);
			}
		}
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
        	draw.life(y,x);
        	draw.block(y,x);
		}
	}
	if(map.bg)
	{
		draw.bg(map.bg);	
	}
});

$('#map').click(function(e){
	var x=Math.floor((e.pageX - $('#map').position().left)/32),
	y=Math.floor((e.pageY - $('#map').position().top)/32);
	if(cur)
	{
		draw.action(y,x);
	}
}).mousedown(function(e) {
    down=cur;
}).mouseup(function(e) {
	down='';
}).mousemove(function(e) {
	var x=Math.floor((e.pageX - $('#map').position().left)/32),
	y=Math.floor((e.pageY - $('#map').position().top)/32);
	if(down&&cur)
	{
		last=down;
		draw.action(y,x);
	}
	var dobj=map.object[y+'_'+x]||[],dtile=map.tile[y+'_'+x]||[];
	$('#debug').html('x: '+x+', y: '+y+', tile: '+dtile.join(', ')+', object: '+dobj.join(', '));
});

$('.obj-grid').mousedown(function(e) {
	var x=Math.floor((e.pageX - $(this).parent().position().left)/32),
	y=Math.floor((e.pageY - $(this).parent().position().top)/32);
    down=x+'-'+y;
}).mouseup(function(e) {
	if(down)
	{
		var x=Math.floor((e.pageX - $(this).parent().position().left)/32),
		y=Math.floor((e.pageY - $(this).parent().position().top)/32);
		sp=down.split('-'),
		w=Math.max(((x-Math.floor(sp[0]))+1),1),
		h=Math.max(((y-Math.floor(sp[1]))+1),1);
		draw.select('object',down+'-'+w+'-'+h,this);
	}
	down='';
}).mousemove(function(e) {
	if(down)
	{
		var x=Math.floor((e.pageX - $(this).parent().position().left)/32),
		y=Math.floor((e.pageY - $(this).parent().position().top)/32);
		sp=down.split('-'),
		w=Math.max(((x-Math.floor(sp[0]))+1),1),
		h=Math.max(((y-Math.floor(sp[1]))+1),1);
		draw.select('object',down+'-'+w+'-'+h,this);
	}
}).disableSelection();
</script>