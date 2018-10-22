<ul class="pnav">
    <?php
        for($s = $self->item("start"); $s <= $self->item("pages"); $s++){
            echo "<li".($s==$self->item("current") ? " class='active'" : "")."><a href='?page=$s'>$s</a></li>";
        }
    
    ?>
</ul>