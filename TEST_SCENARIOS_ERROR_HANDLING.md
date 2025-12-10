# Skenario Uji Error Handling & Edge Cases - pjbl (Kedai Serenade)

## E1. Database Connection Errors

### Test Case 1: Database Connection Failure
**Priority**: Critical

**Steps**:
1. Stop MySQL service atau ubah kredensial database di `config.php` menjadi salah
2. Buka `login.php`
3. Coba login

**Expected Results**:
- ✅ Error message ditampilkan: "Koneksi ke database gagal: ..."
- ✅ Aplikasi tidak crash
- ✅ Error message user-friendly (tidak expose technical details)
- ⚠️ **ISSUE**: Error message mungkin terlalu detail (expose connection error)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Concern**: Error message mungkin expose sensitive info

---

### Test Case 2: Database Connection Timeout
**Priority**: Medium

**Steps**:
1. Simulasi database timeout (delay response)
2. Coba akses halaman yang memerlukan database query

**Expected Results**:
- ✅ Timeout error ditangani dengan baik
- ✅ Error message ditampilkan
- ✅ Aplikasi tidak hang

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E2. Empty Database States

### Test Case 1: Empty Users Table
**Priority**: High

**Prerequisites**: Tabel `users` kosong

**Steps**:
1. Buka `login.php`
2. Coba login dengan username apapun

**Expected Results**:
- ✅ Error message: "Username atau password salah!"
- ✅ Tidak ada error PHP/MySQL
- ✅ Aplikasi tetap berfungsi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Empty Chat Messages
**Priority**: Medium

**Prerequisites**: Tabel `chat_messages` kosong

**Steps**:
1. Login sebagai admin
2. Buka `admin/chat.php`

**Expected Results**:
- ✅ Halaman load dengan sukses
- ✅ User list kosong atau menampilkan "Tidak ada pesan"
- ✅ Tidak ada error PHP
- ✅ Chat box menampilkan "Pilih pengguna untuk memulai chat"

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Empty Orders Table
**Priority**: Medium

**Prerequisites**: Tabel `orders` kosong

**Steps**:
1. Login sebagai admin
2. Buka `admin/dashboard.php`

**Expected Results**:
- ✅ Dashboard load dengan sukses
- ✅ Total Sales menampilkan `Rp. 0` atau `0`
- ✅ Total Order menampilkan `0`
- ✅ Tidak ada error PHP/MySQL

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Empty Monthly Profits
**Priority**: Medium

**Prerequisites**: Tabel `monthly_profits` kosong atau tidak ada data untuk tahun berjalan

**Steps**:
1. Login sebagai admin
2. Buka `admin/dashboard.php`
3. Scroll ke section profit

**Expected Results**:
- ✅ Dashboard load dengan sukses
- ✅ Tabel profit kosong atau menampilkan pesan "Tidak ada data"
- ✅ Total profit menampilkan `Rp. 0`
- ✅ Tidak ada error PHP

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Empty Ratings Table
**Priority**: Medium

**Prerequisites**: Tabel `ratings` kosong

**Steps**:
1. Login sebagai admin
2. Buka `admin/rating.php`

**Expected Results**:
- ✅ Halaman load dengan sukses
- ✅ Stats card menampilkan "0.0 / 5.0" atau "N/A"
- ✅ Rating grid kosong atau menampilkan "Tidak ada rating"
- ✅ Tidak ada error PHP

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E3. Invalid Data Formats

### Test Case 1: Invalid Email Format (Server-Side)
**Priority**: High

**Steps**:
1. Buka `register.php`
2. Bypass browser validation (disable JavaScript atau gunakan curl/Postman)
3. Submit form dengan email tidak valid: `notanemail`

**Expected Results**:
- ✅ Server-side validation menolak email tidak valid
- ✅ Error message ditampilkan
- ✅ Data tidak tersimpan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: ⚠️ **ISSUE**: Perlu cek apakah ada server-side email validation

---

### Test Case 2: Invalid Password Format
**Priority**: High

