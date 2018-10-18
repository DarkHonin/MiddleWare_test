
<form class='content' method='<?php echo FRONT::$_DATA['method']?>'>
<?php
foreach(FRONT::$_DATA['fields'] as $field)
    FRONT::load_part("field", ["field"=>$p])->post();
?>
</form>

<?php FRONT::wrap("body:content")?>