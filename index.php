<?php
require './config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: login.php');
    die();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('location: login.php');
    die();
}

$query = "SELECT * FROM biodata ORDER BY created_at DESC";
$result = mysqli_query($connection, $query);

if (isset($_GET['delete_id'])) {
    $delete_id = filter_var($_GET['delete_id'], FILTER_SANITIZE_NUMBER_INT);

    $delete_query = "DELETE FROM biodata WHERE id=$delete_id";
    $delete_result = mysqli_query($connection, $delete_query);

    if (mysqli_errno($connection)) {
        $_SESSION['view-biodata-error'] = "Failed to delete biodata";
    } else {
        $_SESSION['view-biodata-success'] = "Biodata deleted successfully";
        header('location: index.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Biodata - Marriage Biodata System</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        .table-container {
            overflow-x: auto;
            margin-top: 30px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        table thead tr {
            background-color: var(--primary-color);
            color: white;
            text-align: left;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e1bee7;
        }

        table tbody tr {
            transition: all 0.3s ease;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3e5f5;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid var(--primary-color);
        }

        table tbody tr:hover {
            background-color: #e1bee7;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #1976D2;
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .btn-logout {
            background-color: #ff9800;
            color: white;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #f57c00;
            transform: translateY(-2px);
        }

        .no-records {
            text-align: center;
            padding: 30px;
            color: #666;
            font-size: 1.1em;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-add {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body style="width: 100%;">
    <div style="width: 100%;">
        <?php if (isset($_SESSION['view-biodata-error'])): ?>
            <div class="alert-message error">
                <p><?= $_SESSION['view-biodata-error'];
                    unset($_SESSION['view-biodata-error']); ?></p>
            </div>
        <?php elseif (isset($_SESSION['view-biodata-success'])): ?>
            <div class="alert-message success">
                <p><?= $_SESSION['view-biodata-success'];
                    unset($_SESSION['view-biodata-success']); ?></p>
            </div>
        <?php endif ?>

        <div class="page-header">
            <div class="form-header">
                <h1>All Biodata Records</h1>
                <p>View, edit or delete marriage biodata records</p>
            </div>
            <div class="header-actions">
                <a href="add-biodata.php" class="btn-add">Add New Biodata</a>
                <a href="index.php?logout=true" class="btn-logout">Logout</a>
            </div>
        </div>

        <div class="table-container" style="width: 100%;">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Religion</th>
                            <th>Education</th>
                            <th>Occupation</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($biodata = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $biodata['id'] ?></td>
                                <td><?= htmlspecialchars($biodata['full_name']) ?></td>
                                <td><?= $biodata['age'] ?></td>
                                <td><?= ucfirst($biodata['gender']) ?></td>
                                <td><?= ucfirst($biodata['religion']) ?></td>
                                <td><?= ucfirst(str_replace('-', ' ', $biodata['education'])) ?></td>
                                <td><?= htmlspecialchars($biodata['occupation']) ?></td>
                                <td><?= date('M j, Y', strtotime($biodata['created_at'])) ?></td>
                                <td class="action-buttons">
                                    <a href="edit-biodata.php?id=<?= $biodata['id'] ?>" class="btn-edit">Edit</a>
                                    <a href="index.php?delete_id=<?= $biodata['id'] ?>"
                                        class="btn-delete"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-records">
                    <p>No biodata records found. <a href="index.php">Create your first biodata</a></p>
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>