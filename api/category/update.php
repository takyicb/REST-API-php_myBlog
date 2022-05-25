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

  //Instatiate blog category object
  $category = new Category($db);
  
  //Get raw poste data
  $data = json_decode(file_get_contents('php://input'));

  //set id for update
  $category->id =  $data->id;

  $category->name = $data->name;
 

  //update post
  if($category->update()){
      echo json_encode(
          array('message' => 'Category Updated')
      );
  }else{
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
  }

  ?>