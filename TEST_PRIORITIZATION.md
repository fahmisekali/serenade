# Test Prioritization - Proyek Kedai Serenade

## Priority Levels

- **Critical**: Must be tested before any release. Security vulnerabilities, data loss risks, core functionality failures.
- **High**: Should be tested before release. Important functionality, user experience issues.
- **Medium**: Nice to have before release. Edge cases, minor features.
- **Low**: Can be tested post-release or in future iterations. Nice-to-have features, optimizations.

---

## Critical Priority Tests (Must Do First)

### Security Tests
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| S1.1 | CSRF Attack on Login Form | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| S1.2 | CSRF Attack on Registration Form | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| S1.3 | CSRF Attack on Admin Actions | TEST_SCENARIOS_SECURITY.md | Admin login | 20 min |
| S4.1 | SQL Injection All Input Fields | TEST_SCENARIOS_SECURITY.md | None | 30 min |
| S4.2 | XSS All Output | TEST_SCENARIOS_SECURITY.md | User/Admin login | 30 min |
| S5.3 | Role Escalation | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S3.1 | Direct Access to Admin Pages | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| I5.1 | User Role Access Control | TEST_SCENARIOS_INTEGRATION.md | User login | 15 min |
| I5.2 | Admin Role Access Control | TEST_SCENARIOS_INTEGRATION.md | Admin login | 15 min |
| I5.3 | Unauthenticated Access | TEST_SCENARIOS_INTEGRATION.md | None | 15 min |

**Total Critical Security Tests**: 10 tests (~3 hours)

### Core Authentication Tests
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| A1.1 | Registrasi Berhasil | TEST_SCENARIOS_AUTH.md | None | 10 min |
| A2.1 | Login User Berhasil | TEST_SCENARIOS_AUTH.md | User registered | 10 min |
| A2.2 | Login Admin Berhasil | TEST_SCENARIOS_AUTH.md | Admin user exists | 10 min |
| A1.6 | SQL Injection on Registration | TEST_SCENARIOS_AUTH.md | None | 15 min |
| A2.6 | SQL Injection on Login | TEST_SCENARIOS_AUTH.md | None | 15 min |

**Total Critical Auth Tests**: 5 tests (~1 hour)

### Critical Error Handling
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| E1.1 | Database Connection Failure | TEST_SCENARIOS_ERROR_HANDLING.md | Database access | 20 min |
| E6.1 | Missing config.php | TEST_SCENARIOS_ERROR_HANDLING.md | File system access | 15 min |

**Total Critical Error Tests**: 2 tests (~35 min)

**Total Critical Priority**: 17 tests (~4.5 hours)

---

## High Priority Tests

### Integration & E2E Tests
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| I1.1 | Flow Lengkap E2E | TEST_SCENARIOS_INTEGRATION.md | User & Admin | 30 min |
| I3.1 | Chat Message Consistency | TEST_SCENARIOS_INTEGRATION.md | User & Admin | 20 min |
| I4.1 | Multiple Users Send Messages | TEST_SCENARIOS_INTEGRATION.md | Multiple users | 20 min |
| I4.2 | Admin Response Multiple Users | TEST_SCENARIOS_INTEGRATION.md | Multiple users, Admin | 20 min |

### Session Management
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| I2.1 | Session Persistence Across Pages | TEST_SCENARIOS_INTEGRATION.md | User login | 15 min |
| S2.2 | Session Fixation | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S2.3 | Session Timeout | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S5.4 | Session After Logout | TEST_SCENARIOS_SECURITY.md | User login | 15 min |

### Admin Functionality
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| C1.1 | Akses Dashboard sebagai Admin | TEST_SCENARIOS_ADMIN.md | Admin login | 10 min |
| C1.2 | Akses Dashboard sebagai User | TEST_SCENARIOS_ADMIN.md | User login | 10 min |
| C1.3 | Akses Dashboard Tanpa Login | TEST_SCENARIOS_ADMIN.md | None | 10 min |
| C2.1 | Daftar User yang Mengirim Pesan | TEST_SCENARIOS_ADMIN.md | Admin, Chat messages | 15 min |
| C2.5 | Kirim Pesan sebagai Admin | TEST_SCENARIOS_ADMIN.md | Admin, User with messages | 15 min |
| C3.2 | Update Profit | TEST_SCENARIOS_ADMIN.md | Admin, Profit data | 15 min |
| I3.2 | Profit Data Consistency | TEST_SCENARIOS_INTEGRATION.md | Admin, Profit data | 15 min |

