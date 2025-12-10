# Skenario Uji Autentikasi - pjbl (Kedai Serenade)

## A1. Registrasi User
**File**: `pjbl/register.php`

### Test Case 1: Registrasi Berhasil
**Prerequisites**: Database `admin_login_system` tersedia, tabel `users` sudah dibuat

**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan data valid:
   - Username: `newuser`
   - Email: `newuser@example.com`
   - Password: `password123` (minimal 6 karakter)
   - Konfirmasi Password: `password123`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Success message: "Registrasi berhasil! Silakan login."
- ✅ Data user tersimpan di database dengan:
  - `username`: `newuser`
  - `email`: `newuser@example.com`
  - `password`: di-hash dengan `password_hash()` (PASSWORD_DEFAULT)
  - `role`: `'user'` (default)
- ✅ Auto-redirect ke `login.php` setelah 2 detik
- ✅ Password tidak tersimpan dalam plain text

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Password Tidak Cocok
**Steps**:
1. Buka `pjbl/register.php`
2. Isi form:
   - Password: `password123`
   - Konfirmasi Password: `password456`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Error message: "Password dan konfirmasi password tidak cocok!"
- ✅ Data tidak tersimpan ke database
- ✅ Form tetap menampilkan input yang sudah diisi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Password Kurang dari 6 Karakter
**Steps**:
1. Buka `pjbl/register.php`
2. Isi form:
   - Password: `pass1` (5 karakter)
   - Konfirmasi Password: `pass1`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Error message: "Password minimal 6 karakter!"
- ✅ Data tidak tersimpan ke database

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Username Sudah Terdaftar
**Prerequisites**: Username `existinguser` sudah ada di database

**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan username yang sudah terdaftar:
   - Username: `existinguser`
   - Email: `different@example.com`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Error message: "Username atau email sudah terdaftar!"
- ✅ Data tidak tersimpan ke database

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Email Sudah Terdaftar
**Prerequisites**: Email `existing@example.com` sudah ada di database

**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan email yang sudah terdaftar:
   - Username: `differentuser`
   - Email: `existing@example.com`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Error message: "Username atau email sudah terdaftar!"
- ✅ Data tidak tersimpan ke database

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: SQL Injection Attempt
**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan SQL injection:
   - Username: `' OR '1'='1`
   - Email: `test@example.com`
   - Password: `password123`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Prepared statement mencegah SQL injection
- ✅ Query aman dengan parameter binding
- ✅ Data tidak tersimpan (karena username/email tidak valid)
- ✅ Error message ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 7: XSS Attempt
**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan script:
   - Username: `<script>alert('XSS')</script>`
   - Email: `test@example.com`
   - Password: `password123`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Script tidak dieksekusi saat registrasi
- ✅ Data tersimpan (jika valid) tapi script di-escape
- ⚠️ **ISSUE**: Perlu cek apakah output di-escape saat ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: Validasi Form Kosong
**Steps**:
1. Buka `pjbl/register.php`
2. Biarkan form kosong
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Browser validation mencegah submit (karena `required` attribute)
- ✅ Atau error message ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: Email Format Validation
**Steps**:
1. Buka `pjbl/register.php`
2. Isi form dengan email tidak valid:
   - Email: `notanemail`
   - Username: `testuser`
   - Password: `password123`
3. Klik tombol "Daftar"

**Expected Results**:
- ✅ Browser validation (HTML5 `type="email"`) mencegah submit
- ✅ Atau error message dari server-side validation

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## A2. Login Multi-Role
**File**: `pjbl/login.php`

### Test Case 1: Login User Berhasil
**Prerequisites**: User dengan username `testuser` dan password `password123` sudah terdaftar dengan role `'user'`

**Steps**:
1. Buka `pjbl/login.php`
2. Isi form:
   - Username atau Email: `testuser`
   - Password: `password123`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Session dibuat:
  - `$_SESSION['user_id']`
  - `$_SESSION['username']`
  - `$_SESSION['role']` = `'user'`
- ✅ Redirect ke `page-beranda/index.php`
- ✅ Tidak ada error message

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Login Admin Berhasil
**Prerequisites**: User dengan username `admin` dan password `admin123` sudah terdaftar dengan role `'admin'`

**Steps**:
1. Buka `pjbl/login.php`
2. Isi form:
   - Username atau Email: `admin`
   - Password: `admin123`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Session dibuat dengan role `'admin'`
- ✅ Redirect ke `admin/dashboard.php` (bukan page-beranda)
- ✅ Tidak ada error message

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Login dengan Email
**Prerequisites**: User dengan email `user@example.com` sudah terdaftar

**Steps**:
1. Buka `pjbl/login.php`
2. Isi form:
   - Username atau Email: `user@example.com`
   - Password: `password123`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Login berhasil (query mencari di kolom `username` ATAU `email`)
- ✅ Session dibuat
- ✅ Redirect sesuai role

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Username/Email Tidak Terdaftar
**Steps**:
1. Buka `pjbl/login.php`
2. Isi form:
   - Username atau Email: `nonexistent`
   - Password: `anypassword`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Error message: "Username atau password salah!"
- ✅ Tidak ada session yang dibuat
- ✅ Tidak redirect

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 5: Password Salah
**Prerequisites**: User dengan username `testuser` sudah terdaftar

