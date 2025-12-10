# Skenario Uji Admin Dashboard - pjbl (Kedai Serenade)

## C1. Dashboard Admin
**File**: `pjbl/admin/dashboard.php`

### Test Case 1: Akses Dashboard sebagai Admin
**Prerequisites**: User dengan role `'admin'` sudah login

**Steps**:
1. Login sebagai admin
2. Buka `pjbl/admin/dashboard.php`

**Expected Results**:
- ✅ Dashboard load dengan sukses
- ✅ Sidebar navigation ditampilkan
- ✅ Header dengan username admin
- ✅ Logout button tersedia

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Akses Dashboard sebagai User Biasa
**Prerequisites**: User dengan role `'user'` sudah login

**Steps**:
1. Login sebagai user biasa
2. Coba akses `pjbl/admin/dashboard.php` langsung (via URL)

**Expected Results**:
- ✅ Redirect ke `../login.php` (line 11-13)
- ✅ Dashboard tidak ditampilkan
- ✅ Access denied

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Akses Dashboard Tanpa Login
**Steps**:
1. Logout atau clear session
2. Coba akses `pjbl/admin/dashboard.php` langsung

**Expected Results**:
- ✅ Redirect ke `../login.php`
- ✅ Dashboard tidak ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Menampilkan Statistik Total Sales
**Prerequisites**: 
- Database memiliki data orders bulan ini
- Status order = 'completed'

**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Perhatikan stat card "Total Sales"

**Expected Results**:
- ✅ Total Sales dihitung dari:
  - Query: `SELECT SUM(total_amount) FROM orders WHERE MONTH(order_date) = current_month AND YEAR(order_date) = current_year AND status = 'completed'`
- ✅ Format: `Rp. XX.XXX.XXX` (number_format dengan separator titik)
- ✅ Icon 💵 ditampilkan
- ✅ Card memiliki hover effect

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Menampilkan Statistik Total Order
**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Perhatikan stat card "Total Order"

**Expected Results**:
- ✅ Total Order dihitung dari:
  - Query: `SELECT COUNT(*) FROM orders WHERE MONTH(order_date) = current_month AND YEAR(order_date) = current_year`
- ✅ Menampilkan jumlah pesanan (integer)
- ✅ Icon 🛍️ ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: Menampilkan Statistik New Customers
**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Perhatikan stat card "New Customers"

**Expected Results**:
- ✅ New Customers dihitung dari:
  - Query: `SELECT COUNT(*) FROM users WHERE MONTH(created_at) = current_month AND YEAR(created_at) = current_year AND role = 'user'`
- ✅ Menampilkan jumlah user baru bulan ini
- ✅ Icon 👥 ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 7: Tabel Profit Bulanan
**Prerequisites**: Tabel `monthly_profits` memiliki data untuk tahun berjalan

**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Scroll ke section "Total Keuntungan per Bulan"

**Expected Results**:
- ✅ Tabel menampilkan 12 bulan (Januari - Desember)
- ✅ Data diurutkan sesuai urutan bulan (menggunakan FIELD())
- ✅ Setiap baris menampilkan:
  - Nama bulan
  - Total keuntungan (format: `Rp. XX.XXX.XXX`)
- ✅ Baris terakhir menampilkan TOTAL (background hijau)
- ✅ Total dihitung dari penjumlahan semua bulan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: Badge Unread Messages
**Prerequisites**: Ada pesan dari user yang belum dibaca (`is_read = 0`)

**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Perhatikan menu "Chat" di sidebar

**Expected Results**:
- ✅ Badge merah dengan jumlah unread messages ditampilkan
- ✅ Query: `SELECT COUNT(*) FROM chat_messages WHERE sender_role = 'user' AND is_read = 0`
- ✅ Badge hanya muncul jika `unread_messages > 0`

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: Sidebar Navigation
**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Klik menu items di sidebar

**Expected Results**:
- ✅ Semua link berfungsi:
  - Dashboard → `dashboard.php` (active)
  - Rating & Komentar → `rating.php`
  - Chat → `chat.php`
  - Kelola Profit → `profits.php`
