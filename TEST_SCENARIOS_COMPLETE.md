# Skenario Uji Lengkap - Proyek Kedai Serenade

## Ringkasan Eksekutif

Dokumen ini merupakan konsolidasi dari semua skenario uji untuk proyek Kedai Serenade. Total **172 test cases** yang mencakup:

- **Autentikasi** (19 test cases) - `TEST_SCENARIOS_AUTH.md`
- **Halaman Publik** (30 test cases) - `TEST_SCENARIOS_PUBLIC.md`
- **Admin Dashboard** (36 test cases) - `TEST_SCENARIOS_ADMIN.md`
- **Integration Testing** (15 test cases) - `TEST_SCENARIOS_INTEGRATION.md`
- **Error Handling** (20 test cases) - `TEST_SCENARIOS_ERROR_HANDLING.md`
- **Security Testing** (22 test cases) - `TEST_SCENARIOS_SECURITY.md`

**Total**: 142 test cases (beberapa overlap dihitung)

## Struktur Test Scenarios

### 1. Autentikasi (A)
**File**: `TEST_SCENARIOS_AUTH.md`

#### A1. Registrasi User (9 test cases)
- A1.1 - Registrasi Berhasil
- A1.2 - Password Tidak Cocok
- A1.3 - Password < 6 Karakter
- A1.4 - Username Duplikat
- A1.5 - Email Duplikat
- A1.6 - SQL Injection
- A1.7 - XSS Attempt
- A1.8 - Form Kosong
- A1.9 - Email Format Validation

#### A2. Login Multi-Role (10 test cases)
- A2.1 - Login User Berhasil
- A2.2 - Login Admin Berhasil
- A2.3 - Login dengan Email
- A2.4 - Username Tidak Terdaftar
- A2.5 - Password Salah
- A2.6 - SQL Injection
- A2.7 - XSS Attempt
- A2.8 - Form Kosong
- A2.9 - real_escape_string Review
- A2.10 - Session Security

---

### 2. Halaman Publik (B)
**File**: `TEST_SCENARIOS_PUBLIC.md`

#### B1. Beranda (5 test cases)
- B1.1 - Hero Section
- B1.2 - Navigation Menu
- B1.3 - Mobile Menu
- B1.4 - Footer
- B1.5 - Responsive Design

#### B2. Menu (10 test cases)
- B2.1 - Dropdown Kategori
- B2.2 - Dropdown Items
- B2.3 - Filter Makanan
- B2.4 - Filter Minuman
- B2.5 - Filter Dessert
- B2.6 - Filter Snack
- B2.7 - Hover Effect
- B2.8 - Responsive Grid
- B2.9 - Navigation
- B2.10 - Menu Data Review (Architecture Issue)

#### B3. Kontak/Pesan (10 test cases)
- B3.1 - Form Kontak
- B3.2 - Kirim Pesan (Login)
- B3.3 - Kirim Pesan (No Login)
- B3.4 - Form Kosong
- B3.5 - SQL Injection
- B3.6 - XSS Pesan (Security Concern)
- B3.7 - Email Validation
- B3.8 - Google Maps
- B3.9 - Navigation
- B3.10 - Responsive

---

### 3. Admin Dashboard (C)
**File**: `TEST_SCENARIOS_ADMIN.md`

#### C1. Dashboard Admin (11 test cases)
- C1.1 - Akses sebagai Admin
- C1.2 - Akses sebagai User
- C1.3 - Akses Tanpa Login
- C1.4 - Statistik Total Sales
- C1.5 - Statistik Total Order
- C1.6 - Statistik New Customers
- C1.7 - Tabel Profit Bulanan
- C1.8 - Badge Unread Messages
- C1.9 - Sidebar Navigation
- C1.10 - Responsive Design
- C1.11 - SQL Injection Query (Code Review)

#### C2. Chat Management (10 test cases)
- C2.1 - Daftar User
- C2.2 - Pilih User
- C2.3 - Tampil Pesan
- C2.4 - Mark as Read (Security Concern)
- C2.5 - Kirim Pesan
- C2.6 - Auto Refresh
- C2.7 - Auto Scroll
- C2.8 - SQL Injection user_id
- C2.9 - XSS Pesan
- C2.10 - No Chat Selected

