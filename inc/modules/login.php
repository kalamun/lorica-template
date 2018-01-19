<?php
/* LOGIN FORM and CURRENT USER BADGE */
?>
<div class="login">
	<?php
	if( !kMemberIsLogged() )
	{
		?>
		<div class="subtitleBox"><h2><?= kTranslate('Log-in'); ?></h2></div>
		<?php
		kPrintLogInForm();

	} else {
		?>
		<div class="subtitleBox"><h2><?= kTranslate('Your private area'); ?></h2></div>
		<div class="padding">
			<?= kTranslate('You are connected as'); ?><br>
			<em><?= kGetMemberName(); ?></em><br>
			<br>
			<a href="<?= kGetBaseDir() . strtolower( kGetLanguage() ) . '/' . kGetPrivateDir(); ?>?logout" class="smallbutton"><?= kTranslate('Log-out'); ?></a>
		</div>
		<?php
	}
	?>
</div>
&nbsp;