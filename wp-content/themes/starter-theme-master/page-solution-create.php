<?php
/**
 * Template name: Create Solution
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['user'] = get_userdata($params['id']);
$context['users'] = get_users();
$context['challenge'] = get_post($params['cid']);
$context['post'] = $post;

$post = new TimberPost();

Timber::render( 'solution-create.twig', $context );
