<?php

$context = Timber::get_context();
$context['post'] = $post;
$post = new TimberPost();

Timber::render( 'user-login.twig', $context );
