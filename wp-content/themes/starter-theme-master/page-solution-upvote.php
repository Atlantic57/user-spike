<?php

ob_start();

$current_votes = get_post_meta($_POST['solution_id'], 'upvotes');
array_push($current_votes, $_POST['user_id']);

$post_information = array(
  'ID' => $_POST['solution_id'],
  'meta_input' => array(
    'upvotes' => $current_votes,
  )
);

wp_update_post( $post_information );

if ( is_wp_error() ) {
  echo 'Error';
} else {
  header('Location: /?p=' . $_POST['solution_id']);
}

ob_end_flush();
