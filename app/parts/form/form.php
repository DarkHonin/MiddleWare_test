<form <?php
    $self->tags();
?> >
<?php
    foreach($self->item('fields') as $name=>$col){
        echo "<div class='field'>";
        (new \FRONT\Runner("app/parts/form/inputs/label.php", [
            "for" => $col->get_name(),
            "text" => $name,
        ]))->build();
        (new \FRONT\Runner("app/parts/form/inputs/standard.php", [
            "name" => $col->get_name(),
            "class" => "data-field",
            "type" => $col->get_field_type(),
            "required" => $col->required()
        ]))->build();
        echo "</div>";
    }
?>
<input type="hidden" name="token" value="<?php $self->eitem('token')?>">
<input type="submit" class="data-field button" value="<?php $self->eitem('submit')?>">
</form>