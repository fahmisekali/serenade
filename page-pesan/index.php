<?php
require_once '../config.php';

$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['pesan'])) {
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $email = $conn->real_escape_string(trim($_POST['email']));
        $pesan = $conn->real_escape_string(trim($_POST['pesan']));
        
        // Insert message to chat_messages table
        $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, sender_role, message) VALUES (?, 'user', ?)");
        $stmt->bind_param("is", $user_id, $pesan);
        
        if($stmt->execute()) {
            $success = 'Pesan Anda berhasil dikirim!';
        } else {
            $error = 'Gagal mengirim pesan. Silakan coba lagi.';
        }
    } else {
        $error = 'Anda harus login terlebih dahulu untuk mengirim pesan.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Kedai Serenade</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(135deg, #2c9b9b 0%, #1e7373 100%);
            padding: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 15px 40px;
        }

        .logo {
            height: 50px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 45px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: #ffd700;
        }

        .auth-btn {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            border-radius: 25px;
            color: white !important;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .auth-btn:hover {
            background: white;
            color: #2c9b9b !important;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: white;
            border-radius: 3px;
        }

        .map-section {
            width: 100%;
            height: 500px;
            background: #e0e0e0;
        }

        .map-section iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .contact-section {
            max-width: 1200px;
            margin: -80px auto 60px;
            padding: 0 40px;
            position: relative;
            z-index: 10;
        }

        .contact-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 50px 60px;
        }

        .contact-header h2 {
            font-size: 28px;
            color: #2c9b9b;
            margin-bottom: 35px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2c9b9b;
            background: white;
            box-shadow: 0 0 0 3px rgba(44, 155, 155, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-btn {
            padding: 14px 40px;
            background: linear-gradient(135deg, #2c9b9b 0%, #1e7373 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 155, 155, 0.4);
        }

        footer {
            background: linear-gradient(135deg, #2c9b9b 0%, #1e7373 100%);
            color: white;
            padding: 40px 40px 25px;
            text-align: center;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: #2c9b9b;
                flex-direction: column;
                padding-top: 50px;
                transition: left 0.3s ease;
            }

            .nav-links.active {
                left: 0;
            }

            .contact-section {
                padding: 0 20px;
            }

            .contact-container {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="WhatsApp_Image_2025-10-02_at_13.05.15-removebg-preview.png" alt="Serenade Logo" class="logo">
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="../page-beranda/index.php">Beranda</a></li>
                <li><a href="../page-tentang/index.php">Tentang</a></li>
                <li><a href="../page-menu/index.php">Menu</a></li>
                <li><a href="../page-pesan/index.php">Pesan</a></li>
                <li>
                    <a href="../login.php" class="auth-btn">LOGIN</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="map-section">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0837825944397!2d112.72780931477457!3d-7.313282594724442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTgnNDcuOCJTIDExMsKwNDMnNDguMCJF!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid"
            allowfullscreen loading="lazy">
        </iframe>
    </section>

    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-header">
                <h2>Hubungi Kami</h2>
            </div>

            <?php if($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>

                <?php if(!isset($_SESSION['user_id'])): ?>
                    <p style="color: #dc3545; margin-bottom: 15px; font-size: 14px;">
                        ⚠️ Anda harus <a href="../login.php" style="color: #2c9b9b; font-weight: 600; text-decoration: underline;">login</a> terlebih dahulu untuk mengirim pesan.
                    </p>
                <?php endif; ?>

                <button type="submit" class="submit-btn" <?php echo !isset($_SESSION['user_id']) ? 'style="opacity: 0.6; cursor: not-allowed;" disabled' : ''; ?>>
                    <?php echo isset($_SESSION['user_id']) ? 'Kirim Pesan' : 'Login untuk Mengirim Pesan'; ?>
                </button>
            </form>
        </div>
    </section>

    <footer>
        <p>© 2025 Kedai Serenade. All rights reserved<br>Contact: <a href="https://www.instagram.com/kedaiserenade" target="_blank">Instagram @kedaiserenade</a></p>
    </footer>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>