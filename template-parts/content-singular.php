<?php the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part('template-widgets/entry-header', $args["subType"], $args); ?>
	<?php get_template_part('template-widgets/entry-content', $args["subType"], $args); ?>
	<?php get_template_part('template-widgets/entry-footer', $args["subType"], $args); ?>
</article>
