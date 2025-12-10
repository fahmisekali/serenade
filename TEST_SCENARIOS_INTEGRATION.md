# Skenario Uji Integration Testing - pjbl (Kedai Serenade)

## I1. End-to-End User Flow

### Test Case 1: Flow Lengkap Registrasi → Login → Kirim Pesan → Admin Response
**Priority**: Critical

**Prerequisites**: 
- Database `admin_login_system` tersedia dengan semua tabel
- Admin user sudah terdaftar dengan role `'admin'`

**Steps**:
1. Buka `register.php`
2. Daftar user baru:
   - Username: `testuser1`
   - Email: `testuser1@example.com`
   - Password: `password123`
   - Konfirmasi Password: `password123`
3. Klik "Daftar"
4. Setelah redirect ke login, login dengan user yang baru dibuat
5. Navigate ke `page-pesan/index.php`
6. Kirim pesan: "Halo, saya ingin bertanya tentang menu"
7. Login sebagai admin di browser/incognito window lain
8. Buka `admin/chat.php`
9. Pilih user `testuser1` dari list
10. Balas pesan: "Terima kasih, ada yang bisa dibantu?"

**Expected Results**:
- ✅ Registrasi berhasil dan redirect ke login
- ✅ Login berhasil dan redirect ke `page-beranda/index.php`
- ✅ Pesan user tersimpan di database dengan `sender_role = 'user'`
- ✅ Admin melihat pesan di chat list dengan unread badge
- ✅ Admin bisa membalas pesan
- ✅ Pesan admin tersimpan dengan `sender_role = 'admin'`
- ✅ User bisa melihat balasan (jika ada halaman untuk user melihat chat)
- ✅ Semua data konsisten di database

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Cross-Page Navigation Flow
**Priority**: High

**Steps**:
1. Login sebagai user biasa
2. Navigate melalui semua halaman:
   - `page-beranda/index.php` → `page-tentang/index.php` → `page-menu/index.php` → `page-pesan/index.php`
3. Klik semua link di navigation menu
4. Cek session tetap aktif di semua halaman

**Expected Results**:
- ✅ Session tetap aktif di semua halaman
- ✅ Navigation links berfungsi dengan benar
- ✅ Tidak ada redirect ke login page
- ✅ User info tetap tersimpan di session

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Admin Dashboard Navigation Flow
**Priority**: High

**Prerequisites**: Admin sudah login

**Steps**:
1. Login sebagai admin
2. Navigate melalui semua admin pages:
   - `admin/dashboard.php` → `admin/rating.php` → `admin/chat.php` → `admin/profits.php`
3. Klik semua menu di sidebar
4. Klik logout button

**Expected Results**:
- ✅ Semua admin pages accessible
- ✅ Sidebar navigation berfungsi
- ✅ Session tetap aktif di semua admin pages
- ✅ Logout berhasil dan redirect ke login
- ✅ Tidak bisa akses admin pages setelah logout

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## I2. Session Persistence

### Test Case 1: Session Persistence Across Pages
**Priority**: High

**Steps**:
1. Login sebagai user
2. Buka `page-beranda/index.php`
3. Buka tab baru, akses `page-menu/index.php`
4. Buka tab baru lagi, akses `page-pesan/index.php`
5. Cek session di semua tab

**Expected Results**:
- ✅ Session aktif di semua tab
- ✅ Tidak perlu login ulang
- ✅ User info konsisten di semua tab

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Session Timeout
**Priority**: Medium

**Steps**:
1. Login sebagai user
2. Biarkan browser idle untuk waktu lama (simulasi timeout)
3. Coba akses halaman yang memerlukan login

**Expected Results**:
- ⚠️ **ISSUE**: Perlu implementasi session timeout
- ⚠️ Session seharusnya expire setelah waktu tertentu
- ⚠️ User harus login ulang setelah timeout

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: **Feature Missing**: Session timeout belum diimplementasi

---

### Test Case 3: Concurrent Session (Multiple Devices)
**Priority**: Medium

**Steps**:
1. Login sebagai user di browser A
2. Login sebagai user yang sama di browser B (atau device lain)
3. Lakukan action di browser A
4. Cek session di browser B

**Expected Results**:
- ✅ Session bisa aktif di multiple devices
- ✅ Action di satu device tidak mempengaruhi session di device lain
- ⚠️ **SECURITY CONCERN**: Perlu validasi apakah ini diinginkan atau perlu single session enforcement

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## I3. Data Consistency

### Test Case 1: Chat Message Consistency
**Priority**: Critical

**Steps**:
1. User A kirim pesan ke admin
2. Admin lihat pesan di `admin/chat.php`
3. Admin balas pesan
4. Cek data di database:
   - `chat_messages` table
   - Foreign key `user_id` valid
   - `sender_role` konsisten
   - `is_read` status

