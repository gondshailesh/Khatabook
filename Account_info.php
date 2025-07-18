<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include('conn.php');

// Handle password, username, amount update
if (isset($_POST['account_update'])) {
    try {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $amount = $_POST['total_amount'];

        $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ?, total_amount = ? WHERE id = ?");
        $stmt->execute([$username, $password, $amount, $_SESSION['user_id']]);
        $account_message = "Account details updated successfully!";
    } catch (PDOException $e) {
        $account_error = "Error updating account: " . $e->getMessage();
    }
}

// Fetch totals
try {
    $sql_income = "SELECT SUM(totalAmount) AS monthly_income FROM income WHERE MONTH(incomeDate) = MONTH(CURDATE())";
    $stmt_income = $pdo->query($sql_income);
    $monthly_income = $stmt_income->fetch(PDO::FETCH_ASSOC);

    $sql_exp_month = "SELECT SUM(expenseAmount) AS monthly_expenses FROM daily_expenses WHERE MONTH(expenseDate) = MONTH(CURDATE())";
    $stmt_exp_month = $pdo->query($sql_exp_month);
    $monthly_expenses = $stmt_exp_month->fetch(PDO::FETCH_ASSOC);

    $sql_exp_year = "SELECT SUM(expenseAmount) AS yearly_expenses FROM daily_expenses WHERE YEAR(expenseDate) = YEAR(CURDATE())";
    $stmt_exp_year = $pdo->query($sql_exp_year);
    $yearly_expenses = $stmt_exp_year->fetch(PDO::FETCH_ASSOC);

    $sql_inv_year = "SELECT SUM(investmentAmount) AS yearly_investment FROM daily WHERE YEAR(investmentDate) = YEAR(CURDATE())";
    $stmt_inv_year = $pdo->query($sql_inv_year);
    $yearly_investment = $stmt_inv_year->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container py-4">
        <h2 class="mb-4">Account Information</h2>

        <?php if (isset($account_message)): ?>
            <div class="alert alert-success"><?= $account_message ?></div>
        <?php endif; ?>
        <?php if (isset($account_error)): ?>
            <div class="alert alert-danger"><?= $account_error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="account_update" value="1">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Amount</label>
                <input type="number" name="total_amount" class="form-control" required>
            </div>
            <button class="btn btn-primary" type="submit">Update Account</button>
        </form>

        <hr>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Income</h5>
                        <p class="card-text">₹ <?= $monthly_income['monthly_income'] ?? '0' ?></p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Expenses</h5>
                        <p class="card-text">₹ <?= $monthly_expenses['monthly_expenses'] ?? '0' ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Yearly Expenses</h5>
                        <p class="card-text">₹ <?= $yearly_expenses['yearly_expenses'] ?? '0' ?></p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Yearly Investment</h5>
                        <p class="card-text">₹ <?= $yearly_investment['yearly_investment'] ?? '0' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>