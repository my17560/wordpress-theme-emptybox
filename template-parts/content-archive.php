<?php
$havePosts = have_posts();

// Archive Header
get_template_part('template-parts/archive-header', $args["subType"], $args);

if ($havePosts) {
	// Has Results
	while ($havePosts) {
		the_post();
		$args = array("baseType" => $args["baseType"], "subType" => $args["subType"], "havePosts" => $havePosts);
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php get_template_part('template-parts/entry-header', $args["subType"], $args); ?>
			<?php get_template_part('template-parts/entry-content', $args["subType"], $args); ?>
			<?php get_template_part('template-parts/entry-footer', $args["subType"], $args); ?>
		</article>
<?php
		$havePosts = have_posts();
	}
} else {
	// No Results
	$args = array("baseType" => $args["baseType"], "subType" => $args["subType"], "havePosts" => false);
?>
	<section class="no-results not-found">
		<?php get_template_part('template-parts/entry-header', $args["subType"], $args); ?>
		<?php get_template_part('template-parts/entry-content', $args["subType"], $args); ?>
		<?php get_template_part('template-parts/entry-footer', $args["subType"], $args); ?>
	</section>
<?php
}

// Archive Footer
get_template_part('template-parts/archive-footer', $args["subType"], $args);
?>
