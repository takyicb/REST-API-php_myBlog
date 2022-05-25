<?php
  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Acess-Control-Allow-Methods: DELETE');
  header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Acess-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate blog Category object
  $category = new Category($db);
  
  //Get raw poste data
  $data = json_decode(file_get_contents('php://input'));

  //set id for update
  $category->id =  $data->id;  

  //update cate$category
  if($category->delete()){
      echo json_encode(
          array('message' => 'Category Deleted')
      );
  }else{
    echo json_encode(
        array('message' => 'Category  Not Deleted')
    );
  }

  ?>