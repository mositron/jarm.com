<div class="full">
<?php
$c = explode('<!-- chat template-->',file_get_contents(_FILES.'cdn/chat/index.html'));
echo $c[1];
?>
</div>
<script>
_.chat.room=<?php echo $this->room['_id']?>;
_.chat.load();
</script>
