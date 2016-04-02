<article class="blog clearfix">
<?php
if ( has_post_thumbnail() ) {
	if (is_singular()) {
		the_post_thumbnail('medium');
	}else{
	the_post_thumbnail('thumb');
	}
} 
?>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php 

	the_excerpt();
 
?>
</article>