- ✅ Active state pada menu "Dashboard"
- ✅ Hover effect pada menu items

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 10: Responsive Design
**Steps**:
1. Buka `pjbl/admin/dashboard.php` sebagai admin
2. Resize browser window ke mobile (< 768px)

**Expected Results**:
- ✅ Sidebar hidden di mobile
- ✅ Main content full width
- ✅ Stats grid menjadi 1 column
- ✅ Table responsive dengan horizontal scroll
- ✅ Header layout berubah (flex-direction: column)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 11: SQL Injection pada Query
**Code Review**: `pjbl/admin/dashboard.php` line 44
```php
$profit_data = $conn->query("SELECT * FROM monthly_profits WHERE year = $current_year ORDER BY FIELD(month, ...)");
```

**Analysis**:
- ⚠️ **ISSUE**: Query menggunakan `$conn->query()` langsung dengan variable interpolation
- ⚠️ Meski `$current_year` dari `date('Y')` (aman), lebih baik menggunakan prepared statement
- ✅ `$current_year` adalah integer dari date(), jadi relatif aman
- ⚠️ **Recommendation**: Gunakan prepared statement untuk konsistensi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Code Review**: Query langsung, perlu prepared statement

---

## C2. Chat Management
**File**: `pjbl/admin/chat.php`

### Test Case 1: Menampilkan Daftar User yang Mengirim Pesan
**Prerequisites**: 
- Ada beberapa user yang sudah mengirim pesan
- Tabel `chat_messages` memiliki data

**Steps**:
1. Buka `pjbl/admin/chat.php` sebagai admin
2. Perhatikan user list di sidebar kiri

**Expected Results**:
- ✅ List user ditampilkan dengan:
  - Username
  - Unread count badge (jika ada)
  - Last message time
- ✅ User diurutkan berdasarkan `last_message_time DESC`
- ✅ Hanya user dengan role `'user'` yang ditampilkan
- ✅ Query menggunakan DISTINCT untuk menghindari duplikat

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Pilih User untuk Chat
**Steps**:
1. Buka `pjbl/admin/chat.php` sebagai admin
2. Klik user dari list

**Expected Results**:
- ✅ URL berubah: `chat.php?user_id=X`
- ✅ User item menjadi active (background hijau, border kiri)
- ✅ Chat box menampilkan pesan dari user tersebut
- ✅ Header chat menampilkan username user

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Menampilkan Pesan Chat
**Prerequisites**: User tertentu sudah mengirim pesan

**Steps**:
1. Buka `pjbl/admin/chat.php?user_id=1` sebagai admin
2. Perhatikan chat messages

