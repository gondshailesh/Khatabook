<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

include('conn.php');

// Initialize alerts array
$alerts = [];

// Handle form submissions
handleFormSubmissions();

// Fetch summary data
$summaryData = fetchSummaryData();

// Fetch table data with pagination
$tableData = fetchTableData();

// Handle deletions
handleDeletions();

// Function to handle all form submissions
function handleFormSubmissions()
{
  global $pdo, $alerts;

  // Monthly Income Form
  if (isset($_POST['income'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $incomeSource = $_POST['incomeSource'];
      $totalAmount = $_POST['totalAmount'];
      $incomeType = $_POST['incomeType'];
      $incomeDate = $_POST['incomeDate'];

      try {
        $sql = "INSERT INTO income (incomeSource, totalAmount, incomeType, incomeDate)
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$incomeSource, $totalAmount, $incomeType, $incomeDate]);
        $alerts[] = ['success', 'Successfully added information of Income'];
      } catch (PDOException $e) {
        $alerts[] = ['danger', "Error: " . $e->getMessage()];
      }
    }
  }

  // Daily Investment Form
  if (isset($_POST['daily'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $investmentSource = $_POST['investmentSource'];
      $investmentAmount = $_POST['investmentAmount'];
      $interestRate = $_POST['interestRate'];
      $investmentType = $_POST['investmentType'];
      $investmentDate = $_POST['investmentDate'];

      try {
        $sql = "INSERT INTO daily (investmentSource, investmentAmount, interestRate, investmentType, investmentDate)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$investmentSource, $investmentAmount, $interestRate, $investmentType, $investmentDate]);
        $alerts[] = ['success', 'Successfully added information of Daily Investment'];
      } catch (PDOException $e) {
        $alerts[] = ['danger', "Error: " . $e->getMessage()];
      }
    }
  }

  // Given/Taken Form
  if (isset($_POST['GivenTaken'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'] ?? '';
      $status = $_POST['status'] ?? '';
      $AmountgivenTaken = $_POST['AmountgivenTaken'] ?? '';
      $dateGiven = $_POST['dateGiven'] ?? '';
      $dateTaken = $_POST['dateTaken'] ?? '';
      $dateReturning = $_POST['dateReturning'] ?? '';
      $transactionMessage = $_POST['transactionMessage'] ?? '';

      $dateColumn = ($status == 'giver') ? 'dateGiven' : 'dateTaken';
      $dateValue = ($status == 'giver') ? $dateGiven : $dateTaken;

      try {
        $sql = "INSERT INTO giventaken (name, status, $dateColumn, dateReturning, transactionMessage, AmountgivenTaken)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $status, $dateValue, $dateReturning, $transactionMessage, $AmountgivenTaken]);
        $alerts[] = ['success', 'Successfully added information of Given OR Taken'];
      } catch (PDOException $e) {
        $alerts[] = ['danger', "Error: " . $e->getMessage()];
      }
    }
  }

  // Daily Expenses Form
  if (isset($_POST['expense'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $expenseName = $_POST['expenseName'];
      $expenseDate = $_POST['expenseDate'];
      $expenseAmount = $_POST['expenseAmount'];

      try {
        $sql = "INSERT INTO daily_expenses (expenseName, expenseDate, expenseAmount)
                VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$expenseName, $expenseDate, $expenseAmount]);
        $alerts[] = ['success', 'Daily expense added successfully!'];
      } catch (PDOException $e) {
        $alerts[] = ['danger', "Error: " . $e->getMessage()];
      }
    }
  }
}

