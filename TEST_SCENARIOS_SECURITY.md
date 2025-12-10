# Skenario Uji Security Comprehensive - pjbl (Kedai Serenade)

## S1. CSRF (Cross-Site Request Forgery) Protection

### Test Case 1: CSRF Attack on Login Form
**Priority**: Critical

**Steps**:
1. Cek apakah form login memiliki CSRF token
2. Coba submit form tanpa token (jika ada)
3. Coba submit form dengan token invalid

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi CSRF token
- ✅ Form seharusnya memiliki CSRF token
- ✅ Request tanpa token atau token invalid ditolak
- ✅ Error message ditampilkan

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Vulnerability**: CSRF protection belum diimplementasi

---

### Test Case 2: CSRF Attack on Registration Form
**Priority**: Critical

**Steps**:
1. Cek apakah form register memiliki CSRF token
2. Coba submit form dari external site
3. Coba submit dengan token yang di-reuse

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi CSRF token
- ✅ CSRF token harus unique per session
- ✅ Token tidak bisa di-reuse
- ✅ External site tidak bisa submit form

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Vulnerability**: CSRF protection belum diimplementasi

---

### Test Case 3: CSRF Attack on Admin Actions
**Priority**: Critical

**Steps**:
1. Login sebagai admin
2. Cek apakah form update profit memiliki CSRF token
3. Coba submit form update profit dari external site
4. Cek apakah form delete rating memiliki CSRF token

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi CSRF token untuk semua admin actions
- ✅ Update profit memerlukan CSRF token
- ✅ Delete rating memerlukan CSRF token
- ✅ Request tanpa token ditolak

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Vulnerability**: CSRF protection untuk admin actions belum diimplementasi

---

## S2. Session Security

### Test Case 1: Session Hijacking Prevention
**Priority**: Critical

**Steps**:
1. Login sebagai user
2. Cek session cookie di browser DevTools
3. Verifikasi cookie attributes:
   - `HttpOnly` flag
   - `Secure` flag (jika HTTPS)
   - `SameSite` attribute

**Expected Results**:
- ⚠️ **ISSUE**: Perlu verifikasi session cookie attributes
- ✅ `HttpOnly` flag set (mencegah XSS access)
- ✅ `Secure` flag set jika HTTPS
- ✅ `SameSite` attribute set (Strict atau Lax)

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Review**: Perlu verifikasi session configuration

---

### Test Case 2: Session Fixation
**Priority**: High

**Steps**:
1. Dapatkan session ID sebelum login
2. Login dengan session ID tersebut
3. Cek apakah session ID berubah setelah login

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi session regeneration setelah login
- ✅ Session ID harus berubah setelah login sukses
- ✅ `session_regenerate_id()` dipanggil setelah login
- ✅ Session fixation dicegah

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Vulnerability**: Session regeneration belum diimplementasi

---

### Test Case 3: Session Timeout
**Priority**: High

**Steps**:
1. Login sebagai user
2. Biarkan session idle untuk waktu lama
3. Coba akses halaman yang memerlukan login

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi session timeout
- ✅ Session expire setelah waktu tertentu (misal 30 menit)
- ✅ User harus login ulang setelah timeout
- ✅ Session data dihapus setelah timeout

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Feature Missing**: Session timeout belum diimplementasi

---

### Test Case 4: Concurrent Session Management
**Priority**: Medium

**Steps**:
1. Login sebagai user di device A
2. Login sebagai user yang sama di device B
3. Cek apakah kedua session aktif

**Expected Results**:
- ⚠️ **SECURITY POLICY**: Perlu tentukan policy
- ✅ Option 1: Single session (logout device A saat login di B)
- ✅ Option 2: Multiple sessions allowed (current behavior)
- ✅ Policy harus konsisten dan documented

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Policy Decision**: Perlu tentukan concurrent session policy

---

## S3. Direct URL Access

### Test Case 1: Direct Access to Admin Pages
**Priority**: Critical

**Steps**:
1. Tanpa login, akses langsung:
   - `admin/dashboard.php`
   - `admin/chat.php`
   - `admin/profits.php`
   - `admin/rating.php`

**Expected Results**:
- ✅ Semua admin pages redirect ke `login.php`
- ✅ Tidak ada data yang ditampilkan
- ✅ Access control bekerja

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Direct Access with Invalid Session
**Priority**: High

