# Test Execution Checklist - Proyek Kedai Serenade

## Pre-Testing Setup

### Environment Preparation
- [ ] Database `admin_login_system` sudah dibuat
- [ ] Semua tabel sudah dibuat:
  - [ ] `users`
  - [ ] `chat_messages`
  - [ ] `orders`
  - [ ] `monthly_profits`
  - [ ] `ratings`
- [ ] Web server (Apache/Nginx) running
- [ ] PHP version 7.4+ installed
- [ ] MySQL/MariaDB running
- [ ] `config.php` dikonfigurasi dengan benar

### Test Data Setup
- [ ] Admin user dibuat: `admin` / `admin123` (role: 'admin')
- [ ] Test user dibuat: `testuser` / `password123` (role: 'user')
- [ ] Sample orders data untuk dashboard testing
- [ ] Sample chat messages untuk chat testing
- [ ] Sample ratings untuk rating testing
- [ ] Monthly profits data untuk profit testing

### Tools Preparation
- [ ] Browser untuk manual testing (Chrome/Firefox)
- [ ] Browser DevTools untuk inspect
- [ ] Database client untuk verify data (phpMyAdmin/MySQL Workbench)
- [ ] Text editor untuk notes
- [ ] Screenshot tool untuk dokumentasi bugs

---

## Test Execution Phases

### Phase 1: Critical Security Tests ⚠️

#### CSRF Protection Tests
- [ ] **S1.1** - CSRF Attack on Login Form
- [ ] **S1.2** - CSRF Attack on Registration Form
- [ ] **S1.3** - CSRF Attack on Admin Actions

#### Authentication & Authorization
- [ ] **S5.3** - Role Escalation Test
- [ ] **S3.1** - Direct Access to Admin Pages
- [ ] **S3.2** - Direct Access with Invalid Session
- [ ] **S3.3** - Direct Access with Expired Session
- [ ] **S5.4** - Session After Logout

#### SQL Injection Tests
- [ ] **S4.1** - SQL Injection All Input Fields
- [ ] **A1.6** - SQL Injection on Registration
- [ ] **A2.6** - SQL Injection on Login
- [ ] **B3.5** - SQL Injection on Chat Message
- [ ] **C2.8** - SQL Injection on user_id
- [ ] **C3.5** - SQL Injection on Profit Value
- [ ] **C4.4** - SQL Injection on Delete Rating

#### XSS Tests
- [ ] **S4.2** - XSS All Output
- [ ] **A1.7** - XSS on Registration
- [ ] **A2.7** - XSS on Login
- [ ] **B3.6** - XSS on Chat Message
- [ ] **C2.9** - XSS on Chat Display
- [ ] **C4.5** - XSS on Rating Comment

**Phase 1 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 2: Core Functionality Tests

#### Authentication Flow
- [ ] **A1.1** - Registrasi Berhasil
- [ ] **A1.2** - Password Tidak Cocok
- [ ] **A1.3** - Password < 6 Karakter
- [ ] **A1.4** - Username Duplikat
- [ ] **A1.5** - Email Duplikat
- [ ] **A2.1** - Login User Berhasil
- [ ] **A2.2** - Login Admin Berhasil
- [ ] **A2.3** - Login dengan Email
- [ ] **A2.4** - Username Tidak Terdaftar
- [ ] **A2.5** - Password Salah

#### Admin Dashboard Access
- [ ] **C1.1** - Akses Dashboard sebagai Admin
- [ ] **C1.2** - Akses Dashboard sebagai User
- [ ] **C1.3** - Akses Dashboard Tanpa Login
- [ ] **C1.4** - Statistik Total Sales
- [ ] **C1.5** - Statistik Total Order
- [ ] **C1.6** - Statistik New Customers
- [ ] **C1.7** - Tabel Profit Bulanan
- [ ] **C1.8** - Badge Unread Messages

