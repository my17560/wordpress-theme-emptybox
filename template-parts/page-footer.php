<?php $sidebarId = emptybox_get_sidebar_id('page-footer', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Page Footer -->
	<footer class="page-footer">
		<?php dynamic_sidebar($sidebarId); ?>
	</footer>
<?php endif; ?>
