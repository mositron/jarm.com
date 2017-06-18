<?php //echo file_get_contents('http://anti-adblock.adnow.com/aadbAdnow.php?ids=85519,85592,87535,87537,88865,117738,117776');?>
<article class="col-md-9 col-content">
  <?php if(!$this->data['hide_adsense']):?>
  <div id='div-gpt-ad-1473244406891-0' style="text-align:center;margin-bottom:10px;">
  <script>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1473244406891-0'); });</script>
  </div>
  <?php endif?>
<style>
.SC_TBlock table tr td{padding:0px !important; line-height:18px !important;}
</style>

<ul class="breadcrumb">
  <li><a href="<?php echo self::uri(['news','/'])?>" title="ข่าววันนี้"><span class="glyphicon glyphicon-home"></span> ข่าววันนี้</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="<?php echo $this->ncate['sl']?:self::uri(['news','/'.$this->ncate['l']])?>" title="<?php echo $this->ncate['t']?>"><?php echo $this->ncate['t']?></a></li>
  <span></span>
  <li class="pull-right news-writer">
    <span>โดย: <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a> - </span>
    เมื่อ: <?php echo self::Time()->from($this->news['ds'],'datetime')?>
  </li>
</ul>
<div>
  <?php if(!defined('HIDE_ADS')):?>
  <div class="row news-native news-padding clear-line">
     <div data-advs-adspot-id="ODIyOjU5MTk" style="display:none"></div>
  </div>
  <?php endif?>
  <h1 class="news-h1"><a href="<?php echo URL?>"><?php echo $this->news['t']?></a> <span> (<a href="<?php echo self::uri(['control','/news/'.$this->news['_id']])?>" target="_blank">แก้ไข</a>, <a href="<?php echo self::uri(['control','/news/stats/'.$this->news['_id']])?>" target="_blank">สถิติ</a>)</span></h1>
  <?php if(!empty($this->data['banner']['b'])):?>
  <!-- BEGIN - BANNER : B -->
  <div class="_banner _banner-b" style="margin-top:5px;"><?php echo $this->data['banner']['b']?></div>
  <!-- END - BANNER : B -->
  <?php endif?>
  <?php if(!empty($this->data['banner']['c'])):?>
  <!-- BEGIN - BANNER : C -->
  <div class="_banner _banner-c"><?php echo $this->data['banner']['c']?></div>
  <!-- END - BANNER : C -->
  <?php endif?>
  <div class="news-detail">
