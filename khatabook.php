<?php
session_start();







if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
include('conn.php');
// Handle form submission

if (isset($_POST['income'])) {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $incomeSource = $_POST['incomeSource'];
    $totalAmount = $_POST['totalAmount'];
    $incomeType = $_POST['incomeType'];
    $incomeDate = $_POST['incomeDate'];
  }

  // Insert data into the database
  try {
    $sql = "INSERT INTO income (incomeSource, totalAmount, incomeType, incomeDate)
                VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$incomeSource, $totalAmount, $incomeType, $incomeDate]);

    echo "Successfully added information of Income ";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}


// Fetch total amount from the 'expenseAmount' column
try {
  $sql = "SELECT SUM(expenseAmount) AS totalAmount FROM daily_expenses";
  $stmt = $pdo->query($sql);  // Execute the query
  $result = $stmt->fetch(PDO::FETCH_ASSOC);  // Fetch the result

  // If there's a result, display the total amount
  if ($result) {
  } else {
    echo "No expenses found.";
  }
} catch (PDOException $e) {
  // Handle errors (e.g., if the query fails)
  echo "Error: " . $e->getMessage();
}
// Fetch total amount from the 'expenseAmount' column
$sql = "SELECT SUM(expenseAmount) AS totalAmount FROM daily_expenses";
$stmt = $pdo->query($sql);  // Execute the query
$result = $stmt->fetch(PDO::FETCH_ASSOC);
// If there's a result, display the total amount

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashbord</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">

</head>



