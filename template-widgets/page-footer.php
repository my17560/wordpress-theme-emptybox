<?php $sidebarId = emptybox_get_sidebar_id('page-footer', $args["baseType"], $args["subType"]); ?>

<?php if ($sidebarId) : ?>
	<!-- Page Footer -->
	<footer id="page-footer" class="page-footer">
		<div class="wrapper">
			<?php dynamic_sidebar($sidebarId); ?>
		</div>
	</footer>
<?php endif; ?>
