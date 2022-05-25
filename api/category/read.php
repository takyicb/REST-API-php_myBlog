<?php

  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate category object
  $category = new Category($db);

  //Category post query
  $result  = $category->read();

  //get row count
  $num = $result->rowCount();

  //check result to see if there are data
  if($num > 0){
      $category_arr = array();
      $category_arr['data'] = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $cat_item = array(
            'id' => $id,
            'name' => $name,
            'date' => $created_at
        );

        //push to data
        array_push($category_arr['data'], $cat_item);
      }

      //turn data to Json and output
      echo json_encode($category_arr);       
  }else{
      //No data
      echo json_encode(
        array('mmessage' => 'No Data Found')
    );
  }

  ?>