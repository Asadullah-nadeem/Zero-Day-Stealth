# Zero-Day Stealth API

A professional, secure, and lean backend for database connection monitoring.

## 🔐 Security Overview
- **Stealth Mode**: Hidden from search engines and public crawlers.
- **Authentication**: All endpoints require a cryptographically safe API Key.
- **Logging**: Detailed security and error logging (stored locally only).
- **Hardened**: Server-level protection against unauthorized access.

---

## 📡 API Usage

**Endpoint:** `https://zero.codeaxe.co.in/api.php` (Recommended: Rename this file for stealth)

**Authentication:** 
Must pass `api_key` in POST data.

### Example Usage (CLI):
```bash
curl -X POST https://zero.codeaxe.co.in/api.php \
     -d "api_key=YOUR_SECURE_KEY" \
     -d "dbname=your_database"
```

---

## 🛠️ Configuration
1. Setup your credentials in the local configuration file.
2. Define your `MANAGE_PASSWORD` (This is your API Key).
3. Whitelist authorized IPs in the security settings.
