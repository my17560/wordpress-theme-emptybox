<?php $sidebarId = emptybox_get_sidebar_id('archive-footer', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Archive Footer -->
	<footer class="archive-footer">
		<?php dynamic_sidebar($sidebarId); ?>
	</footer>
<?php endif; ?>
