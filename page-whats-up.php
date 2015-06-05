<?php

$context = Timber::get_context();
$context['pagetemplate'] = "page-whats-up.twig";
$context['page'] = new TimberPost(); 
$context['posts'] = Timber::get_posts('post_type=post'); 
$context['nav'] = Timber::get_sidebar('nav.twig', $context);
$context['home_sidebar_widgets'] = Timber::get_widgets('home_sidebar_widgets');
$context['footer_widgets'] = Timber::get_widgets('footer_widgets');
$tumblr = file_get_contents("http://lgbtdetroit.tumblr.com/rss");
$xml = simplexml_load_string($tumblr);
$json = json_encode($xml);
$context['tumblr'] = json_decode($json,TRUE);



Timber::render('base.twig', $context);


?>
