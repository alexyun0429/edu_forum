<body>
	<div class="container">
      <div class="col-4 offset-4">

		<h2 class="text-center">Login</h2> 
			<?php if (session('error')) : ?>
				<div>
					<?= esc(session('error')) ?>
				</div>
			<?php endif; ?>

			<?= form_open('login'); ?>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" required="required" name="email" value="<?= isset($email) ? esc($email) : '' ?>">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" required="required" name="password">
				</div>

				<div class="clearfix">
					<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
					<a href="forgot_password" class="float-right">Forgot Password?</a>
				</div>   

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Log in</button>
				</div>
					 
			<?= form_close(); ?>
		</div>
	</div>
</body>