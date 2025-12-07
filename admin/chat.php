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

// Handle sending message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $user_id = (int)$_POST['user_id'];
    $message = $conn->real_escape_string(trim($_POST['message']));
    
    $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, sender_role, message) VALUES (?, 'admin', ?)");
    $stmt->bind_param("is", $user_id, $message);
    $stmt->execute();
    
    header("Location: chat.php?user_id=$user_id");
    exit();
}

// Get list of users who have sent messages
$users = $conn->query("SELECT DISTINCT u.id, u.username, 
                       (SELECT COUNT(*) FROM chat_messages WHERE user_id = u.id AND sender_role = 'user' AND is_read = 0) as unread_count,
                       (SELECT created_at FROM chat_messages WHERE user_id = u.id ORDER BY created_at DESC LIMIT 1) as last_message_time
                       FROM users u 
                       INNER JOIN chat_messages cm ON u.id = cm.user_id 
                       WHERE u.role = 'user'
                       ORDER BY last_message_time DESC");

$selected_user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

// Mark messages as read when viewing
if ($selected_user_id) {
    $conn->query("UPDATE chat_messages SET is_read = 1 WHERE user_id = $selected_user_id AND sender_role = 'user'");
    
    // Get messages for selected user
    $messages = $conn->query("SELECT * FROM chat_messages WHERE user_id = $selected_user_id ORDER BY created_at ASC");
    
    // Get user info
    $user_info = $conn->query("SELECT username FROM users WHERE id = $selected_user_id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Admin</title>
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

        .chat-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            height: calc(100vh - 200px);
        }

        .user-list {
            background: white;
            border-radius: 15px;
            overflow-y: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .user-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-item:hover {
            background: #f8f9fa;
        }

        .user-item.active {
            background: #e8f5e9;
            border-left: 4px solid #1a9b8e;
        }

        .unread-badge {
            background: #dc3545;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .chat-box {
            background: white;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chat-header {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
            font-size: 18px;
            color: #333;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            max-width: 70%;
            padding: 12px 18px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.5;
        }

        .message.user {
            align-self: flex-start;
            background: #e9ecef;
            color: #333;
        }

        .message.admin {
            align-self: flex-end;
            background: #1a9b8e;
            color: white;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
        }

        .chat-input {
            padding: 20px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 10px;
        }

        .chat-input textarea {
            flex: 1;
            padding: 12px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            resize: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .chat-input textarea:focus {
            outline: none;
            border-color: #1a9b8e;
        }

        .send-btn {
            padding: 12px 30px;
            background: #1a9b8e;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .send-btn:hover {
            background: #126354;
        }

        .no-chat {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #999;
            font-size: 16px;
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

            .chat-container {
                grid-template-columns: 1fr;
                height: auto;
            }

            .user-list {
                max-height: 300px;
            }

            .chat-box {
                height: 500px;
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
            <a href="ratings.php" class="menu-item">
                <span>⭐</span>
                <span>Rating & Komentar</span>
            </a>
            <a href="chat.php" class="menu-item active">
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
            <h1>💬 Chat dengan Pelanggan</h1>
            <a href="../logout.php"><button class="logout-btn">Logout</button></a>
        </div>

        <div class="chat-container">
            <div class="user-list">
                <?php while ($user = $users->fetch_assoc()): ?>
                <div class="user-item <?php echo $selected_user_id == $user['id'] ? 'active' : ''; ?>" 
                     onclick="location.href='chat.php?user_id=<?php echo $user['id']; ?>'">
                    <span><?php echo htmlspecialchars($user['username']); ?></span>
                    <?php if ($user['unread_count'] > 0): ?>
                    <span class="unread-badge"><?php echo $user['unread_count']; ?></span>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="chat-box">
                <?php if ($selected_user_id && isset($messages)): ?>
                <div class="chat-header">
                    Chat dengan <?php echo htmlspecialchars($user_info['username']); ?>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <?php while ($msg = $messages->fetch_assoc()): ?>
                    <div class="message <?php echo $msg['sender_role']; ?>">
                        <?php echo htmlspecialchars($msg['message']); ?>
                        <div class="message-time">
                            <?php echo date('d M Y, H:i', strtotime($msg['created_at'])); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <form method="POST" class="chat-input">
                    <input type="hidden" name="user_id" value="<?php echo $selected_user_id; ?>">
                    <textarea name="message" rows="1" placeholder="Ketik pesan..." required></textarea>
                    <button type="submit" class="send-btn">Kirim</button>
                </form>
                <?php else: ?>
                <div class="no-chat">
                    Pilih pengguna untuk memulai chat
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Auto scroll to bottom
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Auto refresh every 10 seconds
        <?php if ($selected_user_id): ?>
        setInterval(function() {
            location.reload();
        }, 10000);
        <?php endif; ?>
    </script>
</body>
</html>