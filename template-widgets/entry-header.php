<?php $sidebarId = emptybox_get_sidebar_id('entry-header', $args["baseType"], $args["subType"], $args["havePosts"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Entry Header -->
	<header class="entry-header">
		<?php dynamic_sidebar($sidebarId); ?>
	</header>
<?php endif; ?>