### Error Handling
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| E2.1 | Empty Users Table | TEST_SCENARIOS_ERROR_HANDLING.md | Empty database | 15 min |
| E3.1 | Invalid Email Format | TEST_SCENARIOS_ERROR_HANDLING.md | None | 15 min |
| E3.2 | Invalid Password Format | TEST_SCENARIOS_ERROR_HANDLING.md | None | 15 min |
| E3.4 | Invalid user_id in URL | TEST_SCENARIOS_ERROR_HANDLING.md | Admin login | 15 min |
| E5.3 | Special Characters in Input | TEST_SCENARIOS_ERROR_HANDLING.md | User login | 20 min |
| E7.1 | Invalid SQL Query | TEST_SCENARIOS_ERROR_HANDLING.md | Code review | 20 min |
| E7.2 | Foreign Key Violation | TEST_SCENARIOS_ERROR_HANDLING.md | Database access | 20 min |

### Security (High Priority)
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| S2.1 | Session Hijacking Prevention | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S3.2 | Invalid Session | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| S3.3 | Expired Session | TEST_SCENARIOS_SECURITY.md | User login | 15 min |
| S4.4 | Command Injection | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S5.1 | Brute Force Attack Prevention | TEST_SCENARIOS_SECURITY.md | None | 20 min |
| S6.1 | Information Disclosure | TEST_SCENARIOS_SECURITY.md | Trigger errors | 20 min |

**Total High Priority**: 30 tests (~8 hours)

---

## Medium Priority Tests

### Public Pages
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| B1.1 | Hero Section | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B1.2 | Navigation Menu | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B2.1 | Dropdown Kategori | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B2.3-B2.6 | Filter Menu by Category | TEST_SCENARIOS_PUBLIC.md | None | 20 min |
| B3.1 | Form Kontak | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B3.2 | Kirim Pesan (User Login) | TEST_SCENARIOS_PUBLIC.md | User login | 15 min |

### Admin Features
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| C1.4-C1.6 | Dashboard Statistics | TEST_SCENARIOS_ADMIN.md | Admin, Test data | 30 min |
| C1.7 | Tabel Profit Bulanan | TEST_SCENARIOS_ADMIN.md | Admin, Profit data | 15 min |
| C1.8 | Badge Unread Messages | TEST_SCENARIOS_ADMIN.md | Admin, Unread messages | 15 min |
| C2.2-C2.4 | Chat Features | TEST_SCENARIOS_ADMIN.md | Admin, Chat messages | 30 min |
| C2.6-C2.7 | Chat Auto Features | TEST_SCENARIOS_ADMIN.md | Admin, Chat messages | 20 min |
| C3.1 | Menampilkan Data Profit | TEST_SCENARIOS_ADMIN.md | Admin, Profit data | 10 min |
| C4.1-C4.2 | Rating Display | TEST_SCENARIOS_ADMIN.md | Admin, Rating data | 20 min |

### Integration
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| I1.2 | Cross-Page Navigation | TEST_SCENARIOS_INTEGRATION.md | User login | 15 min |
| I1.3 | Admin Dashboard Navigation | TEST_SCENARIOS_INTEGRATION.md | Admin login | 15 min |
| I3.3 | User Registration Stats | TEST_SCENARIOS_INTEGRATION.md | Admin, New users | 15 min |

### Error Handling
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| E2.2-E2.5 | Empty Database States | TEST_SCENARIOS_ERROR_HANDLING.md | Empty tables | 40 min |
| E3.3 | Invalid Profit Value | TEST_SCENARIOS_ERROR_HANDLING.md | Admin | 15 min |
| E4.1 | Multiple Admin Update | TEST_SCENARIOS_ERROR_HANDLING.md | Multiple admin | 20 min |
| E4.2 | User Send While Admin View | TEST_SCENARIOS_ERROR_HANDLING.md | User, Admin | 20 min |
| E5.1-E5.2 | Boundary Conditions | TEST_SCENARIOS_ERROR_HANDLING.md | User login | 30 min |

### Security (Medium)
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| S2.4 | Concurrent Session | TEST_SCENARIOS_SECURITY.md | User login | 20 min |
| S4.3 | Path Traversal | TEST_SCENARIOS_SECURITY.md | None | 20 min |
| S5.2 | Password Policy | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| S6.2 | Sensitive Data in URLs | TEST_SCENARIOS_SECURITY.md | None | 15 min |

**Total Medium Priority**: 35 tests (~7 hours)

---

## Low Priority Tests

### UI/UX & Responsive
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| B1.3 | Mobile Menu | TEST_SCENARIOS_PUBLIC.md | None | 15 min |
| B1.4 | Footer | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B1.5 | Responsive Design | TEST_SCENARIOS_PUBLIC.md | None | 20 min |
| B2.7 | Menu Card Hover | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B2.8 | Responsive Grid | TEST_SCENARIOS_PUBLIC.md | None | 15 min |
| B2.9 | Navigation Menu | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B3.8 | Google Maps | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B3.9 | Navigation Menu | TEST_SCENARIOS_PUBLIC.md | None | 10 min |
| B3.10 | Responsive Design | TEST_SCENARIOS_PUBLIC.md | None | 20 min |
| C1.9 | Sidebar Navigation | TEST_SCENARIOS_ADMIN.md | Admin | 10 min |
| C1.10 | Responsive Design | TEST_SCENARIOS_ADMIN.md | Admin | 20 min |
| C4.6 | Responsive Grid | TEST_SCENARIOS_ADMIN.md | Admin | 15 min |

