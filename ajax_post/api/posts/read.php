<?php
include_once '../../includes/Database.php';
include_once '../../models/Posts.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate Posts object
$post = new Posts($db);

//Post query
$result = $post->read();
//Get row count
$num = $result->rowCount();

//checking records
if($num > 0)
{
  //post array
  $post_arr = array();
  $post_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $post_item = array(
      'post_id' => $post_id,
      'post_title' => $post_title,
      'post_body' => $post_body,
    );

    // Push to data
    array_push($post_arr['data'], $post_item);
  }

  //turn to JSON and output
  echo json_encode($post_arr);
}else{
  echo json_encode(array(
    'message' => 'No Posts Available'
  ));
}
?>
