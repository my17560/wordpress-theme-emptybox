<?php $sidebarId = emptybox_get_sidebar_id('archive-header', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Archive Header -->
	<header class="archive-header">
		<?php dynamic_sidebar($sidebarId); ?>
	</header>
<?php endif; ?>
