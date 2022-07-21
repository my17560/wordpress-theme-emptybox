<?php $sidebarId = emptybox_get_sidebar_id('page-header', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Page Header -->
	<header class="page-header">
		<div class="wrapper">
			<?php dynamic_sidebar($sidebarId); ?>
		</div>
	</header>
<?php endif; ?>