<?php
// Load config dari parent directory
$config_path = dirname(__DIR__) . '/config.php';
if (file_exists($config_path)) {
    require_once $config_path;
} else {
    die("Error: config.php tidak ditemukan!");
}

// Cek apakah user sudah login dan adalah admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$success = '';
$error = '';

// Handle update profit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profit'])) {
    $id = (int)$_POST['id'];
    $profit = (float)$_POST['profit'];
    
    $stmt = $conn->prepare("UPDATE monthly_profits SET total_profit = ? WHERE id = ?");
    $stmt->bind_param("di", $profit, $id);
    
    if ($stmt->execute()) {
        $success = 'Data profit berhasil diupdate!';
    } else {
        $error = 'Gagal mengupdate data!';
    }
}

// Get profit data
$year = date('Y');
$profits = $conn->query("SELECT * FROM monthly_profits WHERE year = $year ORDER BY FIELD(month, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profit - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1a9b8e 0%, #126354 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
            width: calc(100% - 260px);
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1a9b8e;
            font-weight: 700;
        }

        .logout-btn {
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .content-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
            border-bottom: 2px solid #dee2e6;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
            font-size: 14px;
        }

        table tr:hover {
            background: #f8f9fa;
        }

        .edit-input {
            width: 200px;
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .edit-input:focus {
            outline: none;
            border-color: #1a9b8e;
        }

        .update-btn {
            padding: 8px 20px;
            background: #1a9b8e;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .update-btn:hover {
            background: #126354;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 10px;
            }

            .edit-input {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>SERENADE</h2>
            <p style="font-size: 12px; opacity: 0.8; margin-top: 5px;">Admin Panel</p>
        </div>
        <div class="sidebar-menu">
            <a href="dashboard.php" class="menu-item">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="ratings.php" class="menu-item">
                <span>⭐</span>
                <span>Rating & Komentar</span>
            </a>
            <a href="chat.php" class="menu-item">
                <span>💬</span>
                <span>Chat</span>
            </a>
            <a href="profits.php" class="menu-item active">
                <span>💰</span>
                <span>Kelola Profit</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>💰 Kelola Profit Bulanan</h1>
            <a href="../logout.php"><button class="logout-btn">Logout</button></a>
        </div>

        <?php if ($success): ?>
        <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
        <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="content-card">
            <h2 style="margin-bottom: 20px; color: #333; font-size: 20px;">Data Profit Tahun <?php echo $year; ?></h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Total Keuntungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        while ($row = $profits->fetch_assoc()): 
                            $total += $row['total_profit'];
                        ?>
                        <tr>
                            <td><strong><?php echo $row['month']; ?></strong></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="number" name="profit" value="<?php echo $row['total_profit']; ?>" class="edit-input" step="0.01" required>
                                </td>
                            <td>
                                    <button type="submit" name="update_profit" class="update-btn">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <tr style="background: #e8f5e9; font-weight: bold;">
                            <td><strong>TOTAL</strong></td>
                            <td colspan="2"><strong style="color: #1a9b8e;">Rp. <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>