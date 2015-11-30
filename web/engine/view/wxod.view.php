<?php if(!defined("IN_RULE")) die ("Oops"); ?>

<div id="featured">

	<?php if ($showForm == 1) : ?>
		<?php echo $message; ?>	<br>
		<a href="/index.php">Вернитесь и повторите вход</a>

	<?php else : ?>
      <form class="form-signin" action="/index.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
	<?php endif; ?>

</div><!--/featured-->



<div class="clear"></div>