**Steps**:
1. Buka `pjbl/login.php`
2. Isi form:
   - Username atau Email: `testuser`
   - Password: `wrongpassword`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Error message: "Username atau password salah!"
- ✅ `password_verify()` mengembalikan false
- ✅ Tidak ada session yang dibuat
- ✅ Tidak redirect

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 6: SQL Injection Attempt
**Steps**:
1. Buka `pjbl/login.php`
2. Isi form dengan SQL injection:
   - Username atau Email: `' OR '1'='1`
   - Password: `anything`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Prepared statement mencegah SQL injection
- ✅ Query aman dengan parameter binding
- ✅ Login gagal (karena tidak ada user dengan username tersebut)
- ✅ Error message ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 7: XSS Attempt
**Steps**:
1. Buka `pjbl/login.php`
2. Isi form dengan script:
   - Username atau Email: `<script>alert('XSS')</script>`
   - Password: `test`
3. Klik tombol "Login"

**Expected Results**:
- ✅ Script tidak dieksekusi
- ✅ Input di-escape dengan benar
- ✅ Login gagal

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 8: Validasi Form Kosong
**Steps**:
1. Buka `pjbl/login.php`
2. Biarkan form kosong
3. Klik tombol "Login"

**Expected Results**:
- ✅ Browser validation mencegah submit (karena `required` attribute)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 9: real_escape_string() Usage
**Code Review**: `pjbl/login.php` line 7
```php
$username = $conn->real_escape_string(trim($_POST['username']));
```

**Analysis**:
- ✅ Menggunakan `real_escape_string()` untuk sanitization
- ✅ Juga menggunakan prepared statement (line 10)
- ⚠️ **Redundant**: `real_escape_string()` tidak diperlukan jika sudah menggunakan prepared statement
- ✅ Tetapi tidak berbahaya, hanya redundant

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Code Review**: Redundant but safe

---

### Test Case 10: Session Security
**Steps**:
1. Login sebagai user biasa
2. Cek session di browser (DevTools > Application > Cookies)
3. Coba akses `admin/dashboard.php` langsung

**Expected Results**:
- ✅ Session cookie set dengan proper attributes
- ⚠️ **ISSUE**: Perlu cek apakah session cookie set dengan `HttpOnly` dan `Secure` flags
- ✅ Akses `admin/dashboard.php` diblokir jika role bukan admin
- ✅ Redirect ke login jika tidak ada session

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## Security Analysis

### 1. Password Hashing ✅
**Location**: `pjbl/register.php` line 29, `pjbl/login.php` line 18
**Status**: **GOOD**
- Menggunakan `password_hash()` dengan `PASSWORD_DEFAULT` (bcrypt)
- Menggunakan `password_verify()` untuk verifikasi
- **Secure**: Mengikuti best practice PHP

### 2. Prepared Statements ✅
**Location**: `pjbl/login.php` line 10, `pjbl/register.php` line 20
**Status**: **GOOD**
- Semua query menggunakan prepared statements
- Parameter binding dengan `bind_param()`
- **Secure**: Mencegah SQL injection

### 3. Input Sanitization
**Location**: `pjbl/login.php` line 7
**Status**: **REDUNDANT BUT SAFE**
- Menggunakan `real_escape_string()` meski sudah ada prepared statement
- Tidak berbahaya, hanya redundant
- **Recommendation**: Bisa dihapus karena prepared statement sudah cukup

### 4. Session Management
**Status**: **NEEDS REVIEW**
- Perlu validasi:
  - Session timeout
  - Session regeneration setelah login
  - Secure cookie flags (HttpOnly, Secure)
  - SameSite attribute

### 5. Role-Based Access Control
**Location**: `pjbl/admin/dashboard.php` line 11
**Status**: **GOOD**
- Validasi role sebelum akses admin area
- Redirect jika bukan admin
- **Secure**: Proper access control

---

## Test Summary

| Test Case | Status | Notes |
|-----------|--------|-------|
| A1.1 - Registrasi Berhasil | [ ] | |
| A1.2 - Password Tidak Cocok | [ ] | |
| A1.3 - Password < 6 Karakter | [ ] | |
| A1.4 - Username Duplikat | [ ] | |
| A1.5 - Email Duplikat | [ ] | |
| A1.6 - SQL Injection | [ ] | |
| A1.7 - XSS Attempt | [ ] | |
| A1.8 - Form Kosong | [ ] | |
| A1.9 - Email Format | [ ] | |
| A2.1 - Login User Berhasil | [ ] | |
| A2.2 - Login Admin Berhasil | [ ] | |
| A2.3 - Login dengan Email | [ ] | |
| A2.4 - Username Tidak Terdaftar | [ ] | |
| A2.5 - Password Salah | [ ] | |
| A2.6 - SQL Injection | [ ] | |
| A2.7 - XSS Attempt | [ ] | |
| A2.8 - Form Kosong | [ ] | |
| A2.9 - real_escape_string Review | [ ] | |
| A2.10 - Session Security | [ ] | |

**Total Test Cases**: 19
**Passed**: 0
**Failed**: 0
**Not Tested**: 19

**Security Status**:
- ✅ Password Hashing: Secure
- ✅ Prepared Statements: Secure
- ⚠️ Session Management: Needs Review
- ✅ Role-Based Access: Secure

