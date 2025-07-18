<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dues Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2.5rem;
        }

        h1,
        h2 {
            color: #0d6efd;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 600;
        }

        h2 {
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 576px) {
            .table-container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
<?php
include('header.php');
?>
    <div class="container my-5">
        <h1 class="text-center mb-5">Dues Management Dashboard</h1>

        <!-- Monthly Dues -->
        <div class="table-container">
            <h2>Monthly Dues</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Name of Due</th>
                            <th>Amount (₹)</th>
                            <th>Date of Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Internet Bill</td>
                            <td>500</td>
                            <td>2025-07-05</td>
                        </tr>
                        <tr>
                            <td>Electricity Bill</td>
                            <td>1200</td>
                            <td>2025-07-10</td>
                        </tr>
                        <tr>
                            <td>Water Bill</td>
                            <td>300</td>
                            <td>2025-07-15</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Yearly Dues -->
        <div class="table-container">
            <h2>Yearly Dues</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Name of Due</th>
                            <th>Amount (₹)</th>
                            <th>Date of Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Insurance Premium</td>
                            <td>10000</td>
                            <td>2025-12-01</td>
                        </tr>
                        <tr>
                            <td>Domain Renewal</td>
                            <td>1500</td>
                            <td>2025-11-15</td>
                        </tr>
                        <tr>
                            <td>Property Tax</td>
                            <td>5000</td>
                            <td>2025-04-01</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>