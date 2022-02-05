<?php the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part('template-parts/entry-header', $args["subType"], $args); ?>
	<?php get_template_part('template-parts/entry-content', $args["subType"], $args); ?>
	<?php get_template_part('template-parts/entry-footer', $args["subType"], $args); ?>
</article>