**Steps**:
1. Buat session cookie dengan session ID yang tidak valid
2. Coba akses admin pages

**Expected Results**:
- ✅ Session validation menolak invalid session
- ✅ Redirect ke login
- ✅ Tidak ada error PHP

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Direct Access with Expired Session
**Priority**: High

**Steps**:
1. Login sebagai user
2. Manually expire session di database/server
3. Coba akses halaman yang memerlukan login

**Expected Results**:
- ✅ Expired session ditolak
- ✅ Redirect ke login
- ✅ Error message user-friendly

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## S4. Input Validation & Sanitization

### Test Case 1: SQL Injection - All Input Fields
**Priority**: Critical

**Steps**:
1. Test SQL injection di semua input fields:
   - Register: username, email
   - Login: username/email
   - Chat message
   - Profit value
   - Rating comment

**Expected Results**:
- ✅ Prepared statements digunakan di semua query
- ✅ SQL injection dicegah
- ✅ Input di-sanitize dengan benar
- ✅ Tidak ada SQL error yang expose database structure

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: XSS (Cross-Site Scripting) - All Output
**Priority**: Critical

**Steps**:
1. Input script di semua fields yang ditampilkan:
   - Username: `<script>alert('XSS')</script>`
   - Chat message: `<img src=x onerror=alert('XSS')>`
   - Rating comment: `<svg onload=alert('XSS')>`
2. Cek output di semua halaman

**Expected Results**:
- ✅ Output di-escape dengan `htmlspecialchars()`
- ✅ Script tidak dieksekusi
- ✅ Text ditampilkan sebagai plain text
- ✅ XSS dicegah di semua output

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: ⚠️ **ISSUE**: Perlu verifikasi semua output di-escape

---

### Test Case 3: Path Traversal
**Priority**: Medium

**Steps**:
1. Coba input path traversal di file upload (jika ada):
   - `../../../etc/passwd`
   - `..\..\..\windows\system32\config\sam`
2. Coba akses file di luar web root via URL

**Expected Results**:
- ✅ Path traversal dicegah
- ✅ File access terbatas pada web root
- ✅ Tidak ada file system access

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 4: Command Injection
**Priority**: High

**Steps**:
1. Coba input command injection di semua input:
   - `; ls -la`
   - `| cat /etc/passwd`
   - `&& rm -rf /`
2. Cek apakah command dieksekusi

**Expected Results**:
- ✅ Command injection dicegah
- ✅ Input di-sanitize
- ✅ Tidak ada system command dieksekusi

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## S5. Authentication & Authorization

### Test Case 1: Brute Force Attack Prevention
**Priority**: High

**Steps**:
1. Coba login dengan password salah berulang kali (10+ kali)
2. Cek apakah ada rate limiting atau account lockout

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi rate limiting
- ✅ Rate limiting mencegah brute force
- ✅ Account lockout setelah X failed attempts
- ✅ CAPTCHA atau delay setelah failed attempts

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Vulnerability**: Brute force protection belum diimplementasi

---

### Test Case 2: Password Policy Enforcement
**Priority**: Medium

**Steps**:
1. Coba register dengan password lemah:
   - `123456`
   - `password`
   - `abc123`
2. Cek apakah password policy enforced

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi password policy
- ✅ Password minimal 6 karakter (sudah ada)
- ✅ Password harus mengandung kombinasi (huruf, angka, special char)
- ✅ Common passwords ditolak

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Feature Enhancement**: Password policy bisa diperkuat

---

### Test Case 3: Role Escalation
**Priority**: Critical

**Steps**:
1. Login sebagai user biasa
2. Coba manipulasi session untuk mengubah role menjadi 'admin'
3. Coba akses admin pages dengan role yang dimanipulasi

**Expected Results**:
- ✅ Role validation di server-side
- ✅ Manipulasi session role tidak berhasil
- ✅ Access control berdasarkan database, bukan hanya session
- ✅ Role escalation dicegah

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: ⚠️ **ISSUE**: Perlu verifikasi role validation di server-side

---

### Test Case 4: Session After Logout
**Priority**: High

**Steps**:
1. Login sebagai user
2. Logout
3. Coba gunakan session ID yang sama untuk akses halaman

