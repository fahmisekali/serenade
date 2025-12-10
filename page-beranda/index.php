<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Serenade</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, rgba(26, 155, 142, 0.95) 0%, rgba(26, 155, 142, 0.85) 100%);
            padding: 18px 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .logo {
            height: 65px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 40px;
            align-items: center;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
        }

        .nav-menu li a:hover {
            opacity: 0.8;
        }

        /* Login/Logout Button */
        .auth-btn {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .auth-btn:hover {
            background: white;
            color: #1a9b8e;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .auth-btn::after {
            display: none;
        }

        /* Hamburger Menu */
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
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: url('WhatsApp Image 2025-10-08 at 11.10.40.jpeg') center/cover;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            color: white;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 0.8s ease;
        }

        .hero h2 {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, rgba(26, 155, 142, 0.95) 0%, rgba(26, 155, 142, 1) 100%);
            color: white;
            padding: 12px 0;
            text-align: center;
            font-size: 13px;
            z-index: 999;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .footer a:hover {
            opacity: 0.8;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 75px;
                left: -100%;
                flex-direction: column;
                background: rgba(26, 155, 142, 0.98);
                width: 100%;
                padding: 30px 0;
                transition: left 0.3s ease;
                gap: 25px;
            }

            .nav-menu.active {
                left: 0;
            }

            .hamburger {
                display: flex;
            }

            .hero h1 {
                font-size: 40px;
            }

            .hero h2 {
                font-size: 22px;
            }

            .nav-container {
                padding: 0 20px;
            }

            .hero-content {
                padding: 0 20px;
            }

            .logo {
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 32px;
            }

            .hero h2 {
                font-size: 20px;
            }

            .logo {
                height: 50px;
            }

            .footer {
                font-size: 11px;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <img src="WhatsApp_Image_2025-10-02_at_13.05.15-removebg-preview.png" alt="Serenade Logo" class="logo">
            <ul class="nav-menu" id="navMenu">
                <li><a href="../page-beranda/index.php">BERANDA</a></li>
                <li><a href="../page-tentang/index.php">TENTANG</a></li>
                <li><a href="../page-menu/index.php">MENU</a></li>
                <li><a href="../page-pesan/index.php">PESAN</a></li>
                <li>
                    <a href="../login.php" class="auth-btn">LOGIN</a>
                </li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang Di<br>Kedai Serenade</h1>
            <div class="hero-tagline">
                <h2>"Rasakan Sensasi Nongkrong</h2>
                <h2>Unik Di Pinggir Rel Kereta Api"</h2>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 Kedai Serenade. All rights reserved · Contact us: <a href="https://www.instagram.com/kedaiserenade" target="_blank">Instagram @kedaiserenade</a></p>
    </footer>

    <script>
        // Hamburger Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-menu li a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    </script>
</body>
</html>