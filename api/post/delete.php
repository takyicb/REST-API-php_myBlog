<?php
  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acess-Control-Allow-Methods: DELETE');
  header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Acess-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate blog post object
  $post = new Post($db);
  
  //Get raw poste data
  $data = json_decode(file_get_contents('php://input'));

  //set id for update
  $post->id =  $data->id;  

  //update post
  if($post->delete()){
      echo json_encode(
          array('message' => 'Post Deleted')
      );
  }else{
    echo json_encode(
        array('message' => 'Post  Not Deleted')
    );
  }

  ?>