<?php $sidebarId = emptybox_get_sidebar_id('entry-footer', $args["baseType"], $args["subType"], $args["havePosts"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Entry Footer -->
	<footer class="entry-footer">
		<?php dynamic_sidebar($sidebarId); ?>
	</footer>
<?php endif; ?>
