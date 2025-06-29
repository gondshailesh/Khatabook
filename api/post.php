v<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // for CORS
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$host = "localhost";
$username = "root";
$password = "";
$dbname = "api";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => false, "message" => "Database connection failed"]);
    exit;
}

// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode(["status" => true, "data" => $data]);
        break;

    case "POST":
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['name']) || !isset($input['email'])) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Missing name or email"]);
            break;
        }

        $name = $conn->real_escape_string($input['name']);
        $email = $conn->real_escape_string($input['email']);

        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

        if ($conn->query($sql)) {
            echo json_encode(["status" => true, "message" => "User created"]);
        } else {
            echo json_encode(["status" => false, "message" => "Insert failed"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => false, "message" => "Method not allowed"]);
        break;
}

$conn->close();
?>
