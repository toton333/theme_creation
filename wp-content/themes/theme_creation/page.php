<?php get_header(); ?>

<?php if(have_posts()):?>
<div class="page_container">
	<?php while(have_posts()): the_post();?>

	<h3><?php the_title(); ?></h3>
	<?php the_content(); ?>

	<?php
	endwhile;
	else:
	get_template_part('content', 'none');
	endif;

	?>
</div> 			
<?php get_sidebar(); ?>
<?php get_footer(); ?>