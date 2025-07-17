<?php
session_start();
include('conn.php');

// For testing, set a user ID manually if not using login
$user_id = $_SESSION['user_id'] ?? 1; // Change this to any valid user ID

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE users SET 
            first_name = ?, middle_name = ?, last_name = ?, user_type = ?, 
            email = ?, phone = ?, dob = ?, gender = ?, bio = ?, 
            role = ?, created_at = ?, Updated_at = ?
            WHERE id = ?");
        echo "<pre>";
        print_r($stmt); // Debugging line to check the prepared statement
        echo "</pre>";

        $Updated_at = date('Y-m-d H:i:s');
        $stmt->execute([
            $_POST['first_name'],
            $_POST['middle_name'],
            $_POST['last_name'],
            $_POST['user_type'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['dob'],
            $_POST['gender'],
            $_POST['bio'],
            $_POST['role'],
            $_POST['created_at'],
            $Updated_at,
            $user_id
        ]);
        $message = "Profile updated successfully!";
    } catch (PDOException $e) {
        $error = "Error updating profile: " . $e->getMessage();
    }
}

// Fetch user data
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching user: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background: #333;
            color: white;
            padding: 20px;
        }

        .nav-menu li {
            margin: 15px 0;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background: #fff;
        }

        .profile-card,
        .dashboard-card {
            background: #f0f0f0;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
        }

        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        img.profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
        }
    </style>
</head>

<body>

    <?php if (isset($message)): ?>
        <div class="success"><?= $message ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="sidebar">
            <h2>My Profile</h2>
            <ul class="nav-menu">
                <li><a href="#">📊 Dashboard</a></li>
                <li><a href="#">👤 Profile</a></li>
                <li><a href="#">⚙️ Settings</a></li>
                <li><a href="#">🔒 Security</a></li>
                <li><a href="#">🚪 Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="profile-card">
                <h1>User Profile</h1>
                <div style="display: flex; gap: 20px;">
                    <img class="profile-picture" src="<?= $user['profile_photo'] ?: 'https://via.placeholder.com/150' ?>" alt="Profile">
                    <div>
                        <h2><?= $user['first_name'] . ' ' . $user['last_name'] ?></h2>
                        <p><strong>Email:</strong> <?= $user['email'] ?></p>
                        <p><strong>Role:</strong> <?= $user['role'] ?: 'N/A' ?></p>
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <h3>Edit Profile</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input name="first_name" id="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input name="middle_name" id="middle_name" value="<?= htmlspecialchars($user['middle_name']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input name="last_name" id="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <input name="user_type" id="user_type" value="<?= htmlspecialchars($user['user_type']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?= $user['dob'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <input type="radio" name="gender" value="male" <?= $user['gender'] === 'male' ? 'checked' : '' ?>> Male
                        <input type="radio" name="gender" value="female" <?= $user['gender'] === 'female' ? 'checked' : '' ?>> Female
                        <input type="radio" name="gender" value="other" <?= $user['gender'] === 'other' ? 'checked' : '' ?>> Other
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" rows="3"><?= htmlspecialchars($user['bio']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <input name="role" id="role" value="<?= htmlspecialchars($user['role']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="datetime-local" name="created_at" id="created_at" value="<?= str_replace(' ', 'T', $user['created_at']) ?>">
                    </div>



                    <button type="submit" class="btn">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>