**Expected Results**:
- ✅ Semua pesan tersimpan dengan benar
- ✅ Foreign key `user_id` valid (user exists)
- ✅ `sender_role` sesuai (user/admin)
- ✅ `is_read` update dengan benar saat admin melihat
- ✅ Timestamps konsisten

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Profit Data Consistency
**Priority**: High

**Steps**:
1. Admin update profit untuk bulan Januari di `admin/profits.php`
2. Cek profit di `admin/dashboard.php`
3. Verifikasi total profit dihitung dengan benar

**Expected Results**:
- ✅ Profit update tersimpan di database
- ✅ Dashboard menampilkan profit yang sudah diupdate
- ✅ Total profit dihitung dengan benar (sum dari semua bulan)
- ✅ Data konsisten di semua halaman

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: User Registration → Dashboard Stats
**Priority**: Medium

**Steps**:
1. Daftar user baru
2. Login sebagai admin
3. Cek "New Customers" stat di dashboard
4. Verifikasi count bertambah

**Expected Results**:
- ✅ User baru terhitung di statistik "New Customers"
- ✅ Query menghitung dengan benar (bulan dan tahun saat ini)
- ✅ Statistik update real-time

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## I4. Multi-User Scenarios

### Test Case 1: Multiple Users Send Messages
**Priority**: High

**Steps**:
1. User A kirim pesan ke admin
2. User B kirim pesan ke admin
3. User C kirim pesan ke admin
4. Admin buka `admin/chat.php`
5. Cek user list

**Expected Results**:
- ✅ Semua user muncul di list
- ✅ Unread count badge akurat untuk setiap user
- ✅ User diurutkan berdasarkan last message time
- ✅ Admin bisa chat dengan semua user secara terpisah

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Admin Response to Multiple Users
**Priority**: High

**Steps**:
1. User A dan User B kirim pesan
2. Admin balas User A
3. Admin balas User B
4. Cek pesan di database

**Expected Results**:
- ✅ Pesan admin ke User A tersimpan dengan `user_id` User A
- ✅ Pesan admin ke User B tersimpan dengan `user_id` User B
- ✅ Tidak ada cross-contamination pesan
- ✅ Chat history terpisah untuk setiap user

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## I5. Role-Based Access Integration

### Test Case 1: User Role Access Control
**Priority**: Critical

**Steps**:
1. Login sebagai user biasa
2. Coba akses `admin/dashboard.php` langsung via URL
3. Coba akses `admin/chat.php` langsung via URL
4. Coba akses `admin/profits.php` langsung via URL
5. Coba akses `admin/rating.php` langsung via URL

**Expected Results**:
- ✅ Semua admin pages redirect ke `login.php`
- ✅ User tidak bisa akses admin area
- ✅ Access control bekerja dengan benar

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 2: Admin Role Access Control
**Priority**: Critical

**Steps**:
1. Login sebagai admin
2. Akses semua admin pages
3. Akses public pages
4. Cek apakah admin bisa akses semua area

**Expected Results**:
- ✅ Admin bisa akses semua admin pages
- ✅ Admin bisa akses public pages
- ✅ Admin memiliki akses penuh

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

### Test Case 3: Unauthenticated Access
**Priority**: Critical

**Steps**:
1. Logout atau clear session
2. Coba akses `admin/dashboard.php`
3. Coba akses `page-pesan/index.php` dan submit form
4. Coba akses `admin/chat.php`

**Expected Results**:
- ✅ Admin pages redirect ke login
- ✅ Form pesan tidak bisa submit tanpa login
- ✅ Access control mencegah unauthorized access

**Actual Results**: 
- [ ] Pass / [ ] Fail
- **Notes**: 

---

## Test Summary

| Test Case | Priority | Status | Notes |
|-----------|----------|--------|-------|
| I1.1 - Flow Lengkap E2E | Critical | [ ] | |
| I1.2 - Cross-Page Navigation | High | [ ] | |
| I1.3 - Admin Dashboard Navigation | High | [ ] | |
| I2.1 - Session Persistence | High | [ ] | |
| I2.2 - Session Timeout | Medium | [ ] | **Feature Missing** |
| I2.3 - Concurrent Session | Medium | [ ] | |
| I3.1 - Chat Message Consistency | Critical | [ ] | |
| I3.2 - Profit Data Consistency | High | [ ] | |
| I3.3 - User Registration Stats | Medium | [ ] | |
| I4.1 - Multiple Users Messages | High | [ ] | |
| I4.2 - Admin Response Multiple Users | High | [ ] | |
| I5.1 - User Role Access Control | Critical | [ ] | |
| I5.2 - Admin Role Access Control | Critical | [ ] | |
| I5.3 - Unauthenticated Access | Critical | [ ] | |

**Total Test Cases**: 15
**Passed**: 0
**Failed**: 0
**Not Tested**: 15

**Issues Found**:
- Feature Missing: Session timeout belum diimplementasi
- Security Concern: Concurrent session policy perlu ditentukan



