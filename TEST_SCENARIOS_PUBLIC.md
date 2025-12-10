# Skenario Uji Halaman Publik - pjbl (Kedai Serenade)

## B1. Beranda
**File**: `pjbl/page-beranda/index.php`

### Test Case 1: Menampilkan Hero Section
**Steps**:
1. Buka `pjbl/page-beranda/index.php`

**Expected Results**:
- ✅ Hero section ditampilkan dengan:
  - Background image: `WhatsApp Image 2025-10-08 at 11.10.40.jpeg`
  - Overlay gelap (rgba(0, 0, 0, 0.3))
  - Judul: "Selamat Datang Di Kedai Serenade"
  - Tagline: "Rasakan Sensasi Nongkrong Unik Di Pinggir Rel Kereta Api"
- ✅ Text memiliki text-shadow untuk readability
- ✅ Animation fadeInUp pada text

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Navigation Menu
**Steps**:
1. Buka `pjbl/page-beranda/index.php`
2. Perhatikan navigation menu

**Expected Results**:
- ✅ Logo ditampilkan: `WhatsApp_Image_2025-10-02_at_13.05.15-removebg-preview.png`
- ✅ Menu items:
  - BERANDA (link ke `../page-beranda/index.php`)
  - TENTANG (link ke `../page-tentang/index.php`)
  - MENU (link ke `../page-menu/index.php`)
  - PESAN (link ke `../page-pesan/index.php`)
  - LOGIN (link ke `../login.php`)
- ✅ Hover effect pada menu items (underline animation)
- ✅ Login button dengan style khusus (auth-btn)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Mobile Menu (Hamburger)
**Steps**:
1. Buka `pjbl/page-beranda/index.php` di mobile viewport (< 768px)
2. Klik hamburger menu

**Expected Results**:
- ✅ Hamburger icon muncul (3 lines)
- ✅ Klik hamburger membuka mobile menu
- ✅ Menu slide dari kiri
- ✅ Menu items ditampilkan vertikal
- ✅ Klik link menutup menu
- ✅ Animation smooth

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Footer
**Steps**:
1. Buka `pjbl/page-beranda/index.php`
2. Scroll ke bawah

