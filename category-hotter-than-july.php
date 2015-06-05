
<?php get_header('hotter-than-july'); ?>
<?php
 $main_slides_context['slides'] = Timber::get_posts('post_type=htjslide');
 Timber::render('carousel-htj.twig',  $main_slides_context['slides']);

 ?>
<div class="container">
	<div class="row">
	<div class="col-md-8">

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?>>
				
					<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					
					<!--<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>-->

					<div class="entry">
						<?php the_excerpt(); ?>
					</div>

				</div>

			<?php endwhile; ?>
		</div>
			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
	<?php else : ?>

		<h2>Nothing found </h2>

	<?php endif; ?>

<div class="col-md-4">
<?php dynamic_sidebar('htj-sidebar-widgets'); ?>
</div>
</div>


</div>

<div class="container"><div>
<?php get_footer(); ?>
</div>