<?php
kSetMenuSelectedByURL(kGetPrivateDir());
?>
<div class="private-area">
	<?php
	
	/* FILE LIST */
	if( kPrivateIsFile() && kMemberIsLogged() && !kPrivateFileIsDownloadable() )
	{
		?>
		<h2><?= kTranslate('You don\'t have permission to access this file'); ?></h2>
		<a href="<?= kGetSiteUrl() . kGetBaseDir() . strtolower(kGetLanguage()) . '/' . kGetPrivateDir(); ?>"><?= kTranslate('back to main folder'); ?></a>
		<?php
		
	} elseif(kPrivateIsFile()) {
		?>
		<h2><?= kTranslate('Please log-in to download this file'); ?></h2>
		<a href="<?= kGetSiteUrl() . kGetBaseDir() . strtolower(kGetLanguage()) . '/' . kGetPrivateDir(); ?>"><?= kTranslate('back to main folder'); ?></a>
		<?php
		
	} else {
		$privateArea = kGetPrivateFileList( trim( $GLOBALS['__subdir__'] . '/' . $GLOBALS['__subsubdir__'], " ./" ) );

		//count how many items there are
		$privateAreaDirs = 0;
		$privateAreaFiles = 0;
		
		foreach($privateArea as $k=>$dir)
		{
			if( is_numeric( $k ) && isset( $dir['dirname'] ) ) $privateAreaDirs++;
			elseif( is_numeric( $k ) && isset( $dir['filename'] ) ) $privateAreaFiles++;
		}

		//change immediately directory if there are just one subdir and no files
		if( $privateAreaDirs == 1 && $privateAreaFiles == 0)
		{
			?>
			<meta http-equiv="refresh" content="5;URL=<?= $privateArea[0]['dirname']; ?>">
			<?php
		}

		//count how many items there are in parent dir
		$parentCount = 0;
		$parentAreaDirs = 0;
		$parentAreaFiles = 0;
		if( $privateArea['parent'] != "")
		{
			$parentArea = kGetPrivateFileList( $privateArea['parent'] );
			foreach( $parentArea as $k => $dir )
			{
				if( is_numeric( $k ) && isset( $dir['dirname'] ) ) $parentAreaDirs++;
				elseif( is_numeric( $k ) && isset( $dir['filename'] ) ) $parentAreaFiles++;
			}
		}
		
		?>
		<div class="titleBox">
		<?php
		
		//print title
		if( trim( $privateArea['dirname'], " ./" ) != "" && ( $parentAreaDirs > 1 || $parentAreaFiles > 0 ) )
		{
			?>

			<h2><?= str_replace( "/", " / ", $privateArea['dirname'] ); ?></h2>
			<a href="<?= kGetBaseDir() . strtolower(kGetLanguage()) . '/' . kGetPrivateDir() . '/' . $privateArea['parent']; ?>" class="small button"><?= kTranslate('Back to parent folder'); ?></a>
			<?php
		} else {
			?>
			<h2><?= $ancestors[0]['label']; ?></h2>
			<?php
		}
		
		?>
		</div>
		<div class="contentsBox">
		<?php
		
		//print items
		if( $privateAreaDirs == 0 && $privateAreaFiles == 0 )
		{
			?>
			<div class="emptydir"><?= kTranslate('This folder is empty'); ?></div>
			<?php
			
		} else {
			
			foreach($privateArea as $k=>$dir)
			{

				if(is_numeric($k)&&isset($dir['dirname'])) {
					?>
					<div class="folder"><a href="<?= $dir['permalink']; ?>"><img src="<?= kGetTemplateDir(); ?>img/mime/folder.png" width="16" height="16" alt="folder" /> <?= $dir['dirname']; ?> <small><?= $dir['size']['Mb']; ?> Mb</small></a></div>
					<?php

				} elseif( is_numeric( $k ) && isset( $dir['filename'] ) ) {
					$icon = kGetTemplateDir() . 'img/mime/' . $dir['extension'] . '.png';
					if( !file_exists( $_SERVER['DOCUMENT_ROOT'] . $icon ) ) $icon = kGetTemplateDir() . 'img/mime/_.png';
					?>
					<div class="file"><a href="<?= $dir['permalink']; ?>"><img src="<?= $icon; ?>" width="16" height="16" alt="<?= $dir['extension']; ?>" /> <?= $dir['filename']; ?> <small><?= $dir['size']['Mb']; ?> Mb</small></a></div>
					<?php
				}
			}
		}
		
		?>
		</div>
		<?php

	}
	?>
</div>
&nbsp;