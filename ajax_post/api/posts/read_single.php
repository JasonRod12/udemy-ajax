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

//Get Single Post
$post->read_single();

//Creat array
$post_arr = array(
  'post_id' => $post->post_id,
  'post_title' => $post->post_title,
  'post_body' => $post->post_body
);

//Create to json
echo json_encode($post_arr);
?>
