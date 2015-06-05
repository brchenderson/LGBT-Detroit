<?php get_header('hotter-than-july'); ?>
<div class="container">
<div class="row">
	<div class="col-md-8">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post" id="post-<?php the_ID(); ?>">
			

<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count"></div>
<a class="twitter-share-button" href="https://twitter.com/share">Tweet</a>
<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
<script type="IN/Share" data-counter="right"></script>
<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>

			<h2><?php the_title(); ?></h2>

			<!--<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>-->

			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</div>
        


		<?php endwhile; endif; ?></div>	
<div class="col-md-4">
<?php dynamic_sidebar('htj-sidebar-widgets'); ?>
</div>
</div>

<div class="container"><div>
<?php get_footer(); ?>
</div>