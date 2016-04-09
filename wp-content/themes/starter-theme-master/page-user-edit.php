<?php
/**
 * Template name: User Profile
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['user'] = get_userdata($params['id']);
$context['post'] = $post;
$context['academic_degrees'] = get_field_object('field_5705df0665958');
$context['areas_of_interest'] = get_field_object('field_5705df1159a1b');
$post = new TimberPost();

Timber::render( 'user-edit.twig', $context );
