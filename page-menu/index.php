<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Kedai Serenade</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #126354;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #14a085 0%, #0d7a66 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 65px;
        }

        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #b3e5db;
        }

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
        }

        .auth-btn:hover {
            background: white;
            color: #14a085;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .mobile-nav {
            display: none;
            background-color: #0d7a66;
            padding: 1rem 1.5rem;
        }

        .mobile-nav.active {
            display: block;
        }

        .mobile-nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 0.75rem 0;
            font-weight: 500;
        }

        .dropdown-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            background-color: #0d7a66;
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.125rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            left: 0;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            min-width: 200px;
            z-index: 100;
            display: none;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #e6f7f4;
        }

        .dropdown-item.selected {
            background-color: #b3e5db;
            color: #0d7a66;
            font-weight: 600;
        }

        .menu-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
        }

        .category-title {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .menu-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
        }

        .menu-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .menu-content {
            padding: 1.5rem;
        }

        .menu-name {
            font-size: 1.125rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.75rem;
        }

        .menu-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #111827;
        }

        @media (max-width: 768px) {
            nav {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="WhatsApp_Image_2025-10-02_at_13.05.15-removebg-preview.png" alt="Serenade" class="logo">
            <nav id="desktopNav">
                <a href="../page-beranda/index.php">BERANDA</a>
                <a href="../page-tentang/index.php">TENTANG</a>
                <a href="../page-menu/index.php">MENU</a>
                <a href="../page-pesan/index.php">PESAN</a>
                <a href="../login.php" class="auth-btn">LOGIN</a>
            </nav>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
        </div>
        <div class="mobile-nav" id="mobileNav">
            <a href="../page-beranda/index.php">BERANDA</a>
            <a href="../page-tentang/index.php">TENTANG</a>
            <a href="../page-menu/index.php">MENU</a>
            <a href="../page-pesan/index.php">KONTAK</a>
            <a href="../login.php" class="auth-btn">LOGIN</a>
        </div>
    </header>

    <div class="dropdown-section">
        <div class="dropdown-container">
            <button class="dropdown-btn" onclick="toggleDropdown()">
                Menu Pilihan
                <span id="dropdownIcon">▼</span>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="dropdown-item selected" onclick="selectCategory('Makanan')">Makanan</div>
                <div class="dropdown-item" onclick="selectCategory('Minuman')">Minuman</div>
                <div class="dropdown-item" onclick="selectCategory('Dessert')">Dessert</div>
                <div class="dropdown-item" onclick="selectCategory('Snack')">Snack</div>
            </div>
        </div>
    </div>

    <div class="menu-section">
        <h2 class="category-title" id="categoryTitle">Makanan</h2>
        <div class="menu-grid" id="menuGrid"></div>
    </div>

    <script>
        const menuData = {
            Makanan: [
                {id: "mie-gayabaru-telor", name: "Mie Gayabaru Telor", price: "15K", image: "https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&h=400&fit=crop"},
                {id: "bakso-iegawa", name: "Bakso Iegawa", price: "12K", image: "https://images.unsplash.com/photo-1504278770949-a35e2df5a4e6?w=400&h=400&fit=crop"},
                {id: "kentang-goreng", name: "Kentang Goreng", price: "10K", image: "https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&h=400&fit=crop"},
            ],
            Minuman: [
                {id: "es-teh", name: "Es Teh Manis", price: "5K", image: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=400&fit=crop"},
                {id: "kopi", name: "Kopi Hitam", price: "8K", image: "https://images.unsplash.com/photo-1511920170033-f8396924c348?w=400&h=400&fit=crop"},
            ],
            Dessert: [
                {id: "es-krim", name: "Es Krim", price: "8K", image: "https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&h=400&fit=crop"},
            ],
            Snack: [
                {id: "keripik", name: "Keripik", price: "3K", image: "https://images.unsplash.com/photo-1600490036275-dc8f1667e6d0?w=400&h=400&fit=crop"},
            ]
        };

        let currentCategory = "Makanan";

        function toggleMobileMenu() {
            document.getElementById("mobileNav").classList.toggle("active");
        }

        function toggleDropdown() {
            document.getElementById("dropdownMenu").classList.toggle("active");
        }

        function selectCategory(category) {
            currentCategory = category;
            document.getElementById("categoryTitle").textContent = category;
            
            document.querySelectorAll(".dropdown-item").forEach(item => {
                item.classList.toggle("selected", item.textContent === category);
            });
            
            toggleDropdown();
            renderMenu();
        }

        function renderMenu() {
            const menuGrid = document.getElementById("menuGrid");
            menuGrid.innerHTML = "";
            
            menuData[currentCategory].forEach(item => {
                const card = document.createElement("div");
                card.className = "menu-card";
                card.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="menu-image">
                    <div class="menu-content">
                        <div class="menu-name">${item.name}</div>
                        <div class="menu-price">${item.price}</div>
                    </div>
                `;
                menuGrid.appendChild(card);
            });
        }

        renderMenu();
    </script>
</body>
</html>