<body class="body" style="background: rgb(245,224,101);
background: linear-gradient(56deg, rgba(245,224,101,0.38707983193277307) 0%, rgba(245,155,219,0.5859593837535014) 47%, rgba(245,165,207,0.3534663865546218) 100%);
">

  <?php include 'header.php';

  // Fetch total amount from the 'expenseAmount' column


  ?>
  <section>
    <div class="text-center mt-4 mb-5">
      <!-- Button to open the modal -->
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#monthly_income">Add Monthly Income</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyInvestmentModal">Add Daily Investment</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#givenTakenModal">Add Given and Taken</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyExpensesModal">Daily Expenses </button>
    </div>
  </section>
  <div class="container container-main  mt-lg-5 rounded-1">
    <div class="mt-lg-5">
      <div class="spacingtop">
        <div class="row mt-3 justify-content-center text-center">
          <div class="col-lg-5 col-md-6 col-sm-12 bg-light bg-opacity-25 rounded-1 shadow  m-2 p-5 clr p-3 bxone content-center">
            <p class="h2">Monthly Income</p>
            <p>like salary/Business/</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-light bg-opacity-25 rounded-1 shadow  m-2 p-5 clr p-3 bxtwo content-center">
            <p class="h2">Daily Investment</p>
            <p>like stock investment</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-light bg-opacity-25 rounded-1 shadow m-2 p-5 clr p-3 bxthree content-center">
            <p class="h2">Given & Take</p>
            <p>Record Maintenance</p>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12 bg-light bg-opacity-25 rounded-1 shadow  m-2 p-5 clr p-3 bxfour content-center">

            <p class="h2">Daily Expenses</p>
            <p>Weekly/Monthly/Yearly Report Generation</p>
            <?php
            if ($result) {
              echo "<p class=''>Total Daily expense Amount: " . $result['totalAmount'] . "</p>  ";
            } else {
              echo "No expenses found.";
            }


            ?>

          </div>
        </div>
      </div>
    </div>
  </div>




  </div>

  <!-- Modal Monthly income -->
  <div class="modal fade " id="monthly_income" tabindex="-1" aria-labelledby="monthly_incomeLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="monthly_incomeLabel">Add Monthly Income</h1> <!-- Updated title -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <h2 class="text-center mb-4">Add Income Information</h2>

            <form action="" method="POST">
              <!-- Income Source -->
              <div class="form-group">
                <label for="incomeSource">Income Source:</label>
                <input type="text" class="form-control" id="incomeSource" name="incomeSource" required>
              </div>

              <!-- Income Type (Dropdown) -->
              <div class="form-group">
                <label for="incomeType">Income Type:</label>
                <select class="form-control" id="incomeType" name="incomeType" required>
                  <option value="">Select Income Type</option>
                  <option value="business">Business</option>
                  <option value="salary">Salary</option>
                  <option value="freelance">Freelance</option>
                  <option value="investment">Investment</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <!-- Total Amount -->
              <div class="form-group">
                <label for="totalAmount">Total Amount:</label>
                <input type="number" class="form-control" id="totalAmount" name="totalAmount" required>
              </div>

              <!-- Date (current date selected by default) -->
              <div class="form-group">
                <label for="incomeDate">Date:</label>
                <input type="date" class="form-control" id="incomeDate" name="incomeDate" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <!-- Submit Button -->
              <div class="form-group text-center">
                <button type="submit" name="income" class="btn btn-primary mt-5">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  if (isset($_POST['daily'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $investmentSource = $_POST['investmentSource'];
      $investmentAmount = $_POST['investmentAmount'];
      $interestRate = $_POST['interestRate'];
      $investmentType = $_POST['investmentType'];
      $investmentDate = $_POST['investmentDate'];
    }

    // Insert data into the database
    try {
      $sql = "INSERT INTO daily (investmentSource, investmentAmount, interestRate, investmentType, investmentDate)
                VALUES (?, ?, ?, ?,?)";

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$investmentSource, $investmentAmount, $interestRate, $investmentType, $investmentDate]);

      echo "Successfully added information of Income ";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  ?>
  <!-- Modal Daily Investment -->
  <div class="modal fade" id="dailyInvestmentModal" tabindex="-1" aria-labelledby="dailyInvestmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="dailyInvestmentModalLabel">Add Daily Investment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <h2 class="text-center mb-4">Add Daily Investment Information</h2>

            <form action="" method="POST">
              <!-- Investment Source -->
              <div class="form-group">
                <label for="investmentSource">Investment Source:</label>
                <input type="text" class="form-control" id="investmentSource" name="investmentSource" required>
              </div>

              <!-- Investment Amount -->
              <div class="form-group">
                <label for="investmentAmount">Investment Amount:</label>
                <input type="number" class="form-control" id="investmentAmount" name="investmentAmount" required>
              </div>

              <!-- Interest -->
              <div class="form-group">
                <label for="interestRate">Interest Rate (%):</label>
                <input type="number" class="form-control" id="interestRate" name="interestRate" step="0.01" required>
              </div>

              <!-- Investment Type (Dropdown) -->
              <div class="form-group">
                <label for="investmentType">Investment Type:</label>
                <select class="form-control" id="investmentType" name="investmentType" required>
                  <option value="stock">Stock</option>
                  <option value="sip">SIP</option>
                  <option value="mutualFund">Mutual Fund</option>
                  <option value="bonds">Bonds</option>
                  <option value="realEstate">Real Estate</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <!-- Date (current date selected by default) -->
              <div class="form-group">
                <label for="investmentDate">Date:</label>
                <input type="date" class="form-control" id="investmentDate" name="investmentDate" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <!-- Submit Button -->
              <div class="form-group text-center">
                <button type="submit" name="daily" class="btn btn-primary mt-5">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>








  <?php
  // Establish PDO connection (replace with your actual DB credentials)
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=Khata_book', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Could not connect to the database " . $e->getMessage());
  }

  // Handle the form submission
  if (isset($_POST['GivenTaken'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Ensure these POST values are set before using them
      $name = $_POST['name'] ?? '';
      $status = $_POST['status'] ?? '';
      $AmountgivenTaken = $_POST['AmountgivenTaken'] ?? '';
      $dateGiven = $_POST['dateGiven'] ?? '';
      $dateTaken = $_POST['dateTaken'] ?? '';
      $dateReturning = $_POST['dateReturning'] ?? '';
      $transactionMessage = $_POST['transactionMessage'] ?? '';

      // Insert data into the database
      try {
        $sql = "INSERT INTO giventaken (name, status, dateGiven, dateTaken, dateReturning, transactionMessage)
                    VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $status, $dateGiven, $dateTaken, $dateReturning, $transactionMessage]);

        echo "Successfully added information of Given OR Taken.";
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
  }
  ?>

  <!-- Modal Given & Taken -->
  <div class="modal fade" id="givenTakenModal" tabindex="-1" aria-labelledby="givenTakenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="givenTakenModalLabel">Add Given & Taken Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <h2 class="text-center mb-4">Add Given & Taken Information</h2>

            <form action="" method="POST">
              <!-- Name of Giver -->
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="name">Amount Given or taken:</label>
                <input type="number" class="form-control" id="AmountgivenTaken" name="AmountgivenTaken" required>
              </div>

              <!-- Dropdown for Giver or Taker -->
              <div class="form-group">
                <label for="status">Status (Giver/Taker):</label>
                <select class="form-control" id="status" name="status" required onchange="toggleDateFields()">
                  <option value="giver">Giver</option>
                  <option value="taker">Taker</option>
                </select>
              </div>

              <!-- Date of Giving (if Giver) -->
              <div class="form-group" id="dateGivenGroup">
                <label for="dateGiven">Date of Giving:</label>
                <input type="date" class="form-control" id="dateGiven" name="dateGiven" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <!-- Date of Taking (if Taker) -->
              <div class="form-group" id="dateTakenGroup">
                <label for="dateTaken">Date of Taking:</label>
                <input type="date" class="form-control" id="dateTaken" name="dateTaken" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <!-- Date of Returning (for both Giver/Taker) -->
              <div class="form-group">
                <label for="dateReturning">Date of Returning:</label>
                <input type="date" class="form-control" id="dateReturning" name="dateReturning" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <!-- Comment/Message about the transaction -->
              <div class="form-group">
                <label for="transactionMessage">Comment about the Transaction:</label>
                <textarea class="form-control" id="transactionMessage" name="transactionMessage" rows="5" placeholder="Write a message about the giving or taking..." required></textarea>
              </div>

              <!-- Submit Button -->
              <div class="form-group text-center mt-5">
                <button type="submit" name="GivenTaken" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <?php
    // Establish PDO connection
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      try {
        $pdo = new PDO('mysql:host=localhost;dbname=Khata_book', 'root', '');  // Update with your DB credentials
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Set error mode to exception
      } catch (PDOException $e) {
        die("Could not connect to the database " . $e->getMessage());
      }

      // Check if the necessary POST data is set
      if (isset($_POST['expenseName']) && isset($_POST['expenseDate']) && isset($_POST['expenseAmount'])) {
        $expenseName = $_POST['expenseName'];
        $expenseDate = $_POST['expenseDate'];
        $expenseAmount = $_POST['expenseAmount'];

        // Prepare SQL query to insert data into the table
        try {
          $sql = "INSERT INTO daily_expenses (expenseName, expenseDate, expenseAmount)
                    VALUES (?, ?, ?)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$expenseName, $expenseDate, $expenseAmount]);

          // Show success message
          echo "Daily expense added successfully!";
        } catch (PDOException $e) {
          // Handle SQL errors
          echo "Error: " . $e->getMessage();
        }
      }
    }



    try {
      // Fetch data for 'users'
      $sql_users = "SELECT id AS user_id, first_name, last_name, middle_name, user_type, dob, gender, email, phone FROM users";
      $stmt = $pdo->query($sql_users);
      $users_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Fetch data for 'daily'
      $sql_daily = "SELECT id AS daily_id, investmentSource, investmentAmount, interestRate, investmentType, investmentDate FROM daily";
      $stmt = $pdo->query($sql_daily);
      $daily_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Fetch data for 'daily_expenses'
      $sql_daily_expenses = "SELECT id AS daily_expense_id, expenseName, expenseDate, expenseAmount FROM daily_expenses";
      $stmt = $pdo->query($sql_daily_expenses);
      $daily_expenses_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Fetch data for 'giventaken'
      $sql_giventaken = "SELECT id AS giventaken_id, name, status, dateGiven, dateTaken, dateReturning, transactionMessage, AmountgivenTaken FROM giventaken";
      $stmt = $pdo->query($sql_giventaken);
      $giventaken_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Fetch data for 'income'
      $sql_income = "SELECT id AS income_id, incomeSource, incomeType, totalAmount, incomeDate FROM income";
      $stmt = $pdo->query($sql_income);
      $income_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Database Tables</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>

      <?php
      if ($users_result) {
        echo "<h2>Users Table</h2>";
        echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered w-100 shadow'>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Middle Name</th>
                        <th>User Type</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($users_result as $user) {
          echo "<tr>";
          foreach ($user as $value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table></div><br>";
      } else {
        echo "No users data found.<br>";
      }

      if ($daily_result) {
        echo "<h2>Daily Investments Table</h2>";
        echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered w-100 shadow'>
                <thead>
                    <tr>
                        <th>Daily ID</th>
                        <th>Investment Source</th>
                        <th>Investment Amount</th>
                        <th>Interest Rate</th>
                        <th>Investment Type</th>
                        <th>Investment Date</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($daily_result as $daily) {
          echo "<tr>";
          foreach ($daily as $value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table></div><br>";
      } else {
        echo "No daily investments data found.<br>";
      }

      if ($daily_expenses_result) {
        echo "<h2>Daily Expenses Table</h2>";
        echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered w-100 shadow'>
                <thead>
                    <tr>
                        <th>Daily Expense ID</th>
                        <th>Expense Name</th>
                        <th>Expense Date</th>
                        <th>Expense Amount</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($daily_expenses_result as $expense) {
          echo "<tr>";
          foreach ($expense as $value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table></div><br>";
      } else {
        echo "No daily expenses data found.<br>";
      }

      if ($giventaken_result) {
        echo "<h2>Given/Taken Table</h2>";
        echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered w-100 shadow'>
                <thead>
                    <tr>
                        <th>Given/Taken ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Date Given</th>
                        <th>Date Taken</th>
                        <th>Date Returning</th>
                        <th>Transaction Message</th>
                        <th>Amount Given/Taken</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($giventaken_result as $gt) {
          echo "<tr>";
          foreach ($gt as $value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table></div><br>";
      } else {
        echo "No given/taken data found.<br>";
      }

      if ($income_result) {
        echo "<h2>Income Table</h2>";
        echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered w-100 shadow'>
                <thead>
                    <tr>
                        <th>Income ID</th>
                        <th>Income Source</th>
                        <th>Income Type</th>
                        <th>Total Amount</th>
                        <th>Income Date</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($income_result as $income) {
          echo "<tr>";
          foreach ($income as $value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table></div><br>";
      } else {
        echo "No income data found.<br>";
      }

      ?>
  </div>
</body>

<section>
  <div class="container">

  </div>
</section>

</html>






<!-- Modal Daily Expenses -->
<div class="modal fade" id="dailyExpensesModal" tabindex="-1" aria-labelledby="dailyExpensesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="dailyExpensesModalLabel">Add Daily Expenses</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <h2 class="text-center mb-4">Add Daily Expense Information</h2>

          <form action="" method="POST">
            <!-- Expense Name -->
            <div class="form-group">
              <label for="expenseName">Expense Name:</label>
              <input type="text" class="form-control" id="expenseName" name="expenseName" required>
            </div>

            <!-- Date of Expense -->
            <div class="form-group">
              <label for="expenseDate">Date of Expense:</label>
              <input type="date" class="form-control" id="expenseDate" name="expenseDate" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <!-- Amount -->
            <div class="form-group">
              <label for="expenseAmount">Amount:</label>
              <input type="number" class="form-control" id="expenseAmount" name="expenseAmount" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group text-center mt-5">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" name="expense" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>









<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>