<?php
     $this->news['d']=str_replace(
                  ['http://s1.boxza.com','http://s2.boxza.com','http://s3.boxza.com','http://s4.boxza.com','http://f1.jarm.com','http://f2.jarm.com','http://f3.jarm.com','http://f4.jarm.com'],
                  ['https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com','https://f1.jarm.com','https://f2.jarm.com','https://f3.jarm.com','https://f4.jarm.com'],
                $this->news['d']);
    $this->_tmp=[];
    $this->_tmp['cur']=0;
    $this->_tmp['ads']=[];

    $div1='<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto;text-align:center;">';
    $div2='</div>';

    if(defined('HIDE_ADS')||$this->news['c']==28||$this->news['na'])
    {

    }
    elseif($this->news['c']!=8 && $this->news['c']!=29)
    {
      // yengo              <p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto;text-align:center;">
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146315)</script></div>';
      //adnow
      //$this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_85519" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "85519",SC_Domain="n.ads3-adnow.com";SC_Start_85519=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads3-adnow.com/js/adv_out.js"></script>';


      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146424)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146423)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146422)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146315)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146424)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146423)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146422)</script>'.$div2;
      // dfp
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=712"></script>'.$div2;
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=713"></script>'.$div2;
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=717"></script>'.$div2;
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=718"></script>'.$div2;
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=719"></script>'.$div2;
      #$this->_tmp['ads'][]=$div1.'<script type="text/javascript" src="//yngth.net/dsp/widget.js?adp=714"></script>'.$div2;

      if(!$this->data['hide_adsense'])
      {
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-1.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-2.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-3.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-4.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-5.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-6.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-7.php');
        // dfp
        $this->_tmp['ads'][] = file_get_contents(__CONF.'ads/ads.dfp-8.php');
      }
      // criteo + adnow
      //$this->_tmp['ads'][] = $div1.file_get_contents(__CONF.'ads/ads.criteo.2x2-1.php').''.$div2;
      // criteo + adnow
      //$this->_tmp['ads'][] = $div1.file_get_contents(__CONF.'ads/ads.criteo.2x2-2.php').''.$div2;
      //adnow
      //$this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_87535" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "87535",SC_Domain="n.ads3-adnow.com";SC_Start_87535=(new Date).getTime();</script><script type="text/javascript" src="http://st-n.ads3-adnow.com/js/adv_out.js"></script>';
      //adnow
      //$this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_87537" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "87537",SC_Domain="n.ads3-adnow.com";SC_Start_87537=(new Date).getTime();</script><script type="text/javascript" src="http://st-n.ads3-adnow.com/js/adv_out.js"></script>';
      //adnow
      //$this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_85592" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "85592",SC_Domain="n.ads2-adnow.com";SC_Start_85592=(new Date).getTime();</script><script type="text/javascript" src="http://st-n.ads2-adnow.com/js/adv_out.js"></script>';
    }
    else
    {
      /*
      $this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_85519" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "85519",SC_Domain="n.ads3-adnow.com";SC_Start_85519=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads3-adnow.com/js/adv_out.js"></script>';
      $this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_85592" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "85592",SC_Domain="n.ads2-adnow.com";SC_Start_85592=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads2-adnow.com/js/adv_out.js"></script>';
      $this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_87535" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "87535",SC_Domain="n.ads3-adnow.com";SC_Start_87535=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads3-adnow.com/js/adv_out.js"></script>';
      $this->_tmp['ads'][] = '<p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_87537" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "87537",SC_Domain="n.ads3-adnow.com";SC_Start_87537=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads3-adnow.com/js/adv_out.js"></script>';
      */
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146315)</script></div>';
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146424)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146423)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146422)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146315)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146424)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146423)</script>'.$div2;
      $this->_tmp['ads'][]=$div1.'<script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write(\'<div id="\'+t+\'" class="yengo-block yengo-block-\'+e+\'"></div>\'); if("undefined"===typeof window.loaded_blocks_yengo){window.loaded_blocks_yengo=[]; function n(){var e=window.loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&window.loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}window.loaded_blocks_yengo.push({adp_id:e,div:t})})(146422)</script>'.$div2;
    }

    function charlen($txt)
    {
      return mb_strlen(str_replace([' ','&nbsp;',"\r","\n"],'',strip_tags($txt)),'utf-8');
    }
    function call_instagram($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(substr($link,0,4)=='http')
      {
        return '<p-media><blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="6" style="width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><a href="'.$link.'" target="_blank"></a></blockquote><script async defer src="https://platform.instagram.com/en_US/embeds.js"></script></p>';
      }
      else
      {
        return '<p>[embed-instagram]='.$txt[3].'</p>';
      }
    }
    function call_youtube($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(preg_match('#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x',$link,$c))
      {
        return '<p-media>'."\r\n".'<div class="flex-video widescreen"><iframe src="https://www.youtube.com/embed/'.$c[2].'" frameborder="0" width="620" height="345"></iframe></div>'."\r\n".'</p>';
      }
      else
      {
        return '<p>[embed-youtube]='.$txt[3].'</p>';
      }
    }
    function call_facebook($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(substr($link,0,4)=='http')
      {
        return '<p-media><div class="fb-post" data-href="'.$link.'"></div></p>';
      }
      else
      {
        return '<p>[embed-facebook]='.$txt[3].'</p>';
      }
    }
    function call_facebook_video($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(substr($link,0,4)=='http')
      {
        //return '<p-media><div class="fb-video" data-href="'.$link.'"></div></p>';
        return '<p-media>'."\r\n".'<div class="flex-video widescreen"><iframe src="https://www.facebook.com/plugins/video.php?href='.urlencode($link).'" frameborder="0" width="620" height="345"></iframe></div>'."\r\n".'</p>';
        //https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FWOODYTALKSHOW%2Fvideos%2F10153796544127689%2F&show_text=0&width=560
      }
      else
      {
        return '<p>[embed-facebook-video]='.$txt[3].'</p>';
      }
    }
    function call_twitter($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(substr($link,0,4)=='http')
      {
        return '<p-media><blockquote class="twitter-tweet" data-lang="th"><a href="'.$link.'"></a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></p>';
      }//
      else
      {
        return '<p>[embed-twitter]='.$txt[3].'</p>';
      }
    }
    function call_twitter_video($txt)
    {
      $link=trim(str_replace([' ','&nbsp;'],'',strip_tags($txt[3])));
      if(substr($link,0,4)=='http')
      {
        return '<p-media><blockquote class="twitter-video" data-lang="th"><a href="'.$link.'"></a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></p>';
      }//
      else
      {
        return '<p>[embed-twitter-video]='.$txt[3].'</p>';
      }
    }

    //$search     = '#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x'

    $link=$this->news['link'];
    $ct = $this->news['d'];