### Additional Tests
| Test ID | Test Case | File | Dependencies | Estimated Time |
|---------|-----------|------|--------------|----------------|
| A1.2-A1.5 | Registration Validation | TEST_SCENARIOS_AUTH.md | None | 30 min |
| A1.8-A1.9 | Form Validation | TEST_SCENARIOS_AUTH.md | None | 20 min |
| A2.3-A2.5 | Login Variations | TEST_SCENARIOS_AUTH.md | Test users | 30 min |
| A2.7-A2.8 | Login Validation | TEST_SCENARIOS_AUTH.md | None | 20 min |
| B3.3-B3.4 | Contact Form Validation | TEST_SCENARIOS_PUBLIC.md | None | 20 min |
| B3.5-B3.7 | Contact Security | TEST_SCENARIOS_PUBLIC.md | User login | 30 min |
| C2.10 | No Chat Selected | TEST_SCENARIOS_ADMIN.md | Admin | 10 min |
| C3.3-C3.4 | Profit Edge Cases | TEST_SCENARIOS_ADMIN.md | Admin | 20 min |
| C3.6 | Query Review | TEST_SCENARIOS_ADMIN.md | Code review | 15 min |
| C4.3 | Hapus Rating | TEST_SCENARIOS_ADMIN.md | Admin, Ratings | 15 min |
| E1.2 | Database Timeout | TEST_SCENARIOS_ERROR_HANDLING.md | Database | 20 min |
| E4.3 | Multiple Users Register | TEST_SCENARIOS_ERROR_HANDLING.md | None | 20 min |
| E6.2 | Missing Images | TEST_SCENARIOS_ERROR_HANDLING.md | File system | 15 min |
| I2.2-I2.3 | Session Edge Cases | TEST_SCENARIOS_INTEGRATION.md | User login | 30 min |
| S6.3 | Directory Listing | TEST_SCENARIOS_SECURITY.md | None | 15 min |
| S7.1 | File Upload | TEST_SCENARIOS_SECURITY.md | Review code | 20 min |

**Total Low Priority**: 40 tests (~7 hours)

---

## Test Dependencies

### Prerequisites for Testing
1. **Database Setup** (Required for all tests)
   - Database `admin_login_system` created
   - All tables created and populated with test data

2. **User Accounts** (Required for auth tests)
   - Admin user: `admin` / `admin123`
   - Regular user: `testuser` / `password123`
   - Multiple test users for multi-user scenarios

3. **Test Data** (Required for feature tests)
   - Sample orders for dashboard
   - Sample chat messages
   - Sample ratings
   - Monthly profits data

### Test Execution Order
1. **Phase 1**: Critical Security Tests (No dependencies, can run first)
2. **Phase 2**: Core Authentication (Requires database setup)
3. **Phase 3**: Integration Tests (Requires users and test data)
4. **Phase 4**: Error Handling (Requires database access)
5. **Phase 5**: Additional Security (Requires users)
6. **Phase 6**: UI/UX Tests (No dependencies)
7. **Phase 7**: Admin Features (Requires admin access and data)

---

## Estimated Time Summary

| Priority | Number of Tests | Estimated Time |
|----------|----------------|----------------|
| Critical | 17 | ~4.5 hours |
| High | 30 | ~8 hours |
| Medium | 35 | ~7 hours |
| Low | 40 | ~7 hours |
| **Total** | **122** | **~26.5 hours** |

**Note**: Some tests may overlap or be combined, reducing total time. Estimated time assumes manual testing. Automated testing would significantly reduce time.

---

## Risk Assessment

### High Risk Areas (Test First)
1. **Authentication & Authorization** - Critical for security
2. **SQL Injection & XSS** - Critical vulnerabilities
3. **CSRF Protection** - Critical security gap
4. **Role-Based Access** - Critical for data protection

### Medium Risk Areas
1. **Session Management** - Important for security
2. **Data Consistency** - Important for data integrity
3. **Error Handling** - Important for user experience

### Low Risk Areas
1. **UI/UX** - Nice to have, doesn't affect functionality
2. **Responsive Design** - Important but not critical
3. **Edge Cases** - Important but can be tested later

---

## Recommendations

1. **Start with Critical Tests**: Focus on security and core functionality first
2. **Automate Where Possible**: SQL injection, XSS, and CSRF tests can be automated
3. **Test in Phases**: Don't try to test everything at once
4. **Document Issues Immediately**: Track all bugs and vulnerabilities as found
5. **Re-test After Fixes**: Ensure fixes don't break other functionality

---

**Last Updated**: 2025-01-XX
**Total Test Cases**: 122 (prioritized)
**Estimated Total Time**: ~26.5 hours