#### C3. Profit Management (6 test cases)
- C3.1 - Tampil Data Profit
- C3.2 - Update Profit
- C3.3 - Profit Negatif (Bug Found)
- C3.4 - Profit Sangat Besar
- C3.5 - SQL Injection Profit
- C3.6 - Query Variable Interpolation (Code Review)

#### C4. Rating & Komentar (6 test cases)
- C4.1 - Rating Statistics
- C4.2 - Rating Cards
- C4.3 - Hapus Rating (Security Concern + Bug)
- C4.4 - SQL Injection Delete
- C4.5 - XSS Username/Comment
- C4.6 - Responsive Grid

---

### 4. Integration Testing (I)
**File**: `TEST_SCENARIOS_INTEGRATION.md`

#### I1. End-to-End User Flow (3 test cases)
- I1.1 - Flow Lengkap E2E (Critical)
- I1.2 - Cross-Page Navigation (High)
- I1.3 - Admin Dashboard Navigation (High)

#### I2. Session Persistence (3 test cases)
- I2.1 - Session Persistence Across Pages (High)
- I2.2 - Session Timeout (Medium) - Feature Missing
- I2.3 - Concurrent Session (Medium)

#### I3. Data Consistency (3 test cases)
- I3.1 - Chat Message Consistency (Critical)
- I3.2 - Profit Data Consistency (High)
- I3.3 - User Registration Stats (Medium)

#### I4. Multi-User Scenarios (2 test cases)
- I4.1 - Multiple Users Messages (High)
- I4.2 - Admin Response Multiple Users (High)

#### I5. Role-Based Access Integration (3 test cases)
- I5.1 - User Role Access Control (Critical)
- I5.2 - Admin Role Access Control (Critical)
- I5.3 - Unauthenticated Access (Critical)

---

### 5. Error Handling (E)
**File**: `TEST_SCENARIOS_ERROR_HANDLING.md`

#### E1. Database Connection Errors (2 test cases)
- E1.1 - Database Connection Failure (Critical) - Security Concern
- E1.2 - Database Connection Timeout (Medium)

#### E2. Empty Database States (5 test cases)
- E2.1 - Empty Users Table (High)
- E2.2 - Empty Chat Messages (Medium)
- E2.3 - Empty Orders Table (Medium)
- E2.4 - Empty Monthly Profits (Medium)
- E2.5 - Empty Ratings Table (Medium)

#### E3. Invalid Data Formats (4 test cases)
- E3.1 - Invalid Email Format (High) - Issue
- E3.2 - Invalid Password Format (High)
- E3.3 - Invalid Profit Value (Medium) - Bug Found
- E3.4 - Invalid user_id (High)

#### E4. Concurrent Access Scenarios (3 test cases)
- E4.1 - Multiple Admin Update (Medium) - Feature Missing
- E4.2 - User Send While Admin View (Medium)
- E4.3 - Multiple Users Register (Low)

#### E5. Boundary Conditions (3 test cases)
- E5.1 - Maximum Username Length (Medium)
- E5.2 - Maximum Message Length (Medium)
- E5.3 - Special Characters (High)

#### E6. Missing Files/Resources (2 test cases)
- E6.1 - Missing config.php (Critical)
- E6.2 - Missing Image Files (Low)

#### E7. SQL Query Errors (2 test cases)
- E7.1 - Invalid SQL Query (High) - Code Review
- E7.2 - Foreign Key Violation (High) - Issue

---

### 6. Security Testing (S)
**File**: `TEST_SCENARIOS_SECURITY.md`

#### S1. CSRF Protection (3 test cases)
- S1.1 - CSRF Login (Critical) - Vulnerability
- S1.2 - CSRF Registration (Critical) - Vulnerability
- S1.3 - CSRF Admin Actions (Critical) - Vulnerability

#### S2. Session Security (4 test cases)
- S2.1 - Session Hijacking (Critical) - Review
- S2.2 - Session Fixation (High) - Vulnerability
- S2.3 - Session Timeout (High) - Feature Missing
- S2.4 - Concurrent Session (Medium) - Policy Decision

#### S3. Direct URL Access (3 test cases)
- S3.1 - Direct Access Admin (Critical)
- S3.2 - Invalid Session (High)
- S3.3 - Expired Session (High)

#### S4. Input Validation & Sanitization (4 test cases)
- S4.1 - SQL Injection (Critical)
- S4.2 - XSS All Output (Critical) - Issue
- S4.3 - Path Traversal (Medium)
- S4.4 - Command Injection (High)