**Expected Results**:
- ✅ Session dihapus setelah logout
- ✅ Session ID tidak bisa digunakan lagi
- ✅ Access ditolak setelah logout

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## S6. Data Exposure

### Test Case 1: Information Disclosure in Error Messages
**Priority**: High

**Steps**:
1. Trigger berbagai error:
   - Database connection error
   - SQL query error
   - File not found error
2. Cek error messages

**Expected Results**:
- ✅ Error messages tidak expose:
   - Database structure
   - File paths
   - System information
   - Stack traces (di production)
- ✅ User-friendly error messages
- ✅ Technical details hanya di log, bukan ke user

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Security Concern**: Error messages perlu review

---

### Test Case 2: Sensitive Data in URLs
**Priority**: Medium

**Steps**:
1. Cek semua URL untuk sensitive data:
   - Session ID di URL
   - Password di URL
   - User ID yang bisa di-guess
2. Cek apakah data sensitive di URL

**Expected Results**:
- ✅ Tidak ada session ID di URL
- ✅ Tidak ada password di URL
- ✅ User ID di URL aman (integer, tidak sequential)
- ✅ Sensitive data hanya di POST atau session

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Directory Listing
**Priority**: Low

**Steps**:
1. Akses directory tanpa index file:
   - `admin/`
   - `page-beranda/`
2. Cek apakah directory listing enabled

**Expected Results**:
- ✅ Directory listing disabled
- ✅ 403 Forbidden atau redirect
- ✅ Tidak expose file structure

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## S7. File Upload Vulnerabilities (If Applicable)

### Test Case 1: Malicious File Upload
**Priority**: High (if file upload exists)

**Steps**:
1. Coba upload file berbahaya:
   - PHP script: `shell.php`
   - Executable: `malware.exe`
   - Large file: > 10MB
2. Cek apakah file upload ada dan bagaimana ditangani

**Expected Results**:
- ⚠️ **NOTE**: Perlu cek apakah ada file upload functionality
- ✅ File type validation
- ✅ File size limit
- ✅ File stored outside web root atau dengan random name
- ✅ Executable files ditolak

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Review**: Perlu cek apakah ada file upload

---

## Test Summary

| Test Case | Priority | Status | Notes |
|-----------|----------|--------|-------|
| S1.1 - CSRF Login | Critical | [ ] | **Vulnerability** |
| S1.2 - CSRF Registration | Critical | [ ] | **Vulnerability** |
| S1.3 - CSRF Admin Actions | Critical | [ ] | **Vulnerability** |
| S2.1 - Session Hijacking | Critical | [ ] | **Review** |
| S2.2 - Session Fixation | High | [ ] | **Vulnerability** |
| S2.3 - Session Timeout | High | [ ] | **Feature Missing** |
| S2.4 - Concurrent Session | Medium | [ ] | **Policy Decision** |
| S3.1 - Direct Access Admin | Critical | [ ] | |
| S3.2 - Invalid Session | High | [ ] | |
| S3.3 - Expired Session | High | [ ] | |
| S4.1 - SQL Injection | Critical | [ ] | |
| S4.2 - XSS All Output | Critical | [ ] | **Issue** |
| S4.3 - Path Traversal | Medium | [ ] | |
| S4.4 - Command Injection | High | [ ] | |
| S5.1 - Brute Force | High | [ ] | **Vulnerability** |
| S5.2 - Password Policy | Medium | [ ] | **Enhancement** |
| S5.3 - Role Escalation | Critical | [ ] | **Issue** |
| S5.4 - Session After Logout | High | [ ] | |
| S6.1 - Info Disclosure | High | [ ] | **Concern** |
| S6.2 - Sensitive Data URL | Medium | [ ] | |
| S6.3 - Directory Listing | Low | [ ] | |
| S7.1 - File Upload | High | [ ] | **Review** |

**Total Test Cases**: 22
**Passed**: 0
**Failed**: 0
**Not Tested**: 22

**Critical Vulnerabilities Found**:
- CSRF protection belum diimplementasi (3 locations)
- Session fixation belum dicegah
- Role escalation perlu verifikasi
- Brute force protection belum ada

**Security Recommendations**:
1. Implementasi CSRF token untuk semua forms
2. Session regeneration setelah login
3. Rate limiting untuk login attempts
4. Strengthen password policy
5. Review error messages untuk information disclosure
6. Verifikasi role validation di server-side



