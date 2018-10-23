
<div class='content'>
	<?php 
	
		foreach($self->item("posts") as $post){
			$self->child("app/parts/post.php", ["data"=> ["item"=>$post]]);
		}
	$self->children() ?>
</div>

