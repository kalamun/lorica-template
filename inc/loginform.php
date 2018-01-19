<?php
if(!kMemberIsLogged())
{ 
	if(isset($_POST['login_username'])&&isset($_POST['login_password'])) {
		?>
		<div class="alert"><?= kTranslate('Username o password errati'); ?></div>
		<?php
	}
	?>
	<form action="" method="post" class="loginForm">
		<label for="login_username"><?= kTranslate('Nome utente'); ?></label>
		<input type="text" id="login_username" name="login_username" /><br>
		
		<label for="login_password"><?= kTranslate('Password'); ?></label>
		<input type="password" id="login_password" name="login_password" /><br>

		<div class="submit">
			<input type="submit" value="<?= kTranslate('Accedi'); ?>" />
		</div>
	</form>
<?php
}