<?php
session_start();
include('conn.php');

// Set a test user ID if session not active
$user_id = $_SESSION['user_id'] ?? 1;

// Fetch user data before POST (for image fallback)
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching user: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $Updated_at = date('Y-m-d H:i:s');

        // Fallbacks
        $gender = $_POST['gender'] ?? '';
        $profile_photo = $user['profile_photo'] ?? null;

        // Handle image upload
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['profile_photo']['tmp_name'];
            $fileName = basename($_FILES['profile_photo']['name']);
            $targetDir = 'uploads/';
            $targetPath = $targetDir . time() . '_' . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($_FILES['profile_photo']['type'], $allowedTypes)) {
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0775, true);
                }
                move_uploaded_file($fileTmp, $targetPath);
                $profile_photo = $targetPath;
                $image_message = "Profile picture updated successfully!";
            } else {
                throw new Exception("Invalid image type. Only JPG and PNG allowed.");
            }
        }

        $columnCheck = $pdo->query("SHOW COLUMNS FROM users LIKE 'updated_at'");
        $hasUpdatedAt = $columnCheck->rowCount() > 0;

        $sql = "UPDATE users SET 
            first_name = ?, middle_name = ?, last_name = ?, user_type = ?, 
            email = ?, phone = ?, dob = ?, gender = ?, bio = ?, 
            role = ?, profile_photo = ?" . ($hasUpdatedAt ? ", updated_at = ?" : "") . " 
            WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        $params = [
            $_POST['first_name'],
            $_POST['middle_name'],
            $_POST['last_name'],
            $_POST['user_type'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['dob'],
            $gender,
            $_POST['bio'],
            $_POST['role'],
            $profile_photo,
        ];

        if ($hasUpdatedAt) {
            $params[] = $Updated_at;
        }

        $params[] = $user_id;
        $stmt->execute($params);

        $message = "Profile updated successfully!";

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Error updating profile: " . $e->getMessage();
    } catch (Exception $e) {
        $error = "Upload error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container mt-4">
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <?php if (isset($image_message)): ?>
            <div class="alert alert-success"><?= $image_message ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">Profile</a>
                    <a href="#" class="list-group-item list-group-item-action">Settings</a>
                    <a href="#" class="list-group-item list-group-item-action">Security</a>
                    <a href="#" class="list-group-item list-group-item-action text-danger">Logout</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="<?= $user['profile_photo'] ?: 'https://via.placeholder.com/150' ?>" class=" rounded-5 me-3 " width="130" height="150" style="object-fit:fill;">
                            <div>
                                <h4><?= $user['first_name'] . ' ' . $user['last_name'] ?></h4>
                                <p>Email: <?= $user['email'] ?><br>Role: <?= $user['role'] ?: 'N/A' ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="profile_photo" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($user['middle_name']) ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">User Type</label>
                                    <input type="text" name="user_type" class="form-control" value="<?= htmlspecialchars($user['user_type']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" value="<?= $user['dob'] ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" <?= $user['gender'] === 'male' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" <?= $user['gender'] === 'female' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="other" <?= $user['gender'] === 'other' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Other</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-control" rows="3"><?= htmlspecialchars($user['bio']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" name="role" class="form-control" value="<?= htmlspecialchars($user['role']) ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>