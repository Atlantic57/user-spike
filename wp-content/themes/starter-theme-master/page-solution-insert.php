<?php

ob_start();

// Update standard fields
$post_information = array(
    'post_title' => wp_strip_all_tags( $_POST['title'] ),
    'post_content' => $_POST['content'],
    'post_type' => 'solutions',
    'post_status' => 'publish',
    'post_author' => $_POST['user_id'],
    'meta_input' => array(
      'solves' => $_POST['challenge_id'],
      'contributors' => $_POST['contributors']
    )
);

wp_insert_post( $post_information );

if ( is_wp_error() ) {
    // There was an error; possibly this user doesn't exist.
    echo 'Error';
} else {
    // Success!
    header('Location: /challenges/');
}


ob_end_flush();
