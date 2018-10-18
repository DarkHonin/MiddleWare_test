<?php FRONT::load_part("head")->post() ?>

<body>



<?php
FRONT::load_part("sidebar")->post();
FRONT::section("content");
FRONT::load_part("sidebar")->post();
?>

</body>