#### Chat Functionality
- [ ] **C2.1** - Daftar User yang Mengirim Pesan
- [ ] **C2.2** - Pilih User untuk Chat
- [ ] **C2.3** - Menampilkan Pesan Chat
- [ ] **C2.4** - Mark Messages as Read
- [ ] **C2.5** - Kirim Pesan sebagai Admin
- [ ] **C2.6** - Auto Refresh Chat
- [ ] **C2.7** - Auto Scroll to Bottom
- [ ] **C2.10** - No Chat Selected

#### Public Pages
- [ ] **B1.1** - Hero Section
- [ ] **B1.2** - Navigation Menu
- [ ] **B2.1** - Dropdown Kategori Menu
- [ ] **B2.3-B2.6** - Filter Menu by Category
- [ ] **B3.1** - Form Kontak
- [ ] **B3.2** - Kirim Pesan (User Login)

**Phase 2 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 3: Integration & E2E Tests

#### End-to-End Flow
- [ ] **I1.1** - Flow Lengkap E2E (Register → Login → Send Message → Admin Response)
- [ ] **I1.2** - Cross-Page Navigation Flow
- [ ] **I1.3** - Admin Dashboard Navigation Flow

#### Session Management
- [ ] **I2.1** - Session Persistence Across Pages
- [ ] **I2.2** - Session Timeout
- [ ] **I2.3** - Concurrent Session
- [ ] **S2.1** - Session Hijacking Prevention
- [ ] **S2.2** - Session Fixation
- [ ] **S2.3** - Session Timeout

#### Data Consistency
- [ ] **I3.1** - Chat Message Consistency
- [ ] **I3.2** - Profit Data Consistency
- [ ] **I3.3** - User Registration Stats

#### Multi-User Scenarios
- [ ] **I4.1** - Multiple Users Send Messages
- [ ] **I4.2** - Admin Response to Multiple Users

#### Role-Based Access
- [ ] **I5.1** - User Role Access Control
- [ ] **I5.2** - Admin Role Access Control
- [ ] **I5.3** - Unauthenticated Access

**Phase 3 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 4: Error Handling Tests

#### Database Errors
- [ ] **E1.1** - Database Connection Failure
- [ ] **E1.2** - Database Connection Timeout
- [ ] **E6.1** - Missing config.php

#### Empty States
- [ ] **E2.1** - Empty Users Table
- [ ] **E2.2** - Empty Chat Messages
- [ ] **E2.3** - Empty Orders Table
- [ ] **E2.4** - Empty Monthly Profits
- [ ] **E2.5** - Empty Ratings Table

#### Invalid Data
- [ ] **E3.1** - Invalid Email Format
- [ ] **E3.2** - Invalid Password Format
- [ ] **E3.3** - Invalid Profit Value (Negative)
- [ ] **E3.4** - Invalid user_id in URL
- [ ] **A1.8** - Form Kosong (Registration)
- [ ] **A2.8** - Form Kosong (Login)
- [ ] **B3.4** - Form Kosong (Contact)

#### Concurrent Access
- [ ] **E4.1** - Multiple Admin Update Profit
- [ ] **E4.2** - User Send Message While Admin Viewing
- [ ] **E4.3** - Multiple Users Register Simultaneously

#### Boundary Conditions
- [ ] **E5.1** - Maximum Username Length
- [ ] **E5.2** - Maximum Message Length
- [ ] **E5.3** - Special Characters in Input

#### SQL Query Errors
- [ ] **E7.1** - Invalid SQL Query
- [ ] **E7.2** - Foreign Key Constraint Violation

**Phase 4 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 5: Additional Security Tests

#### Input Validation
- [ ] **S4.3** - Path Traversal
- [ ] **S4.4** - Command Injection
- [ ] **A1.9** - Email Format Validation
- [ ] **B3.7** - Email Validation (Contact Form)

#### Authentication Security
- [ ] **S5.1** - Brute Force Attack Prevention
- [ ] **S5.2** - Password Policy Enforcement

#### Data Exposure
- [ ] **S6.1** - Information Disclosure in Error Messages
- [ ] **S6.2** - Sensitive Data in URLs
- [ ] **S6.3** - Directory Listing