**Expected Results**:
- ✅ Footer fixed di bottom
- ✅ Background: gradient teal (#1a9b8e)
- ✅ Text: "© 2025 Kedai Serenade. All rights reserved"
- ✅ Link Instagram: `https://www.instagram.com/kedaiserenade`
- ✅ Link Instagram open di new tab (target="_blank")

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Responsive Design
**Steps**:
1. Buka `pjbl/page-beranda/index.php`
2. Resize browser window:
   - Desktop (> 768px)
   - Tablet (768px)
   - Mobile (< 480px)

**Expected Results**:
- ✅ Layout adaptif di semua ukuran
- ✅ Font size menyesuaikan (h1: 56px → 40px → 32px)
- ✅ Logo size menyesuaikan (65px → 50px)
- ✅ Navigation menu berubah ke hamburger di mobile
- ✅ Hero section tetap readable

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## B2. Menu
**File**: `pjbl/page-menu/index.php`

### Test Case 1: Menampilkan Dropdown Kategori
**Steps**:
1. Buka `pjbl/page-menu/index.php`

**Expected Results**:
- ✅ Dropdown button "Menu Pilihan" ditampilkan
- ✅ Icon dropdown (▼) terlihat
- ✅ Background: #0d7a66
- ✅ Styling konsisten dengan theme

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Dropdown Menu Items
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik dropdown "Menu Pilihan"

**Expected Results**:
- ✅ Dropdown menu muncul dengan items:
  - Makanan (selected/default)
  - Minuman
  - Dessert
  - Snack
- ✅ "Makanan" memiliki class `selected` (background: #b3e5db)
- ✅ Hover effect pada items
- ✅ Dropdown menutup setelah pilih kategori

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Filter Menu berdasarkan Kategori - Makanan
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik dropdown dan pilih "Makanan"

**Expected Results**:
- ✅ Title berubah menjadi "Makanan"
- ✅ Menu grid menampilkan hanya item Makanan:
  - Mie Gayabaru Telor (15K)
  - Bakso Iegawa (12K)
  - Kentang Goreng (10K)
- ✅ Setiap item menampilkan:
  - Gambar (dari Unsplash)
  - Nama menu
  - Harga
- ✅ Layout grid responsif

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Filter Menu berdasarkan Kategori - Minuman
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik dropdown dan pilih "Minuman"

**Expected Results**:
- ✅ Title berubah menjadi "Minuman"
- ✅ Menu grid menampilkan hanya item Minuman:
  - Es Teh Manis (5K)
  - Kopi Hitam (8K)
- ✅ Layout tetap konsisten

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Filter Menu berdasarkan Kategori - Dessert
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik dropdown dan pilih "Dessert"

**Expected Results**:
- ✅ Title berubah menjadi "Dessert"
- ✅ Menu grid menampilkan hanya item Dessert:
  - Es Krim (8K)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: Filter Menu berdasarkan Kategori - Snack
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik dropdown dan pilih "Snack"

**Expected Results**:
- ✅ Title berubah menjadi "Snack"
- ✅ Menu grid menampilkan hanya item Snack:
  - Keripik (3K)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 7: Menu Card Hover Effect
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Hover pada menu card

**Expected Results**:
- ✅ Card naik sedikit (transform: translateY(-5px))
- ✅ Box shadow lebih besar
- ✅ Transition smooth (0.3s)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: Responsive Grid Layout
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Resize browser window

**Expected Results**:
- ✅ Desktop: Grid dengan multiple columns (auto-fill, minmax(300px, 1fr))
- ✅ Mobile (< 768px): Grid menjadi 1 column
- ✅ Cards tetap readable di semua ukuran

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: Navigation Menu
**Steps**:
1. Buka `pjbl/page-menu/index.php`
2. Klik menu items di navigation

**Expected Results**:
- ✅ Semua link berfungsi:
  - BERANDA → `../page-beranda/index.php`
  - TENTANG → `../page-tentang/index.php`
  - MENU → `../page-menu/index.php`
  - PESAN → `../page-pesan/index.php`
  - LOGIN → `../login.php`
- ✅ Active state pada menu "MENU"

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 10: Data Menu (Hardcoded)
**Code Review**: `pjbl/page-menu/index.php` line 271-287

**Analysis**:
- ⚠️ **ISSUE**: Menu data hardcoded di JavaScript, bukan dari database
- ⚠️ Tidak ada integrasi dengan database
- ⚠️ Sulit untuk update menu tanpa edit code

**Recommendation**:
- Buat tabel `menu_items` di database
- Load data dari database via PHP
- Admin bisa manage menu dari dashboard

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Architecture Issue**: Menu hardcoded, perlu database integration

---

## B3. Kontak/Pesan
**File**: `pjbl/page-pesan/index.php`

### Test Case 1: Menampilkan Form Kontak
**Steps**:
1. Buka `pjbl/page-pesan/index.php`

**Expected Results**:
- ✅ Google Maps embed ditampilkan (iframe)
- ✅ Form kontak ditampilkan dengan:
  - Field Email (type="email")
  - Field Pesan (textarea)
  - Tombol "Kirim Pesan"
- ✅ Layout terorganisir (map di atas, form di bawah)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Kirim Pesan - User Login
**Prerequisites**: User sudah login (session `$_SESSION['user_id']` aktif)

**Steps**:
1. Buka `pjbl/page-pesan/index.php` dengan user login
2. Isi form:
   - Email: `user@example.com`
   - Pesan: `Ini adalah pesan test`
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Data tersimpan ke tabel `chat_messages`:
  - `user_id`: dari session
  - `sender_role`: `'user'`
  - `message`: pesan yang dikirim
- ✅ Success message: "Pesan Anda berhasil dikirim!"
- ✅ Form bisa dikirim lagi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Kirim Pesan - User Tidak Login
**Steps**:
1. Buka `pjbl/page-pesan/index.php` tanpa login
2. Isi form
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Error message: "Anda harus login terlebih dahulu untuk mengirim pesan."
- ✅ Data tidak tersimpan
- ✅ Tombol disabled atau dengan text "Login untuk Mengirim Pesan"
- ✅ Link ke login page ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Validasi Form Kosong
**Prerequisites**: User sudah login

**Steps**:
1. Buka `pjbl/page-pesan/index.php` dengan user login
2. Biarkan form kosong
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Browser validation mencegah submit (karena `required` attribute)
- ✅ Atau error message dari server-side

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: SQL Injection pada Pesan
**Prerequisites**: User sudah login

**Steps**:
1. Buka `pjbl/page-pesan/index.php` dengan user login
2. Isi form:
   - Email: `user@example.com`
   - Pesan: `'; DROP TABLE chat_messages;--`
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Prepared statement mencegah SQL injection
- ✅ Pesan tersimpan sebagai text biasa (tidak dieksekusi)
- ✅ Database tidak terpengaruh

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: XSS pada Pesan
**Prerequisites**: User sudah login

**Steps**:
1. Buka `pjbl/page-pesan/index.php` dengan user login
2. Isi form:
   - Email: `user@example.com`
   - Pesan: `<script>alert('XSS')</script>`
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Pesan tersimpan
- ⚠️ **ISSUE**: Perlu cek apakah output di-escape saat ditampilkan di admin chat
- ⚠️ Script tidak boleh dieksekusi saat admin melihat pesan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Concern**: Perlu output escaping di admin/chat.php

---

### Test Case 7: Email Format Validation
**Prerequisites**: User sudah login

**Steps**:
1. Buka `pjbl/page-pesan/index.php` dengan user login
2. Isi form dengan email tidak valid:
   - Email: `notanemail`
   - Pesan: `Test message`
3. Klik tombol "Kirim Pesan"

**Expected Results**:
- ✅ Browser validation (HTML5 `type="email"`) mencegah submit
- ✅ Atau error message dari server-side validation

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: Google Maps Embed
**Steps**:
1. Buka `pjbl/page-pesan/index.php`
2. Perhatikan Google Maps

**Expected Results**:
- ✅ Google Maps iframe load dengan benar
- ✅ Map menampilkan lokasi yang benar
- ✅ Map interactive (bisa zoom, pan)
- ✅ `allowfullscreen` attribute set
- ✅ `loading="lazy"` untuk performance

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: Navigation Menu
**Steps**:
1. Buka `pjbl/page-pesan/index.php`
2. Klik menu items di navigation

**Expected Results**:
- ✅ Semua link berfungsi
- ✅ Mobile hamburger menu berfungsi
- ✅ Navigation konsisten dengan halaman lain

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 10: Responsive Design
**Steps**:
1. Buka `pjbl/page-pesan/index.php`
2. Resize browser window

**Expected Results**:
- ✅ Layout adaptif di semua ukuran
- ✅ Form tetap readable di mobile
- ✅ Google Maps tetap load di mobile
- ✅ Navigation menu berubah ke hamburger di mobile

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## Issues Identified

### 1. Menu Data Hardcoded
**Location**: `pjbl/page-menu/index.php` line 271-287
**Issue**: Menu items hardcoded di JavaScript, tidak dari database

**Impact**: 
- Sulit untuk update menu
- Tidak ada admin interface untuk manage menu
- Tidak scalable

**Recommendation**:
- Buat tabel `menu_items` dengan kolom: id, name, price, category, image_url
- Load data via PHP dari database
- Buat admin interface untuk CRUD menu items

### 2. Output Escaping untuk Chat Messages
**Location**: `pjbl/admin/chat.php` (perlu dicek)
**Issue**: Pesan dari user perlu di-escape saat ditampilkan

**Recommendation**:
```php
// Di admin/chat.php saat menampilkan pesan
echo htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8');
```

### 3. Email Field di Form Pesan
**Location**: `pjbl/page-pesan/index.php` line 313
**Issue**: Email field di form pesan, tapi `user_id` sudah dari session

**Analysis**: 
- Email field mungkin redundant karena user sudah login
- Atau email digunakan untuk notifikasi?
- Perlu klarifikasi requirement

---

## Test Summary

| Test Case | Status | Notes |
|-----------|--------|-------|
| B1.1 - Hero Section | [ ] | |
| B1.2 - Navigation Menu | [ ] | |
| B1.3 - Mobile Menu | [ ] | |
| B1.4 - Footer | [ ] | |
| B1.5 - Responsive Design | [ ] | |
| B2.1 - Dropdown Kategori | [ ] | |
| B2.2 - Dropdown Items | [ ] | |
| B2.3 - Filter Makanan | [ ] | |
| B2.4 - Filter Minuman | [ ] | |
| B2.5 - Filter Dessert | [ ] | |
| B2.6 - Filter Snack | [ ] | |
| B2.7 - Hover Effect | [ ] | |
| B2.8 - Responsive Grid | [ ] | |
| B2.9 - Navigation | [ ] | |
| B2.10 - Menu Data Review | [ ] | **Architecture Issue** |
| B3.1 - Form Kontak | [ ] | |
| B3.2 - Kirim Pesan (Login) | [ ] | |
| B3.3 - Kirim Pesan (No Login) | [ ] | |
| B3.4 - Form Kosong | [ ] | |
| B3.5 - SQL Injection | [ ] | |
| B3.6 - XSS Pesan | [ ] | **Security Concern** |
| B3.7 - Email Validation | [ ] | |
| B3.8 - Google Maps | [ ] | |
| B3.9 - Navigation | [ ] | |
| B3.10 - Responsive | [ ] | |

**Total Test Cases**: 30
**Passed**: 0
**Failed**: 0
**Not Tested**: 30

**Issues Found**:
- Architecture: Menu hardcoded
- Security: Output escaping untuk chat messages

