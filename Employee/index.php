<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "employee_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $message = ''; // Variable to store messages (success or error)

        // Add Employee
        if (isset($_POST['add_employee'])) {
            $name = $_POST['name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $position = $_POST['position'];
            $salary = $_POST['salary'];
            $date_of_joining = $_POST['date_of_joining'];

            $sql = "INSERT INTO employees (name, last_name, email, phone, position, salary, date_of_joining)
            VALUES ('$name', '$last_name', '$email', '$phone', '$position', '$salary', '$date_of_joining')";

            if ($conn->query($sql) === TRUE) {
                $message = '<div class="alert alert-success" role="alert">New record created successfully!</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
            }
        }

        // Update Employee
        if (isset($_POST['update_employee'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $position = $_POST['position'];
            $salary = $_POST['salary'];
            $date_of_joining = $_POST['date_of_joining'];

            $sql = "UPDATE employees SET name='$name', last_name='$last_name', email='$email', phone='$phone', position='$position', salary='$salary', date_of_joining='$date_of_joining' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                $message = '<div class="alert alert-success" role="alert">Record updated successfully!</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
            }
        }

        // Delete Employee
        if (isset($_POST['delete_employee'])) {
            $id = $_POST['id'];

            $sql = "DELETE FROM employees WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                $message = '<div class="alert alert-success" role="alert">Record deleted successfully!</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
            }
        }

        // Fetch all employees
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);
        ?>

        <div class="container mt-5">
            <h2 class="text-center">Employee Management System</h2>
            <hr>

            <!-- Display Message -->
            <?php if ($message) {
                echo $message;
            } ?>

            <!-- Add Employee Form -->
            <h4>Add New Employee</h4>
            <form action="" method="POST" class="w-50 bg-info bg-opacity-25 form-control">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" step="0.01" class="form-control" id="salary" name="salary">
                </div>
                <div class="mb-3">
                    <label for="date_of_joining" class="form-label">Date of Joining</label>
                    <input type="date" class="form-control" id="date_of_joining" name="date_of_joining">
                </div>
                <button type="submit" name="add_employee" class="btn btn-success">Add Employee</button>
            </form>

            <hr>

            <!-- Employee Table -->
            <h4>All Employees</h4>
            <table class="table  table-hover ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Date of Joining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <form method="POST">
                                <td><?php echo $row['id']; ?></td>
                                <td><input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>" required></td>
                                <td><input class="form-control" type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required></td>
                                <td><input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>" required></td>
                                <td><input class="form-control" type="text" name="phone" value="<?php echo $row['phone']; ?>"></td>
                                <td><input class="form-control" type="text" name="position" value="<?php echo $row['position']; ?>"></td>
                                <td><input class="form-control" type="number" step="0.01" name="salary" value="<?php echo $row['salary']; ?>"></td>
                                <td><input class="form-control" type="date" name="date_of_joining" value="<?php echo $row['date_of_joining']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                </td>
                                <td>

                                    <button type="submit" name="update_employee" class="btn  btn-warning">Update</button>
                                    <button type="submit" name="delete_employee" class="btn  btn-danger">Delete</button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>