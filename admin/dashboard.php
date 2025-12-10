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

// Ambil data untuk dashboard
$current_month = date('n');
$current_year = date('Y');
$month_names = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$current_month_name = $month_names[$current_month - 1];

// Total Sales bulan ini
$stmt = $conn->prepare("SELECT SUM(total_amount) as total FROM orders WHERE MONTH(order_date) = ? AND YEAR(order_date) = ? AND status = 'completed'");
$stmt->bind_param("ii", $current_month, $current_year);
$stmt->execute();
$result = $stmt->get_result();
$total_sales = $result->fetch_assoc()['total'] ?? 0;

// Total Order bulan ini
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM orders WHERE MONTH(order_date) = ? AND YEAR(order_date) = ?");
$stmt->bind_param("ii", $current_month, $current_year);
$stmt->execute();
$result = $stmt->get_result();
$total_orders = $result->fetch_assoc()['count'] ?? 0;

// New Customers bulan ini
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE MONTH(created_at) = ? AND YEAR(created_at) = ? AND role = 'user'");
$stmt->bind_param("ii", $current_month, $current_year);
$stmt->execute();
$result = $stmt->get_result();
$new_customers = $result->fetch_assoc()['count'] ?? 0;

// Data profit bulanan untuk tabel
$profit_data = $conn->query("SELECT * FROM monthly_profits WHERE year = $current_year ORDER BY FIELD(month, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')");

// Total profit setahun
$total_profit_year = 0;
$profit_data->data_seek(0);
while ($row = $profit_data->fetch_assoc()) {
    $total_profit_year += $row['total_profit'];
}

// Unread messages count
$unread_stmt = $conn->query("SELECT COUNT(*) as count FROM chat_messages WHERE sender_role = 'user' AND is_read = 0");
$unread_messages = $unread_stmt->fetch_assoc()['count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kedai Serenade</title>
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
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
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

        .menu-icon {
            width: 20px;
            height: 20px;
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
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
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-details h3 {
            font-size: 14px;
            color: #666;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .stat-details p {
            font-size: 28px;
            font-weight: 700;
            color: #333;
        }

        .content-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .content-card h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
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

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.unread {
            background: #dc3545;
            color: white;
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

            .stats-grid {
                grid-template-columns: 1fr;
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
            <a href="dashboard.php" class="menu-item active">
                <span class="menu-icon">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="chat.php" class="menu-item">
                <span class="menu-icon">💬</span>
                <span>Chat
                    <?php if ($unread_messages > 0): ?>
                        <span class="badge unread"><?php echo $unread_messages; ?></span>
                    <?php endif; ?>
                </span>
            </a>
            <a href="profits.php" class="menu-item">
                <span class="menu-icon">💰</span>
                <span>Kelola Profit</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-info">
                <span>Halo, <strong><?php echo $_SESSION['username']; ?></strong></span>
                <a href="../logout.php"><button class="logout-btn">Logout</button></a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">💵</div>
                <div class="stat-details">
                    <h3>Total Sales</h3>
                    <p>Rp. <?php echo number_format($total_sales, 0, ',', '.'); ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">🛍️</div>
                <div class="stat-details">
                    <h3>Total Order</h3>
                    <p><?php echo $total_orders; ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">👥</div>
                <div class="stat-details">
                    <h3>New Customers</h3>
                    <p><?php echo $new_customers; ?></p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2>📊 Total Keuntungan per Bulan (<?php echo $current_year; ?>)</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Total Keuntungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $profit_data->data_seek(0);
                        while ($row = $profit_data->fetch_assoc()): 
                        ?>
                        <tr>
                            <td><strong><?php echo $row['month']; ?></strong></td>
                            <td><strong>Rp. <?php echo number_format($row['total_profit'], 0, ',', '.'); ?></strong></td>
                        </tr>
                        <?php endwhile; ?>
                        <tr style="background: #e8f5e9; font-weight: bold;">
                            <td><strong>TOTAL</strong></td>
                            <td><strong style="color: #1a9b8e;">Rp. <?php echo number_format($total_profit_year, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-card">
            <h2>📈 Ringkasan</h2>
            <p style="font-size: 15px; line-height: 1.8; color: #495057;">
                Pada bulan <strong><?php echo $current_month_name; ?> <?php echo $current_year; ?></strong>, 
                terdapat <strong><?php echo $new_customers; ?> pelanggan baru</strong> yang mendaftar. 
                Total pesanan yang masuk sebanyak <strong><?php echo $total_orders; ?> pesanan</strong> 
                dengan total penjualan mencapai <strong>Rp. <?php echo number_format($total_sales, 0, ',', '.'); ?></strong>.
                <br><br>
                Total keuntungan kumulatif selama tahun <?php echo $current_year; ?> adalah 
                <strong style="color: #1a9b8e;">Rp. <?php echo number_format($total_profit_year, 0, ',', '.'); ?></strong>.
            </p>
        </div>
    </div>
</body>
</html>