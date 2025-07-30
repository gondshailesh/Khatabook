<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/fav_icon.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="body">
        <section>
            <div class="text-center mt-4 mb-1">
                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#monthly_income">Add Monthly Income</button>
                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyInvestmentModal">Add Daily Investment</button>
                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#givenTakenModal">Add Given and Taken</button>
                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#dailyExpensesModal">Daily Expenses </button>
            </div>
        </section>

        <div class="container py-3">
            <div class="streak-container animate__animated animate__fadeIn bg-warning bg-opacity-50">
                <h3 class="streak-label">Current Daily Login Streak</h3>
                <div class="streak-count">7 🔥</div>
                <div class="streak-progress">
                    <div class="streak-progress-bar" style="width: 70%"></div>
                </div>
                <p>Keep it up! 3 more days to unlock your weekly reward</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-summary card-income text-center p-4">
                        <div class="card-body">
                            <h3 class="card-title">Monthly Income</h3>
                            <p class="card-subtext">Salary/Business Income</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-summary card-investment text-center p-4">
                        <div class="card-body">
                            <h3 class="card-title">Daily Investment</h3>
                            <p class="card-subtext">Stock/Mutual Funds</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-summary card-given text-center p-4">
                        <div class="card-body">
                            <h3 class="card-title">Given & Taken</h3>
                            <p class="card-subtext">Loan Transactions</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-summary card-expenses text-center p-4">
                        <div class="card-body">
                            <h3 class="card-title">Daily Expenses</h3>
                            <p class="card-subtext">All Daily Expenditures</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Monthly Income -->
        <div class="modal fade" id="monthly_income" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Monthly Income</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Income Source:</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Income Type:</label>
                                <select class="form-control" required>
                                    <option value="">Select Income Type</option>
                                    <option value="business">Business</option>
                                    <option value="salary">Salary</option>
                                    <option value="freelance">Freelance</option>
                                    <option value="investment">Investment</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Total Amount:</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Date:</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Daily Investment -->
        <div class="modal fade" id="dailyInvestmentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Daily Investment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Investment Source:</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Investment Amount:</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Interest Rate (%):</label>
                                <input type="number" step="0.01" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Investment Type:</label>
                                <select class="form-control" required>
                                    <option value="stock">Stock</option>
                                    <option value="sip">SIP</option>
                                    <option value="mutualFund">Mutual Fund</option>
                                    <option value="bonds">Bonds</option>
                                    <option value="realEstate">Real Estate</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date:</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Given & Taken -->
        <div class="modal fade" id="givenTakenModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Given & Taken</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Amount Given or Taken:</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Status (Giver/Taker):</label>
                                <select class="form-control" onchange="toggleDateFields()" required>
                                    <option value="giver">Giver</option>
                                    <option value="taker">Taker</option>
                                </select>
                            </div>

                            <div class="form-group" id="dateGivenGroup">
                                <label>Date of Giving:</label>
                                <input type="date" class="form-control">
                            </div>

                            <div class="form-group" id="dateTakenGroup">
                                <label>Date of Taking:</label>
                                <input type="date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Date of Returning:</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Comment about Transaction:</label>
                                <textarea class="form-control" rows="5" placeholder="Write a message..." required></textarea>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Daily Expenses -->
        <div class="modal fade" id="dailyExpensesModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Daily Expense</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Expense Name:</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Date of Expense:</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Amount:</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleDateFields() {
                var status = document.getElementById('status').value;
                document.getElementById('dateGivenGroup').style.display = (status === 'giver') ? 'block' : 'none';
                document.getElementById('dateTakenGroup').style.display = (status === 'taker') ? 'block' : 'none';
            }
            document.addEventListener('DOMContentLoaded', function() {
                toggleDateFields();
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 10000,
                easing: 'ease-in-out',
                once: true,
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>