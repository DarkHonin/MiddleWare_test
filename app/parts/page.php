

<?php
include_once("head.php");
$self->child("app/parts/body.php", ["children"=>$self->item("content")]);
?>