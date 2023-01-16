<?php
class Posts{
//database connection and table name
private $conn;
private $table_name = "posts";

//Posts tabel properties
public $post_id;
public $post_title;
public $post_body;

//constructor with debug
public function __construct($db){
$this->conn = $db;
}

//create post
public function create_post(){
//create query
$query = 'INSERT INTO ' . $this->table_name .'
SET
post_title = :post_title,
post_body = :post_body';

//Prepare statement
$stmt = $this->conn->prepare($query);

//Clean Data
$this->post_title = htmlspecialchars(strip_tags($this->post_title));
$this->post_body = htmlspecialchars(strip_tags($this->post_body));

//Bind Data
$stmt->bindParam(':post_title', $this->post_title);
$stmt->bindParam(':post_body', $this->post_body);

//Execute the Query
if($stmt->execute()){
return true;
}else{
  printf("Error: %s.\n", $stmt->error);
  return false;
}
}

//Read all Post
public function read(){
  //create Query
  $query = 'SELECT post_id, post_title, post_body
            FROM ' . $this->table_name . ' ORDER BY post_id DESC';

//prepare statement
$stmt = $this->conn->prepare($query);

//Execute Query
$stmt->execute();

return $stmt;
}

//Read Single Post
public function read_single(){
  //create query
  $query = 'SELECT post_id, post_title, post_body
            FROM ' . $this->table_name . '
            WHERE post_id = ? LIMIT 0,1';

//prepare statement
$stmt = $this->conn->prepare($query);
//Bind ID
$stmt->bindParam(1, $this->post_id);
//Execute query
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

//set Properties
$this->post_id = $row['post_id'];
$this->post_title = $row['post_title'];
$this->post_body = $row['post_body'];

}


//Update Post
public function update_post(){
//create query
$query = 'UPDATE ' . $this->table_name .'
SET
post_title = :post_title,
post_body = :post_body
WHERE post_id = :post_id';

//Prepare statement
$stmt = $this->conn->prepare($query);

//Clean Data
$this->post_id = htmlspecialchars(strip_tags($this->post_id));
$this->post_title = htmlspecialchars(strip_tags($this->post_title));
$this->post_body = htmlspecialchars(strip_tags($this->post_body));

//Bind Data
$stmt->bindParam(':post_id', $this->post_id);
$stmt->bindParam(':post_title', $this->post_title);
$stmt->bindParam(':post_body', $this->post_body);

//Execute the Query
if($stmt->execute()){
return true;
}else{
  printf("Error: %s.\n", $stmt->error);
  return false;
}

}

//Delete POST
public function delete_post(){
  //Create query
  $query = 'DELETE FROM ' . $this->table_name . ' WHERE post_id = :post_id';
  //Prepare statement
  $stmt = $this->conn->prepare($query);
  //Clean Data
  $this->post_id = htmlspecialchars(strip_tags($this->post_id));
  //Bind Data
  $stmt->bindParam(':post_id', $this->post_id);

  //Execute the Query
  if($stmt->execute()){
  return true;
  }else{
    printf("Error: %s.\n", $stmt->error);
    return false;
  }
  

}

}// class ends
 ?>
