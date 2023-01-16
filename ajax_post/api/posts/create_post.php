<?php
include_once '../../includes/Database.php';
include_once '../../models/Posts.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate Posts object
$post = new Posts($db);

//Get the posted data
$post->post_title = $_POST['post_title'];
$post->post_body = $_POST['post_body'];

//Create Post
if($post->create_post()){
  echo json_encode(array(
    'message' => 'Post Created'
  ));
}else{
  echo json_encode(array(
    'message' => 'Post Not Created'
  ));
}
 ?>
