<?php $sidebarId = emptybox_get_sidebar_id('entry-content', $args["baseType"], $args["subType"], $args["havePosts"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Entry Content -->
	<div class="entry-content">
		<?php dynamic_sidebar($sidebarId); ?>
	</div>
<?php endif; ?>