**Steps**:
1. Buka `register.php`
2. Submit form dengan password sangat panjang (> 255 karakter)
3. Submit form dengan password berisi karakter khusus yang mungkin bermasalah

**Expected Results**:
- ✅ Password validation bekerja
- ✅ Error message ditampilkan jika tidak valid
- ✅ Database tidak error (jika password terlalu panjang)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Invalid Profit Value Format
**Priority**: Medium

**Steps**:
1. Login sebagai admin
2. Buka `admin/profits.php`
3. Coba update profit dengan:
   - String: `"abc"`
   - Negative: `-1000`
   - Very large: `999999999999999`
   - Decimal: `1000.50`

**Expected Results**:
- ✅ Input validation bekerja
- ✅ Negative value ditolak (jika validasi ada)
- ✅ Very large value ditangani (database limit atau validation)
- ✅ Decimal value diterima (jika tipe data mendukung)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Bug Found**: Negative profit bisa di-set (tidak ada validasi)

---

### Test Case 4: Invalid user_id in URL
**Priority**: High

**Steps**:
1. Login sebagai admin
2. Akses `admin/chat.php?user_id=abc`
3. Akses `admin/chat.php?user_id=999999` (non-existent user)
4. Akses `admin/chat.php?user_id=-1`

**Expected Results**:
- ✅ `(int)$_GET['user_id']` mengkonversi string ke 0 atau integer
- ✅ Non-existent user_id tidak menyebabkan error
- ✅ Negative user_id ditangani dengan baik
- ✅ Tidak ada SQL error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E4. Concurrent Access Scenarios

### Test Case 1: Multiple Admin Update Profit Simultaneously
**Priority**: Medium

**Steps**:
1. Login sebagai admin di browser A
2. Login sebagai admin di browser B (atau incognito)
3. Update profit bulan Januari di browser A
4. Update profit bulan Januari di browser B (sebelum A selesai)
5. Cek hasil di database

**Expected Results**:
- ✅ Last write wins atau conflict resolution
- ✅ Tidak ada data corruption
- ✅ Database integrity terjaga
- ⚠️ **ISSUE**: Perlu implementasi locking atau optimistic concurrency control

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Feature Missing**: Concurrent update handling

---

### Test Case 2: User Send Message While Admin Viewing
**Priority**: Medium

**Steps**:
1. Admin buka chat dengan User A
2. User A kirim pesan baru saat admin sedang melihat chat
3. Admin refresh atau auto-refresh trigger
4. Cek pesan baru muncul

**Expected Results**:
- ✅ Pesan baru muncul setelah refresh
- ✅ Auto-refresh (10 detik) menampilkan pesan baru
- ✅ Tidak ada conflict atau error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Multiple Users Register Simultaneously
**Priority**: Low

**Steps**:
1. Buka `register.php` di multiple browser tabs
2. Submit registration dengan username yang sama di semua tabs secara bersamaan

**Expected Results**:
- ✅ Hanya satu registrasi yang berhasil
- ✅ Error message untuk duplikat username
- ✅ Database integrity terjaga
- ✅ Tidak ada race condition

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E5. Boundary Conditions

### Test Case 1: Maximum Username Length
**Priority**: Medium

**Steps**:
1. Buka `register.php`
2. Submit dengan username sangat panjang (255+ karakter)

**Expected Results**:
- ✅ Database constraint atau validation menolak
- ✅ Error message ditampilkan
- ✅ Tidak ada database error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Maximum Message Length
**Priority**: Medium

**Steps**:
1. Login sebagai user
2. Buka `page-pesan/index.php`
3. Kirim pesan sangat panjang (10000+ karakter)

**Expected Results**:
- ✅ Database constraint atau validation menangani
- ✅ Pesan tersimpan atau error message ditampilkan
- ✅ Tidak ada database error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Special Characters in Input
**Priority**: High

**Steps**:
1. Register dengan username: `user@#$%^&*()`
2. Register dengan email: `test+tag@example.com`
3. Kirim pesan dengan emoji: `Hello 😀👍`
4. Kirim pesan dengan unicode: `你好 مرحبا`