#### File Upload (If Applicable)
- [ ] **S7.1** - Malicious File Upload

**Phase 5 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 6: UI/UX & Responsive Tests

#### Responsive Design
- [ ] **B1.5** - Responsive Design (Beranda)
- [ ] **B2.8** - Responsive Grid Layout (Menu)
- [ ] **B3.10** - Responsive Design (Contact)
- [ ] **C1.10** - Responsive Design (Dashboard)
- [ ] **C4.6** - Responsive Grid Layout (Rating)

#### Navigation & UI
- [ ] **B1.3** - Mobile Menu (Hamburger)
- [ ] **B1.4** - Footer
- [ ] **B2.7** - Menu Card Hover Effect
- [ ] **B2.9** - Navigation Menu
- [ ] **B3.8** - Google Maps Embed
- [ ] **B3.9** - Navigation Menu
- [ ] **C1.9** - Sidebar Navigation

**Phase 6 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

### Phase 7: Admin Features Tests

#### Profit Management
- [ ] **C3.1** - Menampilkan Data Profit
- [ ] **C3.2** - Update Profit
- [ ] **C3.3** - Update Profit dengan Nilai Negatif (Bug)
- [ ] **C3.4** - Update Profit dengan Nilai Sangat Besar
- [ ] **C3.6** - Query dengan Variable Interpolation

#### Rating Management
- [ ] **C4.1** - Menampilkan Rating Statistics
- [ ] **C4.2** - Menampilkan Rating Cards
- [ ] **C4.3** - Hapus Rating (Bug: File name mismatch)
- [ ] **C4.6** - Responsive Grid Layout

#### Code Review Items
- [ ] **A2.9** - real_escape_string() Usage Review
- [ ] **C1.11** - SQL Injection pada Query (Dashboard)
- [ ] **B2.10** - Menu Data Hardcoded Review

**Phase 7 Status**: [ ] Complete / [ ] In Progress / [ ] Not Started

---

## Test Results Tracking

### Test Execution Log

| Test ID | Test Case | Priority | Status | Date | Tester | Notes |
|---------|-----------|----------|--------|------|--------|-------|
| | | | | | | |

### Issues Found

| Issue ID | Test Case | Severity | Description | Status |
|----------|-----------|----------|-------------|--------|
| | | | | |

### Bugs Found

| Bug ID | Test Case | Description | Steps to Reproduce | Status |
|--------|-----------|-------------|---------------------|--------|
| | | | | |

---

## Test Completion Criteria

### Must Pass (Critical)
- [ ] All CSRF protection tests
- [ ] All SQL injection tests
- [ ] All XSS tests
- [ ] Role-based access control tests
- [ ] Authentication flow tests

### Should Pass (High Priority)
- [ ] Core functionality tests
- [ ] Integration E2E tests
- [ ] Session management tests
- [ ] Error handling for critical errors

### Nice to Have (Medium/Low Priority)
- [ ] UI/UX tests
- [ ] Responsive design tests
- [ ] Edge cases
- [ ] Performance tests

---

## Test Environment Information

**Test Date**: _______________
**Tester Name**: _______________
**Environment**: 
- [ ] Development
- [ ] Staging
- [ ] Production

**Browser Used**:
- [ ] Chrome (Version: _____)
- [ ] Firefox (Version: _____)
- [ ] Safari (Version: _____)
- [ ] Edge (Version: _____)

**Database**:
- MySQL Version: _______________
- PHP Version: _______________

---

## Notes & Observations

### General Notes
_________________________________________________________________
_________________________________________________________________
_________________________________________________________________

### Known Issues
_________________________________________________________________
_________________________________________________________________
_________________________________________________________________

### Recommendations
_________________________________________________________________
_________________________________________________________________
_________________________________________________________________

---

**Test Execution Status**: [ ] Not Started / [ ] In Progress / [ ] Complete
**Overall Pass Rate**: _____%
**Critical Issues**: _____
**High Priority Issues**: _____
**Medium Priority Issues**: _____
**Low Priority Issues**: _____



