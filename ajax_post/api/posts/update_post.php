<?php
include_once '../../includes/Database.php';
include_once '../../models/Posts.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate Posts object
$post = new Posts($db);

//Get the posted data
$post->post_id = $_POST['edit_post_id'];
$post->post_title = $_POST['edit_post_title'];
$post->post_body = $_POST['edit_post_body'];

//Update Post
if($post->update_post()){
  echo json_encode(array(
    'message' => 'Post Updated'
  ));
}else{
  echo json_encode(array(
    'message' => 'Post Can not be Updated'
  ));
}
 ?>