#### S5. Authentication & Authorization (4 test cases)
- S5.1 - Brute Force (High) - Vulnerability
- S5.2 - Password Policy (Medium) - Enhancement
- S5.3 - Role Escalation (Critical) - Issue
- S5.4 - Session After Logout (High)

#### S6. Data Exposure (3 test cases)
- S6.1 - Info Disclosure (High) - Concern
- S6.2 - Sensitive Data URL (Medium)
- S6.3 - Directory Listing (Low)

#### S7. File Upload Vulnerabilities (1 test case)
- S7.1 - File Upload (High) - Review

---

## Issues Summary

### Critical Issues
1. **CSRF Protection** - Belum diimplementasi (3 locations)
2. **Session Fixation** - Session regeneration belum diimplementasi
3. **Role Escalation** - Perlu verifikasi server-side validation
4. **Query Variable Interpolation** - 5 locations perlu prepared statements

### High Priority Issues
1. **Brute Force Protection** - Rate limiting belum ada
2. **Session Timeout** - Belum diimplementasi
3. **Error Messages** - Mungkin expose sensitive information
4. **XSS Output Escaping** - Perlu verifikasi semua output

### Medium Priority Issues
1. **Profit Validation** - Bisa di-set negatif (bug)
2. **Concurrent Update** - Perlu handling untuk multiple admin
3. **Password Policy** - Bisa diperkuat
4. **Server-Side Email Validation** - Perlu implementasi

### Architecture Issues
1. **Menu Hardcoded** - Data menu di JavaScript, perlu database integration
2. **Email Field Redundant** - Di form pesan, user_id sudah dari session

### Code Quality Issues
1. **Redundant real_escape_string()** - Tidak diperlukan jika sudah prepared statement
2. **File Name Mismatch** - `rating.php` redirect ke `ratings.php`
3. **Error Handling** - Perlu review di semua query

---

## Test Execution Priority

### Phase 1: Critical Security Tests (Must Do First)
- All CSRF tests (S1.1, S1.2, S1.3)
- Role escalation (S5.3)
- Direct access tests (S3.1, S3.2, S3.3)
- SQL injection tests (S4.1, A1.6, A2.6, B3.5, C2.8, C3.5, C4.4)
- XSS tests (S4.2, A1.7, A2.7, B3.6, C2.9, C4.5)

### Phase 2: Core Functionality Tests
- Authentication flow (A1.1, A2.1, A2.2)
- Admin dashboard access (C1.1, C1.2, C1.3)
- Chat functionality (C2.1-C2.10)
- Integration E2E flow (I1.1)

### Phase 3: Error Handling Tests
- Database connection errors (E1.1, E1.2)
- Empty states (E2.1-E2.5)
- Invalid data formats (E3.1-E3.4)

### Phase 4: Edge Cases & Performance
- Boundary conditions (E5.1-E5.3)
- Concurrent access (E4.1-E4.3)
- Session management (I2.1-I2.3, S2.1-S2.4)

---

## Test Data Requirements

### Prerequisites
1. Database `admin_login_system` dengan semua tabel:
   - `users`
   - `chat_messages`
   - `orders`
   - `monthly_profits`
   - `ratings`

2. Test Users:
   - Admin user: `admin` / `admin123` (role: 'admin')
   - Regular user: `testuser` / `password123` (role: 'user')
   - Multiple test users untuk multi-user scenarios

3. Test Data:
   - Sample orders untuk dashboard stats
   - Sample chat messages
   - Sample ratings
   - Monthly profits data

### Test Environment
- PHP 7.4+ dengan MySQL
- Web server (Apache/Nginx)
- Browser untuk manual testing
- Database access untuk verification

---

## References

- **Autentikasi**: `TEST_SCENARIOS_AUTH.md`
- **Halaman Publik**: `TEST_SCENARIOS_PUBLIC.md`
- **Admin Dashboard**: `TEST_SCENARIOS_ADMIN.md`
- **Integration Testing**: `TEST_SCENARIOS_INTEGRATION.md`
- **Error Handling**: `TEST_SCENARIOS_ERROR_HANDLING.md`
- **Security Testing**: `TEST_SCENARIOS_SECURITY.md`

---

**Last Updated**: 2025-01-XX
**Total Test Cases**: 142
**Status**: Ready for Execution



