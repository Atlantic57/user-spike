<?php
/**
 * Template name: User Profile
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

global $params;
$context = Timber::get_context();
$context['user'] = get_userdata($params['id']);
$context['user_acf'] = get_fields('user_' . $params['id']);
$context['post'] = $post;
$post = new TimberPost();

Timber::render( 'user.twig', $context );
