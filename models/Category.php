<?php
class Category {
    // DB connection
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;

    //constructor for db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //get all categories
    public function read(){
        $query = 'SELECT * FROM '. $this->table;
      
      $stmt = $this->conn->prepare($query);    
      $stmt->execute();
      return $stmt;
    }

    //get a single category
    public function read_single() {
        // Create query
        $query = 'SELECT * FROM '. $this->table . ' WHERE id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->date = $row['created_at'];       
    }

    // Create category
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
       
        // Bind data
        $stmt->bindParam(':name', $this->name);       

        // Execute query
        if($stmt->execute()) {
          return true;
         }

        // Print error if something goes wrong
       printf("Error: %s.\n", $stmt->error);

        return false;
    }

     // Update Category
     public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET name = :name
                              WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));        
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':name', $this->name);       
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Category
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }



}

?>