<?php

$context = Timber::get_context();
$context['post'] = new TimberPost(); 
$context['allPosts'] = Timber::get_posts('post_type=post'); 
$context['nav'] = Timber::get_sidebar('nav.twig', $context);
$context['home_sidebar_widgets'] = Timber::get_widgets('home_sidebar_widgets');
$context['footer_widgets'] = Timber::get_widgets('footer_widgets');
Timber::render('single.twig', $context);


?>
