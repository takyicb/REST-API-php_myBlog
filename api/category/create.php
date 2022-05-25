<?php
  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acess-Control-Allow-Methods: POST');
  header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Acess-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate category object
  $category = new Category($db);

  //Get raw poste data
  $data = json_decode(file_get_contents('php://input'));

  $category->name = $data->name;
 
  //create post
  if($category->create()){
      echo json_encode(
          array('message' => 'Category Created')
      );
  }else{
    echo json_encode(
        array('message' => 'Category  Not Created')
    );
  }



?>