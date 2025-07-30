<?php
// Monthly Income Modal
?>
<div class="modal fade" id="monthly_income" tabindex="-1" aria-labelledby="monthly_incomeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="monthly_incomeLabel">Add Monthly Income</h1>
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
// Daily Investment Modal
?>
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
// Given & Taken Modal
?>
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

<?php
// Daily Expenses Modal
?>
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
                            <button type="submit" name="expense" class="btn btn-primary">Submit</button>
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