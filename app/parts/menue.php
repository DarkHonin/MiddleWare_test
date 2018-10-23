<?php



?>

<ul>
	<?php if(!isset($_SESSION['username'])) { ?>
	<li><a href="/register">Register</a></li>
	<li><a href="/login">Login</a></li>
	<?php } else { ?>
		<li><a href="/user"><?php echo $_SESSION['username'] ?></a></li>
		<li><a href="/logout">Logout</a></li>
		<?php } ?>
</ul>