// Function to fetch summary data
function fetchSummaryData()
{
  global $pdo;
  $data = [];

  try {
    // Fetch total investment from 'daily'
    $sql_daily = "SELECT SUM(investmentAmount) AS investmentAmount FROM daily";
    $stmt_daily = $pdo->query($sql_daily);
    $data['daily'] = $stmt_daily->fetch(PDO::FETCH_ASSOC);

    // Fetch total amount from 'giventaken'
    $sql_giventaken = "SELECT SUM(AmountgivenTaken) AS totalGivenTaken FROM giventaken";
    $stmt_giventaken = $pdo->query($sql_giventaken);
    $data['giventaken'] = $stmt_giventaken->fetch(PDO::FETCH_ASSOC);

    // Fetch total amount from 'income'
    $sql_income = "SELECT SUM(totalAmount) AS totalIncome FROM income";
    $stmt_income = $pdo->query($sql_income);
    $data['income'] = $stmt_income->fetch(PDO::FETCH_ASSOC);

    // Fetch total expenses from 'daily_expenses'
    $sql_expenses = "SELECT SUM(expenseAmount) AS totalExpenses FROM daily_expenses";
    $stmt_expenses = $pdo->query($sql_expenses);
    $data['expenses'] = $stmt_expenses->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $data['error'] = "Error: " . $e->getMessage();
  }

  return $data;
}

