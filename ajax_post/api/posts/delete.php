<?php
include_once '../../includes/Database.php';
include_once '../../models/Posts.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate Posts object
$post = new Posts($db);

//Get the ID
$post->post_id = isset($_GET['post_id']) ? $_GET['post_id']: die();

//DELETE Post
if($post->delete_post()){
  echo json_encode(array(
    'message' => 'Post Deleted'
  ));
}else{
  echo json_encode(array(
    'message' => 'Post Not Deleted'
  ));
}

?>
