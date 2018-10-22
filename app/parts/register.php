
<form>
<?php
foreach($form->get_create_fields() as $L=>$c){
?>
<div class="field">
	<label for="<?php echo $c->get_name() ?>"><?php echo $L ?></label>
</div>

<?php } ?>

</form>