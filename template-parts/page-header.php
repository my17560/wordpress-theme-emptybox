<?php $sidebarId = emptybox_get_sidebar_id('page-header', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Page Header -->
	<header class="page-header">
		<?php dynamic_sidebar($sidebarId); ?>
	</header>
<?php endif; ?>