// Function to fetch table data with pagination
function fetchTableData()
{
  global $pdo;
  $data = [];

  try {
    // Fetch data for 'daily'
    $sql_daily = "SELECT id AS daily_id, investmentSource, investmentAmount, interestRate, investmentType, investmentDate FROM daily";
    $stmt = $pdo->query($sql_daily);
    $data['daily'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data for 'daily_expenses'
    $sql_daily_expenses = "SELECT id AS daily_expense_id, expenseName, expenseDate, expenseAmount FROM daily_expenses";
    $stmt = $pdo->query($sql_daily_expenses);
    $data['daily_expenses'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data for 'giventaken'
    $sql_giventaken = "SELECT id AS giventaken_id, name, status, dateGiven, dateTaken, dateReturning, transactionMessage, AmountgivenTaken FROM giventaken";
    $stmt = $pdo->query($sql_giventaken);
    $data['giventaken'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data for 'income'
    $sql_income = "SELECT id AS income_id, incomeSource, incomeType, totalAmount, incomeDate FROM income";
    $stmt = $pdo->query($sql_income);
    $data['income'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $data['error'] = "Error: " . $e->getMessage();
  }

  return $data;
}

// Function to handle deletions
function handleDeletions()
{
  global $pdo, $alerts;

  // Delete Daily Investment
  if (isset($_GET['delete_daily'])) {
    $id = $_GET['delete_daily'];
    try {
      $sql = "DELETE FROM daily WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      $alerts[] = ['success', 'Daily investment deleted successfully'];
    } catch (PDOException $e) {
      $alerts[] = ['danger', "Error deleting daily investment: " . $e->getMessage()];
    }
  }

  // Delete Daily Expense
  if (isset($_GET['delete_expense'])) {
    $id = $_GET['delete_expense'];
    try {
      $sql = "DELETE FROM daily_expenses WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      $alerts[] = ['success', 'Daily expense deleted successfully'];
    } catch (PDOException $e) {
      $alerts[] = ['danger', "Error deleting daily expense: " . $e->getMessage()];
    }
  }

  // Delete Given/Taken
  if (isset($_GET['delete_giventaken'])) {
    $id = $_GET['delete_giventaken'];
    try {
      $sql = "DELETE FROM giventaken WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      $alerts[] = ['success', 'Given/Taken record deleted successfully'];
    } catch (PDOException $e) {
      $alerts[] = ['danger', "Error deleting given/taken record: " . $e->getMessage()];
    }
  }

  // Delete Income
  if (isset($_GET['delete_income'])) {
    $id = $_GET['delete_income'];
    try {
      $sql = "DELETE FROM income WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      $alerts[] = ['success', 'Income record deleted successfully'];
    } catch (PDOException $e) {
      $alerts[] = ['danger', "Error deleting income record: " . $e->getMessage()];
    }
  }
}

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Include Bootstrap -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Include custom css -->
  <link rel="stylesheet" href="style.css">
  <!-- Include favicon image -->
  <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="body">
  <!-- Display alerts before header -->
  <?php if (!empty($alerts)): ?>
    <div class="alert-container">
      <?php foreach ($alerts as $alert): ?>
        <div class="alert alert-<?= $alert[0] ?> alert-dismissible fade show text-center" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1050; padding: 10px 0; font-size: 16px;">
          <?= $alert[1] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php include 'header.php'; ?>

  <section>
    <div class="text-center mt-4 mb-1">
      <!-- Buttons to open modals -->
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#monthly_income">Add Monthly Income</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyInvestmentModal">Add Daily Investment</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#givenTakenModal">Add Given and Taken</button>
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyExpensesModal">Daily Expenses</button>
    </div>
  </section>

  <div class="container py-3">
    <!-- Daily Streak Section -->
    <div class="streak-container animate__animated animate__fadeIn bg-warning bg-opacity-50">
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
            <?php if ($summaryData['income']): ?>
              <p>Total Income: <?= $summaryData['income']['totalIncome'] ?? 0 ?></p>
            <?php else: ?>
              <p>No income data found.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Daily Investment Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-investment text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Daily Investment</h3>
            <p class="card-subtext">Stock/Mutual Funds</p>
            <?php if ($summaryData['daily']): ?>
              <p>Total investment Till Now: <?= $summaryData['daily']['investmentAmount'] ?? 0 ?></p>
            <?php else: ?>
              <div class='alert alert-danger'>No investment data found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Given & Taken Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-given text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Given & Taken</h3>
            <p class="card-subtext">Loan Transactions</p>
            <?php if ($summaryData['giventaken']): ?>
              <p>Total Given/Taken: <?= $summaryData['giventaken']['totalGivenTaken'] ?? 0 ?></p>
            <?php else: ?>
              <div class='alert alert-danger'>No given/taken data found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Daily Expenses Card -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-summary card-expenses text-center p-4">
          <div class="card-body">
            <h3 class="card-title">Daily Expenses</h3>
            <p class="card-subtext">All Daily Expenditures</p>
            <?php if ($summaryData['expenses']): ?>
              <p>Total Daily Expenses: <?= $summaryData['expenses']['totalExpenses'] ?? 0 ?></p>
            <?php else: ?>
              <p>No expenses found.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tables Section -->
  <div class="container">
    <!-- Daily Investments Table -->
    <?php if (!empty($tableData['daily'])): ?>
      <?php
      $daily_page = isset($_GET['daily_page']) ? max(1, intval($_GET['daily_page'])) : 1;
      $records_per_page = 5;
      $daily_total_pages = ceil(count($tableData['daily']) / $records_per_page);
      $daily_paged_data = array_slice($tableData['daily'], ($daily_page - 1) * $records_per_page, $records_per_page);
      ?>
      <h2>Daily Investments Table</h2>
      <div class='table-responsive'>
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
          <tbody>
            <?php foreach ($daily_paged_data as $daily): ?>
              <tr>
                <?php foreach ($daily as $value): ?>
                  <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td class='text-center'>
                  <div class='btn-group' role='group'>
                    <a href='edit_daily.php?id=<?= $daily['daily_id'] ?>' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='?delete_daily=<?= $daily['daily_id'] ?>&daily_page=<?= $daily_page ?>' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure you want to delete this record?")'>Delete</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php displayPagination($daily_page, $daily_total_pages, 'daily_page'); ?>
      <br>
    <?php else: ?>
      <div class='alert alert-danger'>No daily investments data found</div>
    <?php endif; ?>

    <!-- Daily Expenses Table -->
    <?php if (!empty($tableData['daily_expenses'])): ?>
      <?php
      $expense_page = isset($_GET['expense_page']) ? max(1, intval($_GET['expense_page'])) : 1;
      $records_per_page = 5;
      $expense_total_pages = ceil(count($tableData['daily_expenses']) / $records_per_page);
      $expense_paged_data = array_slice($tableData['daily_expenses'], ($expense_page - 1) * $records_per_page, $records_per_page);
      ?>
      <h2>Daily Expenses Table</h2>
      <div class='table-responsive'>
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
          <tbody>
            <?php foreach ($expense_paged_data as $expense): ?>
              <tr>
                <?php foreach ($expense as $value): ?>
                  <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td class='text-center'>
                  <div class='btn-group' role='group'>
                    <a href='edit_expense.php?id=<?= $expense['daily_expense_id'] ?>' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='?delete_expense=<?= $expense['daily_expense_id'] ?>&expense_page=<?= $expense_page ?>' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure you want to delete this record?")'>Delete</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php displayPagination($expense_page, $expense_total_pages, 'expense_page'); ?>
      <br>
    <?php else: ?>
      <div class='alert alert-danger'>No daily expenses data found</div>
    <?php endif; ?>

    <!-- Given/Taken Table -->
    <?php if (!empty($tableData['giventaken'])): ?>
      <?php
      $gt_page = isset($_GET['gt_page']) ? max(1, intval($_GET['gt_page'])) : 1;
      $records_per_page = 5;
      $gt_total_pages = ceil(count($tableData['giventaken']) / $records_per_page);
      $gt_paged_data = array_slice($tableData['giventaken'], ($gt_page - 1) * $records_per_page, $records_per_page);
      ?>
      <h2>Given/Taken Table</h2>
      <div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered w-100 shadow p-5'>
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
          <tbody>
            <?php foreach ($gt_paged_data as $gt): ?>
              <tr>
                <?php foreach ($gt as $value): ?>
                  <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td class='text-center'>
                  <div class='btn-group' role='group'>
                    <a href='edit_giventaken.php?id=<?= $gt['giventaken_id'] ?>' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='?delete_giventaken=<?= $gt['giventaken_id'] ?>&gt_page=<?= $gt_page ?>' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure you want to delete this record?")'>Delete</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php displayPagination($gt_page, $gt_total_pages, 'gt_page'); ?>
      <br>
    <?php else: ?>
      <div class='alert alert-danger'>No given/taken data found.</div><br>
    <?php endif; ?>

    <!-- Monthly Income Table -->
    <?php if (!empty($tableData['income'])): ?>
      <?php
      $income_page = isset($_GET['income_page']) ? max(1, intval($_GET['income_page'])) : 1;
      $records_per_page = 5;
      $income_total_pages = ceil(count($tableData['income']) / $records_per_page);
      $income_paged_data = array_slice($tableData['income'], ($income_page - 1) * $records_per_page, $records_per_page);
      ?>
      <h2>Monthly Income Table</h2>
      <div class='table-responsive'>
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
          <tbody>
            <?php foreach ($income_paged_data as $income): ?>
              <tr>
                <?php foreach ($income as $value): ?>
                  <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td class='text-center'>
                  <div class='btn-group' role='group'>
                    <a href='edit_income.php?id=<?= $income['income_id'] ?>' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='?delete_income=<?= $income['income_id'] ?>&income_page=<?= $income_page ?>' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure you want to delete this record?")'>Delete</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php displayPagination($income_page, $income_total_pages, 'income_page'); ?>
      <br>
    <?php else: ?>
      <div class='alert alert-danger'>No income data found.</div><br>
    <?php endif; ?>
  </div>

  <!-- Modals Section -->
  <?php include 'modals.php'; ?>

  <!-- Scripts Section -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    // Initialize AOS
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
    });

    // Function to toggle visibility of date input fields based on the status
    function toggleDateFields() {
      var status = document.getElementById('status').value;
      var dateGivenGroup = document.getElementById('dateGivenGroup');
      var dateTakenGroup = document.getElementById('dateTakenGroup');

      if (status === 'giver') {
        dateGivenGroup.style.display = 'block';
        dateTakenGroup.style.display = 'none';
      } else if (status === 'taker') {
        dateGivenGroup.style.display = 'none';
        dateTakenGroup.style.display = 'block';
      }
    }

    // Initialize on page load to show the correct date field
    document.addEventListener('DOMContentLoaded', function() {
      toggleDateFields();
    });
  </script>

  <?php require_once('footer.php'); ?>
</body>

</html>