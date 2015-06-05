<?php

$context = Timber::get_context();
$context['posts'] = Timber::get_posts(); 
$context['nav'] = Timber::get_sidebar('nav.twig', $context);
$context['home_sidebar_widgets'] = Timber::get_widgets('home_sidebar_widgets');
$context['footer_widgets'] = Timber::get_widgets('footer_widgets');
Timber::render('base.twig', $context);

?>