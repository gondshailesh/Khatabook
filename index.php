<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
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

    echo "<div class='alert alert-success'>Successfully added information of Income </div>";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

try {
  // Fetch total amount from 'daily'
  $sql_daily = "SELECT SUM(investmentAmount) AS investmentAmount FROM daily";
  $stmt_daily = $pdo->query($sql_daily);
  $daily_result = $stmt_daily->fetch(PDO::FETCH_ASSOC);


  // Fetch total amount from 'giventaken'
  $sql_giventaken = "SELECT SUM(AmountgivenTaken) AS totalGivenTaken FROM giventaken";
  $stmt_giventaken = $pdo->query($sql_giventaken);
  $giventaken_result = $stmt_giventaken->fetch(PDO::FETCH_ASSOC);

  // Fetch total amount from 'income'
  $sql_income = "SELECT SUM(totalAmount) AS totalIncome FROM income";
  $stmt_income = $pdo->query($sql_income);
  $income_result = $stmt_income->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}




try {
  // Fetch total amount from 'daily_expenses'
  $sql_expenses = "SELECT SUM(expenseAmount) AS totalExpenses FROM daily_expenses";
  $stmt_expenses = $pdo->query($sql_expenses);
  $expenses_result = $stmt_expenses->fetch(PDO::FETCH_ASSOC);

  // Fetch total amount from 'giventaken'
  $sql_giventaken = "SELECT SUM(AmountgivenTaken) AS totalGivenTaken FROM giventaken";
  $stmt_giventaken = $pdo->query($sql_giventaken);
  $giventaken_result = $stmt_giventaken->fetch(PDO::FETCH_ASSOC);

  // Fetch total amount from 'income'
  $sql_income = "SELECT SUM(totalAmount) AS totalIncome FROM income";
  $stmt_income = $pdo->query($sql_income);
  $income_result = $stmt_income->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashbord</title>
  <!-- Include Bootstrap -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Include custom css -->
  <link rel="stylesheet" href="style.css">
  <!-- Include favicon image -->
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>


<div class="body">


  <?php include 'header.php';
  //get message of header function


  ?>
  <style>

  </style>

  <section>
    <div class="text-center mt-4 mb-1">
      <!-- Button to open the modal -->
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#monthly_income">Add Monthly Income</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyInvestmentModal">Add Daily Investment</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#givenTakenModal">Add Given and Taken</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyExpensesModal">Daily Expenses </button>
    </div>
  </section>
  <div class="container py-3 ">
    <!-- Daily Streak Section -->
    <div class="streak-container animate__animated animate__fadeIn bg-warning  bg-opacity-50">
      <h3 class="streak-label">Current Daily Login Streak</h3>
      <div class="streak-count">7 🔥</div>
      <div class="streak-progress">
        <div class="streak-progress-bar" style="width: 70%"></div>
      </div>
      <p>Keep it up! 3 more days to unlock your weekly reward</p>
    </div>

    <!-- Summary Cards Section -->
    <div class="row">
      <!-- Monthly Income Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-income text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Monthly Income</h3>
            <p class="card-subtext">Salary/Business Income</p>
            <?php

            // Display total income
            if ($income_result) {
              echo "<p>Total Income: " . $income_result['totalIncome'] . "</p>";
            } else {
              echo "No income data found.";
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Daily Investment Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-investment text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Daily Investment</h3>
            <p class="card-subtext">Stock/Mutual Funds</p>
            <?php
            if ($daily_result) {
              echo "<p>Totsl  inventment Till Now " . $daily_result['investmentAmount'] . "</p>";
            } else {
              echo "<div class='alert alert-danger'>No given/taken data found.</div>";
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Given & Taken Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-given text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Given & Taken</h3>
            <p class="card-subtext">Loan Transactions</p>
            <?php

            // Display total given/taken
            if ($giventaken_result) {
              echo "<p>Total Given/Taken: " . $giventaken_result['totalGivenTaken'] . "</p>";
            } else {
              echo "<div class='alert alert-danger'>No given/taken data found.</div>";
            }

            ?>
          </div>
        </div>
      </div>

      <!-- Daily Expenses Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-expenses text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Daily Expenses</h3>
            <p class="card-subtext">All Daily Expenditures</p>
            <?php
            // Display total expenses
            if ($expenses_result) {
              echo "<p>Total Daily Expenses: " . $expenses_result['totalExpenses'] . "</p>";
            } else {
              echo "No expenses found.";
            }
            ?>
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
      //pass the message to the same page at the top of the page using header message word
      header("Location: index.php?message=success_income");
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

      // Prepare data for insert
      $dateColumn = '';
      $dateValue = '';

      if ($status == 'giver') {
        $dateColumn = 'dateGiven';
        $dateValue = $dateGiven;
      } elseif ($status == 'taker') {
        $dateColumn = 'dateTaken';
        $dateValue = $dateTaken;
      }

      // Insert data into the database
      try {
        $sql = "INSERT INTO giventaken (name, status, $dateColumn, dateReturning, transactionMessage, AmountgivenTaken)
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $status, $dateValue, $dateReturning, $transactionMessage, $AmountgivenTaken]);

        // Success message with alert at the top of the page
        echo "<div class='alert alert-success alert-dismissible fade show text-center' style='position: fixed; top: 0; left: 0; right: 0; z-index: 1050; padding: 10px 0; font-size: 16px;'>
          Successfully added information of Given OR Taken.
        </div>";
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
  } ?>

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
                <label for="AmountgivenTaken">Amount Given or Taken:</label>
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


  <script>
    // Function to toggle visibility of date input fields based on the status
    function toggleDateFields() {
      var status = document.getElementById('status').value;
      var dateGivenGroup = document.getElementById('dateGivenGroup');
      var dateTakenGroup = document.getElementById('dateTakenGroup');

      if (status === 'giver') {
        dateGivenGroup.style.display = 'block'; // Show date of giving
        dateTakenGroup.style.display = 'none'; // Hide date of taking
      } else if (status === 'taker') {
        dateGivenGroup.style.display = 'none'; // Hide date of giving
        dateTakenGroup.style.display = 'block'; // Show date of taking
      }
    }

    // Initialize on page load to show the correct date field
    document.addEventListener('DOMContentLoaded', function() {
      toggleDateFields();
    });
  </script>






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
          echo "<div class'alert alert-success'>Daily expense added successfully!</div>";
        } catch (PDOException $e) {
          // Handle SQL errors
          echo "Error: " . $e->getMessage();
        }
      }
    }



    try {

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
      // Function to display pagination controls
      function displayPagination($current_page, $total_pages, $query_param = 'page')
      {
        echo "<nav aria-label='Page navigation'>
        <ul class='pagination justify-content-center'>
            <li class='page-item " . ($current_page == 1 ? 'disabled' : '') . "'>
                <a class='page-link' href='?" . $query_param . "=" . ($current_page - 1) . "' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo;</span>
                </a>
            </li>";

        for ($i = 1; $i <= $total_pages; $i++) {
          echo "<li class='page-item " . ($current_page == $i ? 'active' : '') . "'>
                <a class='page-link' href='?" . $query_param . "=" . $i . "'>" . $i . "</a>
              </li>";
        }

        echo "<li class='page-item " . ($current_page == $total_pages ? 'disabled' : '') . "'>
                <a class='page-link' href='?" . $query_param . "=" . ($current_page + 1) . "' aria-label='Next'>
                    <span aria-hidden='true'>&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>";
      }

      // Display data for 'daily' with pagination
      if ($daily_result) {
        $daily_page = isset($_GET['daily_page']) ? max(1, intval($_GET['daily_page'])) : 1;
        $records_per_page = 5;
        $daily_total_pages = ceil(count($daily_result) / $records_per_page);
        $daily_paged_data = array_slice($daily_result, ($daily_page - 1) * $records_per_page, $records_per_page);

        echo "<h2>Daily Investments Table</h2>";
        echo "<div class='table-responsive '>
        <table class='table table-striped table-hover table-bordered w-100 shadow p-5'>
            <thead>
                <tr>
                    <th>Daily ID</th>
                    <th>Investment Source</th>
                    <th>Investment Amount</th>
                    <th>Interest Rate</th>
                    <th>Investment Type</th>
                    <th>Investment Date</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($daily_paged_data as $daily) {
          echo "<tr>";
          foreach ($daily as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
          }
          echo "<td class='text-center'>
            <div class='btn-group' role='group'>
                <a href='edit_daily.php?id=" . $daily['daily_id'] . "' class='btn btn-sm btn-warning' onclick'warning();'>Edit</a>
                <a href='?delete_daily=" . $daily['daily_id'] . "&daily_page=" . $daily_page . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </div>
        </td>";
          echo "</tr>";
        }

        echo "</tbody></table></div>";
        displayPagination($daily_page, $daily_total_pages, 'daily_page');
        echo "<br>";
      } else {
        echo "<div class='alert alert-danger'>No daily investments data found</div>";
      }

      // Display data for 'daily_expenses' with pagination
      if ($daily_expenses_result) {
        $expense_page = isset($_GET['expense_page']) ? max(1, intval($_GET['expense_page'])) : 1;
        $records_per_page = 5;
        $expense_total_pages = ceil(count($daily_expenses_result) / $records_per_page);
        $expense_paged_data = array_slice($daily_expenses_result, ($expense_page - 1) * $records_per_page, $records_per_page);

        echo "<h2>Daily Expenses Table</h2>";
        echo "<div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered w-100 shadow p-5'>
            <thead>
                <tr>
                    <th>Daily Expense ID</th>
                    <th>Expense Name</th>
                    <th>Expense Date</th>
                    <th>Expense Amount</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($expense_paged_data as $expense) {
          echo "<tr>";
          foreach ($expense as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
          }
          echo "<td class='text-center'>
            <div class='btn-group' role='group'>
                <a href='edit_expense.php?id=" . $expense['daily_expense_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                <a href='?delete_expense=" . $expense['daily_expense_id'] . "&expense_page=" . $expense_page . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </div>
        </td>";
          echo "</tr>";
        }

        echo "</tbody></table></div>";
        displayPagination($expense_page, $expense_total_pages, 'expense_page');
        echo "<br>";
      } else {
        echo "<div class='alert alert-danger'>No daily expenses data found</div>";
      }

      // Display data for 'giventaken' with pagination
      if ($giventaken_result) {
        $gt_page = isset($_GET['gt_page']) ? max(1, intval($_GET['gt_page'])) : 1;
        $records_per_page = 5;
        $gt_total_pages = ceil(count($giventaken_result) / $records_per_page);
        $gt_paged_data = array_slice($giventaken_result, ($gt_page - 1) * $records_per_page, $records_per_page);

        echo "<h2>Given/Taken Table</h2>";
        echo "<div class='table-responsive'>
        <table class=' table table-striped table-hover table-bordered w-100 shadow p-5'>
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
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($gt_paged_data as $gt) {
          echo "<tr>";
          foreach ($gt as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
          }
          echo "<td class='text-center'>
            <div class='btn-group' role='group'>
                <a href='edit_giventaken.php?id=" . $gt['giventaken_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                <a href='?delete_giventaken=" . $gt['giventaken_id'] . "&gt_page=" . $gt_page . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </div>
        </td>";
          echo "</tr>";
        }

        echo "</tbody></table></div>";
        displayPagination($gt_page, $gt_total_pages, 'gt_page');
        echo "<br>";
      } else {
        echo "<div class='alert alert-danger'>No given/taken data found.</div><br>";
      }

      // Display data for 'income' with pagination
      if ($income_result) {
        $income_page = isset($_GET['income_page']) ? max(1, intval($_GET['income_page'])) : 1;
        $records_per_page = 5;
        $income_total_pages = ceil(count($income_result) / $records_per_page);
        $income_paged_data = array_slice($income_result, ($income_page - 1) * $records_per_page, $records_per_page);

        echo "<h2>Income Table</h2>";
        echo "<div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered w-100 shadow p-5'>
            <thead>
                <tr>
                    <th>Income ID</th>
                    <th>Income Source</th>
                    <th>Income Type</th>
                    <th>Total Amount</th>
                    <th>Income Date</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($income_paged_data as $income) {
          echo "<tr>";
          foreach ($income as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
          }
          echo "<td class='text-center'>
            <div class='btn-group' role='group'>
                <a href='edit_income.php?id=" . $income['income_id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                <a href='?delete_income=" . $income['income_id'] . "&income_page=" . $income_page . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </div>
        </td>";
          echo "</tr>";
        }

        echo "</tbody></table></div>";
        displayPagination($income_page, $income_total_pages, 'income_page');
        echo "<br>";
      } else {
        echo "<div class='alert alert-danger'> No income data found.</div><br>";
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




<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Initialize AOS -->
<script>
  AOS.init({
    duration: 10000, // animation duration
    easing: 'ease-in-out', // easing effect for animation
    once: true, // animation happens only once when scrolling to the element
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
require_once('footer.php');
?>
</body>

</html>