/*
    $detail=explode('<p',$ct);
    $min=floor(count($detail)/2);
    $detail[$min].="\r\n".'<p>[embed-facebook-video]=https://www.facebook.com/jarm/videos/1251813278280590/</p>'."\r\n".'<p align="center"><a href="https://news.jarm.com/view/82915">#จามแจกทอง ฉลอง 2,000,000 Likes ลุ้นทองง่ายๆ คลิกเลิย</a></p>'."\r\n";
    $ct=implode('<p',$detail);
    print_r($detail);
    echo '----'.count($detail).' - '.$min.'----';
*/
    $ct = str_replace('"//www.youtube','"https://www.youtube',$ct);
    $ct = preg_replace('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i','<p-media style="text-align:center">'."\r\n".'<img src="${4}" />'."\r\n".'</p>',$ct);
    $ct = preg_replace('/\<p([^\>]*)\>(.*)\<iframe([^\>]+)src="([^"]+)"([^\<]+)\<\/iframe\>(.*)\<\/p\>/i','<p-media>'."\r\n".'<div class="flex-video widescreen"><iframe src="${4}" frameborder="0" width="620" height="345"></iframe></div>'."\r\n".'</p>',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-youtube\]\=(.*)\<\/p\>/i','call_youtube',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-instagram\]\=(.*)\<\/p\>/i','call_instagram',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\]\=(.*)\<\/p\>/i','call_facebook',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-facebook\-video\]\=(.*)\<\/p\>/i','call_facebook_video',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\]\=(.*)\<\/p\>/i','call_twitter',$ct);
    $ct = preg_replace_callback('/\<p([^\>]*)\>(.*)\[embed\-twitter\-video\]\=(.*)\<\/p\>/i','call_twitter_video',$ct);

    $split='<p';
    $spl=explode($split,$ct);
    $words=600;
    $word=0;
    $last=0;
    $img=0;
    $ad=0;
    $first=true;
    $otv=true;
    $ads_split=3;
    for($i=1;$i<count($spl)-1;$i++)
    {
      $word+=charlen(($i>0?$split:'').$spl[$i]);
      if(strpos($spl[$i],'-media')!==false)
      {
        $img++;
      }
      //if(($img>0 || $word>=$words) && $last>1)
      if(($first && $img>0 && $last>0)||($img>($ads_split-1) && $last>1))
      {
        array_splice($spl, $i+1, 0, ['><fb:ads></p><!-- ad-'.$ad.':img-'.$img.':last-'.$last.':word-'.$word.' -->'."\r\n"]);
        $img=0;
        $last=-1;
        $word=0;
        $first=false;
        $ad++;
      }
      elseif($otv && $img>0 && !$first)
      {/*
        if($this->news['c']!=28)
        {
          array_splice($spl, $i+1, 0, ['> </p>
          <p align="center"><a href="https://news.jarm.com/view/82915" target="_blank">#จามแจกทอง ฉลอง 2,000,000 Likes ลุ้นทองง่ายๆ คลิกเลย</a></p>
          <div class="flex-video widescreen"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fjarm%2Fvideos%2F1251813278280590%2F" frameborder="0" width="620" height="345"></iframe></div>
          '."\r\n"]);
        }
        else
        {*/
          array_splice($spl, $i+1, 0, ['></p><!-- OTV -->'."\r\n"]);
        //}
        $otv=false;
      }
      $last++;
    }
    //if(($img>0 || $word>=$word) && $last>1)
    if(($img>($ads_split-1)) && $last>1)
    {
      array_push($spl, '><fb:ads></p><!-- ad-'.$ad.':img-'.$img.':last-'.$last.':word-'.$word.' -->'."\r\n");
    }
    $ct = str_replace('<p-media','<p',implode($split,$spl));
    //$ct = '<p><fb:ads></p>'.str_replace('<p-media','<p',implode($split,$spl));
    $ct = preg_replace_callback('/\<p\>\<fb\:ads\>\<\/p\>/i',function($txt)
    {
      $tmp = '';
      if(isset($this->_tmp['ads'][$this->_tmp['cur']]))
      {
         $tmp=$this->_tmp['ads'][$this->_tmp['cur']]."\r\n";
      }
      else
      {
        //$tmp='not set : '.$this->_tmp['cur'];
      }
      $this->_tmp['cur']++;
      return $tmp;
    },$ct);

    echo $ct;
