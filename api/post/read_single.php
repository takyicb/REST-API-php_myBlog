<?php
  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate blog post object
  $post = new Post($db);

  //Get ID from url
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  //get post
  $post->read_single();

  //create array 
  $post_arr = array(
      'id' => $post->id,
      'title' => $post->title,
      'body' => $post->body,
      'author' => $post->author,
      'created_at' => $post->category_id,
      'created_name' => $post->category_name
  );

  //output
  print_r(json_encode($post_arr));


?>