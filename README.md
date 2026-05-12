# Zero-Day Database API Documentation

A professional, secure, and lean PHP-based API for testing database connections and monitoring status via JSON.

## Features

- **JSON Response**: Clean and structured data for easy parsing.
- **Security**: Protected via API Key authentication.
- **Flexibility**: Supports connection testing with default config or dynamic overrides.
- **CLI Ready**: Optimized for terminal use with `curl`.

---

## Project Structure

- `api.php` - The main entry point for API requests.
- `config.php` - Secure storage for database credentials and the API key.
- `includes/Database.php` - Core PDO wrapper class.
- `test_api.bat` - Windows CLI script for quick testing.

---

## Authentication

All requests must include the `api_key` parameter.

- **Default Key**: `zero_day_2026` (Configurable in `config.php` via `MANAGE_PASSWORD`).

---

## API Reference

### Test Connection / Get Status

**Endpoint:** `POST /api.php`

**Parameters (POST):**

| Parameter   | Description                 | Required      | Default       |
| :---------- | :-------------------------- | :------------ | :------------ |
| `api_key` | Security key for access     | **Yes** | -             |
| `dbname`  | Specific database to check  | No            | null          |
| `host`    | Database server IP/Hostname | No            | (From config) |
| `user`    | Database username           | No            | (From config) |
| `pass`    | Database password           | No            | (From config) |

---

## CLI Usage Examples

### 1. Basic Status Check (Using Config Defaults)

```bash
curl -X POST https://zero.codeaxe.co.in/api.php \
     -d "api_key=zero_day_2026"
```

### 2. Check Specific Database & Table Count

```bash
curl -X POST https://zero.codeaxe.co.in/api.php \
     -d "api_key=zero_day_2026" \
     -d "dbname=codeabwwro_test"
```

### 3. Test Remote Server Connection

```bash
curl -X POST https://zero.codeaxe.co.in/api.php \
     -d "api_key=zero_day_2026" \
     -d "host=127.0.0.1" \
     -d "user=root" \
     -d "pass=secret"
```

---

## JSON Response Format

### Success Response

```json
{
    "status": "success",
    "timestamp": "2026-05-12 12:45:00",
    "db_status": "Online",
    "message": "Database connection established successfully.",
    "database": {
        "name": "codeabwwro",
        "table_count": 12
    }
}
```

### Error Response

```json
{
    "status": "error",
    "db_status": "Offline",
    "message": "Connection failed: SQLSTATE[HY000] [1045] Access denied for user..."
}
```

---

## Setup & Configuration

1. Edit `config.php` to set your master credentials.
2. Change `MANAGE_PASSWORD` to a more secure value for production.
3. Ensure `includes/Database.php` is present for core functionality.
