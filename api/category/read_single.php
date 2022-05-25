<?php
  //Headers
  header('Acess-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DB & connet
  $database = new Database();
  $db = $database->connect();

  //Instatiate Category post object
  $category = new Category($db);

  //Get ID from url
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  //get post
  $category->read_single();

  //create array 
  $cat_arr = array(
      'id' => $category->id,
      'name' => $category->name,
      'date' => $category->date     
  );

  //output
  print_r(json_encode($cat_arr));


?>