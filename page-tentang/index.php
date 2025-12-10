<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Kedai Serenade</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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

        /* Header Styles */
        header {
            background: linear-gradient(135deg, #1a8b82 0%, #1a9b8e 100%);
            padding: 20px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 70px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 45px;
            align-items: center;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
            position: relative;
            padding: 10px 10px;
            transition: all 0.3s ease;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: white;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
        }

        /* Auth Button */
        .auth-btn {
            padding: 5px 20px;
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
        }

        .auth-btn::after {
            display: none;
        }

        .burger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .burger span {
            width: 30px;
            height: 3px;
            background: white;
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        /* Main Content */
        .main-content {
            background: linear-gradient(135deg, #1a8b82 0%, #1a9b8e 100%);
            padding: 60px 0;
            min-height: calc(100vh - 200px);
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 45% 55%;
            gap: 60px;
            align-items: center;
        }

        .image-section img {
            width: 100%;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        .text-section {
            color: white;
        }

        .text-section p {
            font-size: 17px;
            line-height: 1.9;
            margin-bottom: 25px;
            text-align: justify;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1a8b82 0%, #1a9b8e 100%);
            color: white;
            text-align: center;
            padding: 25px 0;
            font-size: 14px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        /* Responsive */
        @media screen and (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        @media screen and (max-width: 768px) {
            .nav-menu {
                position: fixed;
                right: -100%;
                top: 110px;
                flex-direction: column;
                background: #1a8b82;
                width: 100%;
                padding: 30px 0;
                transition: right 0.4s;
                gap: 20px;
            }

            .nav-menu.active {
                right: 0;
            }

            .burger {
                display: flex;
            }

            .logo {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
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
                <div class="burger" id="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="content-wrapper">
                <div class="image-section">
                    <img src="images.jpg" alt="Kedai Serenade">
                </div>
                <div class="text-section">
                    <p><strong>Profil Serenade berawal dari pemanfaatan lahan kosong yang kemudian dijadikan tempat nongkrong bagi teman-teman saya sendiri. Awalnya hanya menyajikan minuman kopi dan non-kopi dengan referensi racikan dari luar Surabaya maupun luar negeri, kedai ini resmi berdiri pada Desember 2024.</strong></p>
                    
                    <p><strong>Nama "Serenade" diambil dari istilah musik karena saya dan teman-teman memiliki hobi dan ketertarikan pada dunia musik, baik sebagai penikmat maupun pemain, sekaligus menjadi wadah untuk berkarya.</strong></p>
                    
                    <p><strong>Visi dan misi usaha ini tidak hanya menghadirkan nuansa musik, tetapi juga mendorong perekonomian sekitar dengan membuka lapangan pekerjaan bagi anak-anak karang taruna dan warga sekitar.</strong></p>
                    
                    <p><strong>Struktur organisasi sederhana terdiri atas pemilik, bagian keuangan, bagian produksi, dan lima karyawan, dengan sistem kepemilikan yang hanya melibatkan satu karyawan. Dalam proses pendirian, tidak ada kendala berarti; lokasi dipastikan aman, tidak mengganggu area jalur kereta, serta menjaga ketenangan tetangga dan warga sekitar.</strong></p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2025 Kedai Serenade. All rights reserved · <a href="https://www.instagram.com/kedaiserenade" target="_blank">Instagram @kedaiserenade</a></p>
    </footer>

    <script>
        const burger = document.getElementById('burger');
        const navMenu = document.getElementById('navMenu');

        burger.addEventListener('click', () => {
            burger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>