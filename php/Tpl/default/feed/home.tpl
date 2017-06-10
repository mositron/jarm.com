<table class="table table-striped" width="100%">
  <thead>
    <tr>
      <th></th>
      <th>Title</th>
      <th>RSS Feed</th>
      <th>URL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center" style="width:20px;"><span class="glyphicon glyphicon-home"></span></td>
      <td><a href="<?php echo self::uri(['feed','/news/rss'])?>" target="_blank">ข่าววันนี้</a></td>
      <td><a href="<?php echo self::uri(['feed','/news/rss'])?>" target="_blank"><?php echo self::uri(['feed','/news/rss'])?></a></td>
      <td><a href="<?php echo self::uri(['news'])?>" target="_blank"><?php echo self::uri(['news'])?></a></td>
    </tr>
<?php foreach (self::$conf['news'] as $k => $v):?>
  <tr>
    <td class="text-center" style="width:20px;"><span class="glyphicon glyphicon-list"></span></td>
    <td><a href="<?php echo self::uri(['feed','/news/rss'])?>" target="_blank"><?php echo $v['t']?></a></td>
    <td><a href="<?php echo self::uri(['feed','/news-'.$k.'/rss'])?>" target="_blank"><?php echo self::uri(['feed','/news-'.$k.'/rss'])?></a></td>
    <td><a href="<?php echo $v['sl']?:self::uri(['news','/'.$v['l']])?>" target="_blank"><?php echo $v['sl']?:self::uri(['news','/'.$v['l']])?></a></td>
  </tr>
<?php endforeach?>
  </tbody>
</table>
