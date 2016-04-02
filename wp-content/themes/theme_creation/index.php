<?php get_header(); ?>

<?php if(have_posts()):?>
<div class="content">
	<?php while(have_posts()): the_post();

	get_template_part('content', get_post_format());

	endwhile;
	else:
	get_template_part('content', 'none');
	endif;

	?>
</div>			
<?php get_sidebar(); ?>
<?php get_footer(); ?>