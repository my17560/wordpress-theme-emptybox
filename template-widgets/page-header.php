<?php $sidebarId = emptybox_get_sidebar_id('page-header', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Page Header -->
	<header id="page-header" class="page-header">
		<div class="site-wrapper">
			<?php dynamic_sidebar($sidebarId); ?>
		</div>
	</header>
<?php endif; ?>