**Expected Results**:
- ✅ Semua pesan ditampilkan (user dan admin)
- ✅ Pesan diurutkan `ORDER BY created_at ASC`
- ✅ Pesan user: align left, background abu-abu
- ✅ Pesan admin: align right, background teal (#1a9b8e)
- ✅ Timestamp ditampilkan di bawah setiap pesan
- ✅ Format timestamp: `dd MMM yyyy, HH:mm`
- ✅ Output di-escape dengan `htmlspecialchars()` (line 372) ✅

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Mark Messages as Read
**Prerequisites**: Ada pesan unread dari user tertentu

**Steps**:
1. Buka `pjbl/admin/chat.php?user_id=1` sebagai admin
2. Pesan dari user tersebut belum dibaca

**Expected Results**:
- ✅ Query update: `UPDATE chat_messages SET is_read = 1 WHERE user_id = X AND sender_role = 'user'`
- ✅ Pesan ditandai sebagai read
- ✅ Unread badge berkurang/hilang
- ⚠️ **ISSUE**: Query menggunakan `$conn->query()` langsung dengan variable interpolation (line 42)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Concern**: Perlu prepared statement

---

### Test Case 5: Kirim Pesan sebagai Admin
**Prerequisites**: User tertentu dipilih untuk chat

**Steps**:
1. Buka `pjbl/admin/chat.php?user_id=1` sebagai admin
2. Ketik pesan di textarea
3. Klik tombol "Kirim"

**Expected Results**:
- ✅ Pesan tersimpan ke database:
  - `user_id`: dari form
  - `sender_role`: `'admin'`
  - `message`: pesan yang dikirim
- ✅ Prepared statement digunakan (line 21) ✅
- ✅ Redirect ke `chat.php?user_id=X` setelah kirim
- ✅ Pesan muncul di chat box

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: Auto Refresh Chat
**Steps**:
1. Buka `pjbl/admin/chat.php?user_id=1` sebagai admin
2. Tunggu beberapa detik

**Expected Results**:
- ✅ Halaman auto-refresh setiap 10 detik (line 402-404)
- ✅ Chat messages ter-update otomatis
- ✅ Scroll position tetap di bottom

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 7: Auto Scroll to Bottom
**Steps**:
1. Buka `pjbl/admin/chat.php?user_id=1` sebagai admin
2. Perhatikan scroll position

**Expected Results**:
- ✅ Chat messages auto-scroll ke bottom saat load (line 397)
- ✅ JavaScript: `chatMessages.scrollTop = chatMessages.scrollHeight`

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: SQL Injection pada user_id
**Steps**:
1. Coba akses `pjbl/admin/chat.php?user_id=1' OR '1'='1`

**Expected Results**:
- ✅ `(int)$_GET['user_id']` mengkonversi ke integer (line 38)
- ✅ SQL injection dicegah
- ✅ Query aman

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: XSS pada Pesan
**Prerequisites**: User mengirim pesan dengan script

**Steps**:
1. User mengirim pesan: `<script>alert('XSS')</script>`
2. Admin melihat pesan di chat

**Expected Results**:
- ✅ Output di-escape dengan `htmlspecialchars()` (line 372) ✅
- ✅ Script tidak dieksekusi
- ✅ Pesan ditampilkan sebagai text biasa

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 10: No Chat Selected
**Steps**:
1. Buka `pjbl/admin/chat.php` tanpa parameter `user_id`

**Expected Results**:
- ✅ User list ditampilkan
- ✅ Chat box menampilkan: "Pilih pengguna untuk memulai chat"
- ✅ Form input tidak ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## C3. Profit Management
**File**: `pjbl/admin/profits.php`

### Test Case 1: Menampilkan Data Profit
**Prerequisites**: Tabel `monthly_profits` memiliki data untuk tahun berjalan

**Steps**:
1. Buka `pjbl/admin/profits.php` sebagai admin
2. Perhatikan tabel profit

**Expected Results**:
- ✅ Tabel menampilkan 12 bulan
- ✅ Setiap baris memiliki:
  - Nama bulan
  - Input field untuk edit profit
  - Tombol "Update"
- ✅ Baris terakhir: TOTAL (background hijau)
- ✅ Total dihitung dari penjumlahan semua bulan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Update Profit
**Steps**:
1. Buka `pjbl/admin/profits.php` sebagai admin
2. Ubah nilai profit di input field (contoh: Januari)
3. Klik tombol "Update"

**Expected Results**:
- ✅ Data profit ter-update di database
- ✅ Query: `UPDATE monthly_profits SET total_profit = ? WHERE id = ?`
- ✅ Prepared statement digunakan (line 24) ✅
- ✅ Success message: "Data profit berhasil diupdate!"
- ✅ Halaman refresh, nilai baru ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Update Profit dengan Nilai Negatif
**Steps**:
1. Buka `pjbl/admin/profits.php` sebagai admin
2. Ubah profit menjadi nilai negatif: `-1000000`
3. Klik tombol "Update"

**Expected Results**:
- ⚠️ **ISSUE**: Tidak ada validasi untuk nilai negatif
- ⚠️ Profit bisa menjadi negatif (tidak masuk akal untuk profit)
- ⚠️ **Recommendation**: Tambahkan validasi `$profit >= 0`

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Bug Found**: Tidak ada validasi nilai negatif

---

### Test Case 4: Update Profit dengan Nilai Sangat Besar
**Steps**:
1. Buka `pjbl/admin/profits.php` sebagai admin
2. Ubah profit menjadi nilai sangat besar: `999999999999`
3. Klik tombol "Update"

**Expected Results**:
- ✅ Database menerima nilai (tergantung tipe data kolom)
- ⚠️ **ISSUE**: Tidak ada validasi maksimum
- ⚠️ **Recommendation**: Tambahkan validasi range

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: SQL Injection pada Profit Value
**Steps**:
1. Buka `pjbl/admin/profits.php` sebagai admin
2. Coba manipulasi form dengan SQL injection

**Expected Results**:
- ✅ Prepared statement mencegah SQL injection (line 24) ✅
- ✅ `(float)$_POST['profit']` mengkonversi ke float
- ✅ Query aman

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: Query dengan Variable Interpolation
**Code Review**: `pjbl/admin/profits.php` line 36
```php
$profits = $conn->query("SELECT * FROM monthly_profits WHERE year = $year ORDER BY ...");
```

**Analysis**:
- ⚠️ **ISSUE**: Query menggunakan `$conn->query()` langsung dengan variable interpolation
- ⚠️ Meski `$year` dari `date('Y')` (aman), lebih baik menggunakan prepared statement
- ⚠️ **Recommendation**: Gunakan prepared statement untuk konsistensi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Code Review**: Query langsung, perlu prepared statement

---

## C4. Rating & Komentar
**File**: `pjbl/admin/rating.php`

### Test Case 1: Menampilkan Rating Statistics
**Prerequisites**: Tabel `ratings` memiliki data

**Steps**:
1. Buka `pjbl/admin/rating.php` sebagai admin
2. Perhatikan stats card di atas

**Expected Results**:
- ✅ Rata-rata rating ditampilkan (format: `X.X / 5.0`)
- ✅ Total ratings ditampilkan
- ✅ Query: `SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM ratings`
- ✅ Background gradient teal
- ✅ Rata-rata dibulatkan 1 desimal (round)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Menampilkan Rating Cards
**Steps**:
1. Buka `pjbl/admin/rating.php` sebagai admin
2. Perhatikan rating grid

**Expected Results**:
- ✅ Rating cards ditampilkan dalam grid layout
- ✅ Setiap card menampilkan:
  - Username (di-escape dengan htmlspecialchars) ✅
  - Stars (⭐ untuk rating, ☆ untuk tidak)
  - Comment (di-escape dengan htmlspecialchars) ✅
  - Timestamp (format: `dd MMM yyyy, HH:mm`)
  - Delete button
- ✅ Cards diurutkan `ORDER BY created_at DESC` (terbaru pertama)
- ✅ Hover effect pada cards

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Hapus Rating
**Steps**:
1. Buka `pjbl/admin/rating.php` sebagai admin
2. Klik tombol "Hapus" pada rating tertentu
3. Konfirmasi di popup

**Expected Results**:
- ✅ Popup konfirmasi: "Hapus rating ini?"
- ✅ Jika konfirmasi: rating dihapus dari database
- ✅ Query: `DELETE FROM ratings WHERE id = $id`
- ✅ Redirect ke `ratings.php` (line 20)
- ⚠️ **ISSUE**: Query menggunakan `$conn->query()` langsung dengan variable interpolation (line 19)
- ⚠️ **ISSUE**: File name mismatch: `rating.php` vs `ratings.php` (line 20)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Concern**: Perlu prepared statement, **Bug**: File name mismatch

---

### Test Case 4: SQL Injection pada Delete
**Steps**:
1. Coba akses `pjbl/admin/rating.php?delete=1' OR '1'='1`

**Expected Results**:
- ✅ `(int)$_GET['delete']` mengkonversi ke integer (line 18)
- ✅ SQL injection dicegah
- ✅ Query aman (meski masih menggunakan query langsung)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: XSS pada Username/Comment
**Prerequisites**: Rating dengan username/comment berisi script

**Steps**:
1. Buka `pjbl/admin/rating.php` sebagai admin
2. Perhatikan rating dengan username/comment berisi script

**Expected Results**:
- ✅ Output di-escape dengan `htmlspecialchars()` (line 279, 289) ✅
- ✅ Script tidak dieksekusi
- ✅ Text ditampilkan sebagai plain text

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: Responsive Grid Layout
**Steps**:
1. Buka `pjbl/admin/rating.php` sebagai admin
2. Resize browser ke mobile

**Expected Results**:
- ✅ Grid menjadi 1 column di mobile (< 768px)
- ✅ Cards tetap readable
- ✅ Layout adaptif

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## Security Issues Identified

### 1. Query dengan Variable Interpolation
**Locations**:
- `pjbl/admin/dashboard.php` line 44
- `pjbl/admin/profits.php` line 36
- `pjbl/admin/chat.php` line 42
- `pjbl/admin/rating.php` line 19, 25, 28

**Issue**: Beberapa query menggunakan `$conn->query()` langsung dengan variable interpolation

**Recommendation**: Gunakan prepared statement untuk semua query:
```php
// Instead of:
$profits = $conn->query("SELECT * FROM monthly_profits WHERE year = $year");

// Use:
$stmt = $conn->prepare("SELECT * FROM monthly_profits WHERE year = ?");
$stmt->bind_param("i", $year);
$stmt->execute();
$profits = $stmt->get_result();
```

### 2. File Name Mismatch
**Location**: `pjbl/admin/rating.php` line 20
**Issue**: Redirect ke `ratings.php` tapi file sebenarnya `rating.php`

**Fix**: Ubah ke `rating.php`

### 3. Tidak Ada Validasi Profit Negatif
**Location**: `pjbl/admin/profits.php` line 22
**Issue**: Profit bisa di-set negatif

**Fix**: Tambahkan validasi:
```php
if ($profit < 0) {
    $error = 'Profit tidak boleh negatif!';
}
```

---

## Test Summary

| Test Case | Status | Notes |
|-----------|--------|-------|
| C1.1 - Akses sebagai Admin | [ ] | |
| C1.2 - Akses sebagai User | [ ] | |
| C1.3 - Akses Tanpa Login | [ ] | |
| C1.4 - Statistik Total Sales | [ ] | |
| C1.5 - Statistik Total Order | [ ] | |
| C1.6 - Statistik New Customers | [ ] | |
| C1.7 - Tabel Profit Bulanan | [ ] | |
| C1.8 - Badge Unread Messages | [ ] | |
| C1.9 - Sidebar Navigation | [ ] | |
| C1.10 - Responsive Design | [ ] | |
| C1.11 - SQL Injection Query | [ ] | **Code Review** |
| C2.1 - Daftar User | [ ] | |
| C2.2 - Pilih User | [ ] | |
| C2.3 - Tampil Pesan | [ ] | |
| C2.4 - Mark as Read | [ ] | **Security Concern** |
| C2.5 - Kirim Pesan | [ ] | |
| C2.6 - Auto Refresh | [ ] | |
| C2.7 - Auto Scroll | [ ] | |
| C2.8 - SQL Injection user_id | [ ] | |
| C2.9 - XSS Pesan | [ ] | |
| C2.10 - No Chat Selected | [ ] | |
| C3.1 - Tampil Data Profit | [ ] | |
| C3.2 - Update Profit | [ ] | |
| C3.3 - Profit Negatif | [ ] | **Bug Found** |
| C3.4 - Profit Sangat Besar | [ ] | |
| C3.5 - SQL Injection Profit | [ ] | |
| C3.6 - Query Variable Interpolation | [ ] | **Code Review** |
| C4.1 - Rating Statistics | [ ] | |
| C4.2 - Rating Cards | [ ] | |
| C4.3 - Hapus Rating | [ ] | **Security Concern + Bug** |
| C4.4 - SQL Injection Delete | [ ] | |
| C4.5 - XSS Username/Comment | [ ] | |
| C4.6 - Responsive Grid | [ ] | |

**Total Test Cases**: 36
**Passed**: 0
**Failed**: 0
**Not Tested**: 36

**Issues Found**:
- Security: Query dengan variable interpolation (5 locations)
- Bug: Profit bisa negatif
- Bug: File name mismatch di rating.php
- Code Review: Perlu prepared statement di beberapa query

