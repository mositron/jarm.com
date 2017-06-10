<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php for($i=0;$i<count($this->url);$i++):$l=$this->url[$i];?>
<url>
  <?php foreach($l as $k=>$v): echo '<'.$k.'>'.$v.'</'.$k.'>'; endforeach;?>

</url>
<?php endfor?>
</urlset>