/*
    echo '<div class="row">';
    echo '<div class="col-sm-6"><p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_85592" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "85592",SC_Domain="n.ads2-adnow.com";SC_Start_85592=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads2-adnow.com/js/adv_out.js"></script></div>';
    echo '<div class="col-sm-6"><p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 336px;margin: 0px auto 3px;">Advertisement</p><div style="width:336px;margin:0px auto"><div id="SC_TBlock_87535" class="SC_TBlock">loading...</div></div><script type="text/javascript">var SC_CId = "87535",SC_Domain="n.ads3-adnow.com";SC_Start_87535=(new Date).getTime();</script><script type="text/javascript" src="https://st-n.ads3-adnow.com/js/adv_out.js"></script></div>';
    echo '</div>';
*/
?>
<div style="padding:10px 0px;margin-top:10px;border-top:1px solid #ccc;">
<a href="https://www.facebook.com/simdaijai" target="_blank" ref="nofollow">
<img src="https://cdn.jarm.com/img/misc/simdaijai.jpg" class="img-responsive" style="margin-bottom:10px;">
ซิมถูก โทรฟรี เน็ตไม่อั้น ไม่ลดสปีด เฉลี่ยวันละ 3 บ. นิดๆ ถูกกว่านี้ไม่มีแล้ว จำนวนจำกัด !!!<br>
+ ราคา 399 บ. / ใช้งานได้ 4 เดือน<br>
+ ราคา 799 บ. / ใช้งานได้ 8 เดือน<br>
+ ราคา 1,199 บ. / ใช้งานได้ 12 เดือน<br>
+ ราคา 1,999 บ. / ใช้งานได้ 20 เดือน<br>
+++ความเร็วเน็ต 1 Mbps | เฉลี่ยเดือนละ 100 บ. เท่านั้น!!<br><br>
<strong>รายละเอียดเพิ่มเติม คลิกเลย</strong></a>
</div>
  <div style="padding:10px 0px;text-align:center"><div class="fb-save" data-uri="<?php echo URI?>" data-size="large" style="width:190px !important;display:inline-block;"></div></div>
  </div>
  <?php if(!defined('HIDE_ADS')):?>
  <div id="ads-fb" style="text-align:center;display:none;margin-bottom:10px;">
    <p style="background: #f0f0f0;color: #AAA;padding: 0px 5px;text-align: left;font-size: 11px;height: 20px;line-height: 20px;width: 300px;margin: 0px auto 3px;">Advertisement</p><div style="width:300px;margin:0px auto;text-align:center"><fb:ad placementid="678076615655643_758963624233608" format="300x250" testmode="false"></fb:ad></div>
  </div>
  <script>
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
  {
    $('#ads-fb').css('display','block');
    window.fbAsyncInit = function(){FB.Event.subscribe('ad.loaded',function(placementId) {console.log('Audience Network ad loaded');});FB.Event.subscribe('ad.error',function(errorCode, errorMessage, placementId){console.log('Audience Network error ('+errorCode+')'+errorMessage);$('#ads-fb').css('display','none');});};
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/th_TH/sdk/xfbml.ad.js#xfbml=1&version=v2.9&appId=<?php echo self::$conf['social']['facebook']['appid']?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  }
</script>
  <style>
  .news-native div {padding:0px;border-bottom: 1px dashed #ddd;margin-bottom: 10px;}
  .news-native div > a { position:relative;overflow:hidden; display:block}
  .news-native div > a strong{font-weight:normal;position:absolute; left:0px; top:0px; background:#000; background-color:rgba(0,0,0,0.6);color:#ccc; font-size:12px; padding:1px 5px; border-bottom-right-radius: 5px;z-index:1;}
  .news-native h4{margin:3px 0px 0px;line-height: 21px; font-weight:normal;}
  .news-native h4 a {font-size: 16px;color: #444;max-height:63px; overflow:hidden;display:block;}
  .img-res img{max-width:100%;height:auto !important;}
  </style>
  <div class="row news-native news-padding clear-line">
     <div data-advs-adspot-id="ODIyOjU5MTk" style="display:none"></div>
  </div>
  <?php endif?>
  <div class="_share bottom">
    <div class="facebook"><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
    <div class="twitter"><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
    <div class="google"><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
  </div>
  <script>$(function(){_.share({title:'<?php echo $this->news['t']?>',url:'<?php echo URI?>',img:'<?php echo $this->data['image']?>',cb:function(a,b,c){if(a=='facebook'){}}});});</script>
  <div style="padding:5px;text-align:right;"><a href="mailto:info@jarm.com" target="_blank" rel="nofollow"><span class="glyphicon glyphicon-erase"></span> แจ้งลบ/แจ้งบทความไม่เหมาะสม</a></div>
  <?php if(!defined('HIDE_ADS')):?>
  <?php if(!empty($this->data['banner']['d'])):?>
  <!-- BEGIN - BANNER : D -->
  <div class="_banner _banner-d"><?php echo $this->data['banner']['d']?></div>
  <!-- END - BANNER : D -->
  <?php endif?>
  <?php if(!empty($this->data['banner']['e'])):?>
  <!-- BEGIN - BANNER : E -->
  <div class="_banner _banner-e"><?php echo $this->data['banner']['e']?></div>
  <!-- END - BANNER : E -->
  <?php endif?>
  <?php endif?>
</div>
<script>$('.news-detail').attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);</script>
<?php if(!defined('HIDE_ADS')):?>
<div style="text-align:center"><script>(function(e){var t="DIV_YNG_"+e+"_"+parseInt(Math.random()*1e3); document.write('<div id="'+t+'" class="yengo-block yengo-block-'+e+'"></div>'); if("undefined"===typeof loaded_blocks_yengo){loaded_blocks_yengo=[]; function n(){var e=loaded_blocks_yengo.shift(); var t=e.adp_id; var r=e.div; var i=document.createElement("script"); i.type="text/javascript"; i.async=true; i.charset="windows-1251"; i.src="//code.yengo.com/data/"+t+".js?async=1&div="+r+"&t="+Math.random(); var s=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]; s.appendChild(i); var o=setInterval(function(){if(document.getElementById(r).innerHTML&&loaded_blocks_yengo.length){n(); clearInterval(o)}},50)} setTimeout(n)}loaded_blocks_yengo.push({adp_id:e,div:t})})(146357)</script></div>
<?php endif?>
</article>
<aside class="col-md-3">
  <h3 class="bar-heading">ข่าวใกล้เคียง</h3>
  <div class="row news-bottom3 clear-line">
  <?php $loaded=false;for($i=0;$i<count($this->relate);$i++):$v2=$this->relate[$i];?>
    <?php if(!defined('HIDE_ADS')):?>
    <?php if((!$loaded)&&(empty($v2['pr']))):$loaded=true;?>
      <div data-advs-adspot-id="MDg5OjYyNzA" style="display:none"></div>
      <div data-advs-adspot-id="MDg5OjYyNzA" style="display:none"></div>
    <?php endif?>
    <?php endif?>
    <div class="col-xs-6 col-sm-6 col-md-12">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank">
        <img src="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive">
      </a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
    </div>
    <?php endfor?>
  </div>
  <?php if(!defined('HIDE_ADS')):?>
  <script src="https://js.mtburn.com/advs-instream.js"></script>
  <script type="text/javascript">MTBADVS.InStream.Default.run({"immediately":true})</script>
  <?php endif?>
</aside>
<div class="col-md-12">
  <h3 class="bar-heading" style="margin-top:5px">แสดงความคิดเห็นด้วย Facebook</h3>
  <div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="30" data-width="100%" data-version="v2.9"></div>
</div>