**Expected Results**:
- ✅ Special characters ditangani dengan baik
- ✅ UTF-8 encoding bekerja (charset utf8mb4)
- ✅ Emoji tersimpan dan ditampilkan dengan benar
- ✅ Tidak ada encoding error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E6. Missing Files/Resources

### Test Case 1: Missing config.php
**Priority**: Critical

**Steps**:
1. Rename `config.php` ke `config.php.bak`
2. Buka `login.php`

**Expected Results**:
- ✅ Error message: "Error: config.php tidak ditemukan!"
- ✅ Aplikasi tidak crash dengan error PHP fatal
- ✅ Error handling yang baik

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Missing Image Files
**Priority**: Low

**Steps**:
1. Hapus atau rename logo image files
2. Buka halaman yang menggunakan logo

**Expected Results**:
- ✅ Broken image icon ditampilkan
- ✅ Halaman tetap load
- ✅ Tidak ada PHP error

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## E7. SQL Query Errors

### Test Case 1: Invalid SQL Query
**Priority**: High

**Code Review**: Cek semua query untuk potential errors

**Analysis**:
- ⚠️ Query dengan variable interpolation bisa error jika variable tidak terdefinisi
- ⚠️ Perlu error handling untuk query failures

**Expected Results**:
- ✅ Semua query memiliki error handling
- ✅ Error query tidak expose sensitive information
- ✅ User-friendly error messages

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Code Review**: Perlu validasi error handling di semua query

---

### Test Case 2: Foreign Key Constraint Violation
**Priority**: High

**Steps**:
1. Coba insert chat_message dengan `user_id` yang tidak ada di tabel users
2. Coba delete user yang masih memiliki chat_messages

**Expected Results**:
- ✅ Foreign key constraint mencegah invalid data
- ✅ Error message ditampilkan
- ✅ Database integrity terjaga

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: ⚠️ **ISSUE**: Perlu cek apakah foreign key constraints sudah di-set di database

---

## Test Summary

| Test Case | Priority | Status | Notes |
|-----------|----------|--------|-------|
| E1.1 - Database Connection Failure | Critical | [ ] | **Security Concern** |
| E1.2 - Database Connection Timeout | Medium | [ ] | |
| E2.1 - Empty Users Table | High | [ ] | |
| E2.2 - Empty Chat Messages | Medium | [ ] | |
| E2.3 - Empty Orders Table | Medium | [ ] | |
| E2.4 - Empty Monthly Profits | Medium | [ ] | |
| E2.5 - Empty Ratings Table | Medium | [ ] | |
| E3.1 - Invalid Email Format | High | [ ] | **Issue** |
| E3.2 - Invalid Password Format | High | [ ] | |
| E3.3 - Invalid Profit Value | Medium | [ ] | **Bug Found** |
| E3.4 - Invalid user_id | High | [ ] | |
| E4.1 - Multiple Admin Update | Medium | [ ] | **Feature Missing** |
| E4.2 - User Send While Admin View | Medium | [ ] | |
| E4.3 - Multiple Users Register | Low | [ ] | |
| E5.1 - Maximum Username Length | Medium | [ ] | |
| E5.2 - Maximum Message Length | Medium | [ ] | |
| E5.3 - Special Characters | High | [ ] | |
| E6.1 - Missing config.php | Critical | [ ] | |
| E6.2 - Missing Image Files | Low | [ ] | |
| E7.1 - Invalid SQL Query | High | [ ] | **Code Review** |
| E7.2 - Foreign Key Violation | High | [ ] | **Issue** |

**Total Test Cases**: 20
**Passed**: 0
**Failed**: 0
**Not Tested**: 20

**Issues Found**:
- Security: Error messages mungkin expose sensitive info
- Bug: Negative profit bisa di-set
- Feature Missing: Concurrent update handling, server-side email validation
- Code Review: Error handling perlu validasi di semua query
- Issue: Foreign key constraints perlu verifikasi



