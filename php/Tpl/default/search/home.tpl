<style>
.gsc-input input{box-shadow:none !important;}
.cse .gsc-control-cse, .gsc-control-cse{padding:0px;}
.gsc-results .gsc-cursor-box .gsc-cursor-page{display: inline-block;padding: 3px 10px;text-align: center;background-color: #f9f9f9;border: 1px solid #ccc;border-radius: 4px;color: #555;}
.gsc-results .gsc-cursor-box .gsc-cursor-page.gsc-cursor-current-page {color: #f60;border-color: #f60;background-color: #fff;}
.gsc-search-button{display:none;}
table.gsc-search-box td {vertical-align: middle;}
.gsc-input-box{height:auto;}
.gsc-search-box-tools .gsc-search-box .gsc-input{padding:0px;}
.gsst_b{line-height:0px;}
.gs-result .gs-title, .gs-result .gs-title * {text-decoration: none;}
</style>
<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>



<h1 class="bar-heading">ค้นหาข้อมูล</h1>


<script>
(function() {
var cx = '005271380156275684242:smohuf4bdps';
var gcse = document.createElement('script');
gcse.type = 'text/javascript';
gcse.async = true;
gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	'//www.google.com/cse/cse.js?cx=' + cx;
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(gcse, s);
})();
</script>


<gcse:search></gcse:search>
