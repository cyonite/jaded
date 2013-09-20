<?php
global $wp_query;
$engine = \CLMVC\Controllers\Render\RenderingEngines::getEngine('jade', get_stylesheet_directory() . '/views');

$scope = array(
        'title' => wp_title(' | ', false),
        'description' => get_bloginfo( 'description', 'display' ));

switch(true) {
    case is_single():
        $posts = $wp_query->get_posts();
        $post = null;
        if ($posts)
            $post = array_shift($posts);
        $file = 'posts/single';
        $scope['post'] = $post;
        break;
    case is_404():
        $file = '404';
        break;
    default:
        $file='posts/home';
        $scope['posts'] =$wp_query->get_posts();
}

echo $engine->render($file, $scope);