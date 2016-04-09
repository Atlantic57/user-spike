<?php
/**
 * Template name: User List
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['subscribers'] = get_users('blog_id=1&orderby=nicename&role=');

Timber::render( 'users.twig', $context );
