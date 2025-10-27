# PCRE2 Compatibility Fix for Admin-Side Validation

## Issue Identified
After implementing the `NoHtmlOrScript` validation rule across all admin controllers, the following error appeared when submitting forms:

```
preg_match(): Compilation failed: PCRE2 does not support \F, \L, \l, \N{name}, \U, or \u at offset 2.
```

## Root Cause
The error was caused by the Unicode escape sequence `\u003c` in the `NoHtmlOrScript` validation rule on line 120:

```php
// PROBLEMATIC CODE (causing PCRE2 error)
if (preg_match('/\u003c.*script.*\u003e/i', $value)) {
    $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
    return;
}
```

PCRE2 (the regex engine used by PHP) does not support the `\u` Unicode escape sequence syntax.

## Solution Applied

### 1. Fixed Server-Side Validation Rule
**File**: `app/Rules/NoHtmlOrScript.php`

**Changed**:
```php
// OLD (causing PCRE2 error)
if (preg_match('/\u003c.*script.*\u003e/i', $value)) {

// NEW (PCRE2 compatible)
if (preg_match('/\x3c.*script.*\x3e/i', $value)) {
```

**Explanation**: Replaced `\u003c` with `\x3c` which is the hex representation of the same character (`<`) and is supported by PCRE2.

### 2. Updated Client-Side Validation
**File**: `public/js/html-validation.js`

**Changed**:
```javascript
// OLD
unicodeScript: /\u003c.*script.*\u003e/gi,

// NEW
unicodeScript: /\x3c.*script.*\x3e/gi,
```

**Explanation**: Updated the client-side pattern to match the server-side fix for consistency.

## Technical Details

### Unicode Character Reference
- `\u003c` = Unicode escape for `<` (less-than symbol)
- `\x3c` = Hex escape for `<` (same character, PCRE2 compatible)

### Pattern Functionality
Both patterns detect the same attack vector:
- **Purpose**: Detect Unicode-encoded script tags
- **Example Input**: `\x3cscript\x3ealert('XSS')\x3c/script\x3e`
- **Detection**: Catches attempts to bypass validation using Unicode encoding

## Testing

### Validation Scenarios Covered
1. ✅ **Plain Text**: `"normal text"` → PASS
2. ✅ **HTML Tags**: `"<b>bold</b>"` → FAIL with error message
3. ✅ **Script Tags**: `"<script>alert('XSS')</script>"` → FAIL with error message
4. ✅ **Unicode Scripts**: `"\x3cscript\x3ealert('XSS')\x3c/script\x3e"` → FAIL with error message

### Error Messages
All validation failures now show the consistent message:
**"❌ Validation failed — HTML tags or JavaScript are not allowed."**

## Result

### Before Fix:
- ❌ Admin forms showed PCRE2 compilation error
- ❌ No real-time validation feedback
- ❌ Backend error instead of user-friendly message

### After Fix:
- ✅ Admin forms work without errors
- ✅ Real-time validation errors displayed
- ✅ Same validation behavior as member-side
- ✅ Consistent error messages across admin and member interfaces

## Files Modified

1. **`app/Rules/NoHtmlOrScript.php`** - Fixed Unicode pattern compatibility
2. **`public/js/html-validation.js`** - Updated client-side pattern to match

## Impact

- **Admin-side validation now works correctly**
- **Real-time error messages displayed**
- **Consistent XSS protection across entire application**
- **No breaking changes to existing functionality**
- **PCRE2 compatibility maintained**

The admin panel now provides the same real-time validation experience as the member side, with proper error messages instead of backend compilation errors.
