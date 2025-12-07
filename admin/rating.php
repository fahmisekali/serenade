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

// Hapus rating jika ada request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM ratings WHERE id = $id");
    header("Location: ratings.php");
    exit();
}

// Ambil semua rating
$ratings = $conn->query("SELECT * FROM ratings ORDER BY created_at DESC");

// Hitung rata-rata rating
$avg_result = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM ratings");
$avg_data = $avg_result->fetch_assoc();
$avg_rating = round($avg_data['avg_rating'], 1);
$total_ratings = $avg_data['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Komentar - Admin</title>
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

        .stats-card {
            background: linear-gradient(135deg, #1a9b8e 0%, #126354 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .stats-card h2 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .stats-card p {
            font-size: 16px;
            opacity: 0.9;
        }

        .rating-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .rating-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .rating-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .rating-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .rating-header h3 {
            font-size: 18px;
            color: #333;
        }

        .stars {
            color: #ffd700;
            font-size: 20px;
        }

        .rating-comment {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .rating-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #999;
        }

        .delete-btn {
            padding: 8px 16px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .delete-btn:hover {
            background: #c82333;
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

            .rating-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
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
            <a href="ratings.php" class="menu-item active">
                <span>⭐</span>
                <span>Rating & Komentar</span>
            </a>
            <a href="chat.php" class="menu-item">
                <span>💬</span>
                <span>Chat</span>
            </a>
            <a href="profits.php" class="menu-item">
                <span>💰</span>
                <span>Kelola Profit</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>⭐ Rating & Komentar</h1>
            <a href="../logout.php"><button class="logout-btn">Logout</button></a>
        </div>

        <div class="stats-card">
            <h2><?php echo $avg_rating; ?> / 5.0</h2>
            <p>Rata-rata rating dari <?php echo $total_ratings; ?> ulasan</p>
        </div>

        <div class="rating-grid">
            <?php while ($rating = $ratings->fetch_assoc()): ?>
            <div class="rating-card">
                <div class="rating-header">
                    <h3><?php echo htmlspecialchars($rating['username']); ?></h3>
                    <div class="stars">
                        <?php 
                        for ($i = 0; $i < 5; $i++) {
                            echo $i < $rating['rating'] ? '⭐' : '☆';
                        }
                        ?>
                    </div>
                </div>
                <div class="rating-comment">
                    <?php echo htmlspecialchars($rating['comment']); ?>
                </div>
                <div class="rating-footer">
                    <span><?php echo date('d M Y, H:i', strtotime($rating['created_at'])); ?></span>
                    <button class="delete-btn" onclick="if(confirm('Hapus rating ini?')) location.href='ratings.php?delete=<?php echo $rating['id']; ?>'">Hapus</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>