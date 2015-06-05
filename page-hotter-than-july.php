<?php
/*
Template Name: Hotter than July
*/
?>

<?php
$context = Timber::get_context();
$context['page'] = new TimberPost(); 
$context['pagetemplate'] = "page-default.twig";
$context['slides'] = Timber::get_posts('post_type=htjslide');
$context['allPosts'] = Timber::get_posts('post_type=post'); 
$context['nav'] = Timber::get_sidebar('nav.twig', $context);
$context['htj_sidebar_widgets'] = Timber::get_widgets('htj-sidebar-widgets');
$context['donate'] = Timber::get_posts('page_id=121'); 
$context['footer_widgets'] = Timber::get_widgets('htj_footer_widgets');
Timber::render('base-hotter-than-july.twig', $context);
?>



