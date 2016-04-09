<?php




ob_start();

// Update standard fields
$user_data = wp_update_user(
  array(
    'ID' => $_POST['user_id'],
    'user_email' => $_POST['email'],
    'user_url' => $_POST['website']
  )
);

// File upload requires a little more english
if ( !function_exists('wp_handle_upload') ) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
}

// Move file to media library
$movefile = wp_handle_upload( $_FILES['portrait'], array( 'test_form' => false) );

// If move was successful, insert WordPress attachment
if ( $movefile && !isset($movefile['error']) ) {
  $wp_upload_dir = wp_upload_dir();
  $attachment = array(
    'guid' => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
    'post_mime_type' => $movefile['type'],
    'post_title' => preg_replace( '/\.[^.]+$/', '', basename($movefile['file']) ),
    'post_content' => '',
    'post_status' => 'inherit'
  );
  $attach_id = wp_insert_attachment($attachment, $movefile['file']);
  update_user_meta($_POST['user_id'], 'portrait', $attach_id);
}


update_user_meta($_POST['user_id'], 'job_title', $_POST['job_title']);
update_user_meta($_POST['user_id'], 'institution', $_POST['institution']);
update_user_meta($_POST['user_id'], 'academic_degree', $_POST['academic_degree']);
update_user_meta($_POST['user_id'], 'areas_of_interest', $_POST['areas_of_interest']);



if ( is_wp_error( $user_data ) ) {
    // There was an error; possibly this user doesn't exist.
    echo 'Error';
} else {
    // Success!
    header('Location: /users/' . $_POST['user_id']);
}


ob_end_flush();
