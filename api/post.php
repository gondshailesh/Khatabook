<?php
header('Content-Type:Application/json');


//connect to database
require'config.php';


//post Api




// API Endpoints
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get all users
    // if (isset($_GET['user_id'])) {?
      $sql = 'SELECT * FROM info';
      $result = $conn->query($sql);

      if($result->num_rows > 0){
        $users = array();
        while ($row = $result->fetch_assoc()) {
          $users[] = $row;
        }
        $obj = array(
          'status' => 200,
          'message' => 'success',
          'data' => $users
      );
        echo json_encode($obj);
      }else{
        $obj1 = array(
            'status' => 404,
            'message' => 'Data is not found'
            
        );
          echo json_encode($obj1);
      }

 
    }
// }
?>r