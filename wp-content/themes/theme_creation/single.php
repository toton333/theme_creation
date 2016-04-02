<?php get_header(); ?>

<?php if(have_posts()):?>
<div class="single_container">
	<?php while(have_posts()): the_post();?>

	<?php the_post_thumbnail('medium'); ?>
	<h3><?php the_title(); ?></h3>
	<?php the_content(); ?>

	<?php 
	endwhile;
	else:
	get_template_part('content', 'none');
	endif;

	?>
</div><!-- end of single_container -->			
<?php get_sidebar(); ?>
<?php get_footer(); ?>