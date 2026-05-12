# Zero-Day Stealth API Guide

A professional, secure, and lean backend solution for database connection monitoring, provisioning tests, and server health checks. This API is designed to be invisible to search engines while providing robust data to authorized users.

---

## Table of Contents

1. [Overview](#-overview)
2. [Installation &amp; Setup](#-installation--setup)
3. [Security Configuration](#-security-configuration)
4. [API Usage (POST Parameters)](#-api-usage)
5. [Using Postman (Step-by-Step)](#-using-postman-step-by-step)
6. [CLI Usage (cURL)](#-cli-usage-curl)
7. [Stealth Features](#-stealth-features)
8. [Troubleshooting](#-troubleshooting)

---

## Overview

Zero-Day Stealth API allows you to remotely verify MariaDB/MySQL connections. It provides:

- **Instant Status**: See if a database is Online or Offline.
- **Data Insights**: Table counts and available database lists.
- **Stealth**: Hidden from Google/Bing via robots.txt and server headers.
- **Logging**: All events and failures are recorded in private local logs.

---

## Installation & Setup

1. **Clone the Project**:
   ```bash
   git clone https://github.com/Asadullah-nadeem/Zero-Day-Stealth.git
   ```
2. **Configure Database**:
   Open `config.php` and enter your master server details:
   - `DB_HOST`: Your server IP (e.g., `193.203.160.173`)
   - `DB_USER` & `DB_PASS`: Your master login.
   - `DB_PREFIX`: Your cPanel prefix (e.g., `codeabwwro_`).
3. **Set your API Key**:
   Change `MANAGE_PASSWORD` to a strong secret key.

---

## Security Configuration

The API is hardened by default:

- **IP Whitelisting**: Edit `ALLOWED_IPS` in `config.php` to restrict access.
- **Strict Mode**: Set `STRICT_IP_CHECK` to `true` to block any IP not in your whitelist.
- **Log Access**: The `.htaccess` file prevents anyone from downloading your logs or viewing your config.

---

## API Usage

All requests must be sent via **HTTP POST**.

### Request Body (Form Data):

| Key         | Description                                        | Required      |
| :---------- | :------------------------------------------------- | :------------ |
| `api_key` | Your `MANAGE_PASSWORD` defined in `config.php` | **YES** |
| `dbname`  | The database name you want to test                 | NO            |
| `host`    | Override host for dynamic testing                  | NO            |
| `user`    | Override username for dynamic testing              | NO            |
| `pass`    | Override password for dynamic testing              | NO            |
| `port`    | Override port (default 3306)                       | NO            |

---

## Using Postman (Step-by-Step)

Follow these steps to test your API using [Postman](https://www.postman.com/):

1. **Create Request**: Open Postman and click `New` -> `HTTP Request`.
2. **Method**: Set the method to **`POST`**.
3. **URL**: Enter your API URL (e.g., `https://zero.codeaxe.co.in/api.php`).
4. **Body Tab**:
   - Click on the **`Body`** tab.
   - Select **`x-www-form-urlencoded`**.
5. **Enter Data**:
   - Key: `api_key` | Value: `YOUR_SECURE_PASSWORD`
   - Key: `dbname` | Value: `your_db_name`
6. **Send**: Click the **`Send`** button.
7. **Result**: You will receive a JSON response showing the `db_status` and metadata.

---

## CLI Usage (cURL)

For quick testing directly from your terminal:

```bash
# Basic Check
curl -X POST https://zero.codeaxe.co.in/api.php -d "api_key=YOUR_KEY"

# Database Specific Check
curl -X POST https://zero.codeaxe.co.in/api.php \
     -d "api_key=YOUR_KEY" \
     -d "dbname=codeabwwro_app"
```

---

## Stealth Features

- **robots.txt**: Blocks all search engine indexing.
- **X-Robots-Tag**: Server-side header to prevent caching and snippets.
- **Forbidden Index**: Visiting the root folder displays a 403 error page.
- **Silent Errors**: No technical errors are ever shown in the browser.

---

## Troubleshooting

- **401 Unauthorized**: Your `api_key` is incorrect or missing.
- **403 Forbidden**: Your IP is not whitelisted, or you are trying to view a protected file.
- **500 Error**: Check `logs/api_errors.log` for the exact database connection failure reason.
- **Empty Response**: Ensure PHP is running and `PDO` extensions are enabled on your server.
