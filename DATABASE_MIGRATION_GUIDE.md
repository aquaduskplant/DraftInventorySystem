# Database Migration Guide: SQLite to MySQL

## Why Leave SQLite?

SQLite is great for prototyping, but it lacks critical features for a security-focused class project:
- ❌ No authentication/authorization at the DB level
- ❌ File-based storage (easy to steal if the host is compromised)
- ❌ Poor concurrency and no role-based access control
- ❌ Limited logging, auditing, and backup options

MySQL (or MariaDB) solves these issues with robust authentication, network encryption, replication, and rich tooling. The application now ships with MySQL as the default connection.

---

## Quick Migration Steps

### 1. Install MySQL

**Windows (Chocolatey):**
```powershell
choco install mysql
```

**macOS (Homebrew):**
```bash
brew install mysql
brew services start mysql
```

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install mysql-server
sudo systemctl enable --now mysql
```

### 2. Secure the Server
```bash
mysql_secure_installation
```
Follow the prompts to set a strong root password and disable anonymous users.

### 3. Create Database & User
```sql
CREATE DATABASE draft_inventory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'draft_user'@'%' IDENTIFIED BY 'CHANGE_ME_NOW!';
GRANT ALL PRIVILEGES ON draft_inventory.* TO 'draft_user'@'%';
FLUSH PRIVILEGES;
```
Use a unique password per environment.

### 4. Configure the App
1. Copy the sample file: `cp env.mysql.example .env` (Windows: `copy env.mysql.example .env`)
2. Generate key: `php artisan key:generate`
3. Edit `.env` with your DB host, database, username, and password (and turn off `APP_DEBUG` in prod)

### 5. Run Migrations & Seed
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 6. Verify Connection
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```
If no exception is thrown, the connection works.

---

## Moving Existing Data from SQLite

### Option A: SQL Dump
```bash
sqlite3 database/database.sqlite .dump > backup.sql
```
Clean SQLite-specific syntax (e.g., `PRAGMA`, double quotes) before importing:
```bash
mysql -u draft_user -p draft_inventory < cleaned_backup.sql
```

### Option B: Laravel Export/Import
```php
// Export via Tinker
php artisan tinker
>>> \Storage::put('products.json', \App\Models\Product::all()->toJson());

// Switch .env to MySQL, then:
>>> $products = json_decode(\Storage::get('products.json'));
>>> foreach ($products as $item) {
...     \App\Models\Product::create((array) $item);
... }
```

### Option C: GUI Tools
Use DBeaver/DataGrip/MySQL Workbench to connect to both databases and copy tables.

---

## MySQL Security Checklist
- Strong passwords (16+ chars, unique per environment)
- Restrict network access (firewall + bind-address)
- Require TLS for remote connections (`require_secure_transport = ON`)
- Grant least privilege (no global `GRANT ALL`)
- Enable binary logging and backups
- Monitor slow query log and general log (forward to SIEM if available)

Example `my.cnf` snippet:
```
[mysqld]
bind-address = 0.0.0.0
require_secure_transport = ON
ssl-ca   = /etc/mysql/certs/ca.pem
ssl-cert = /etc/mysql/certs/server-cert.pem
ssl-key  = /etc/mysql/certs/server-key.pem
```

---

## Optional: PostgreSQL Instructions
If your environment prefers PostgreSQL, follow the `Optional Migration to PostgreSQL` section in `SECURITY_IMPROVEMENTS.md`. The Laravel config already includes `pgsql` settings—just switch `DB_CONNECTION` and supply the proper credentials.

---

## Testing Checklist
1. `php artisan migrate:status`
2. Create/edit/delete entities through the UI
3. Run automated tests if available
4. Tail `storage/logs/laravel.log` for DB errors

---

## Troubleshooting
- **Connection refused:** ensure MySQL service is running and firewall allows port 3306.
- **Access denied:** verify username/host in `mysql.user`; match `.env` values.
- **SSL errors:** confirm certificates exist and paths are correct.
- **Migrating large data:** temporarily disable foreign key checks (`SET FOREIGN_KEY_CHECKS=0;`) during import, then re-enable.

---

## Need Help?
- MySQL Docs: https://dev.mysql.com/doc/
- Laravel DB Docs: https://laravel.com/docs/database
- Logs: `storage/logs/laravel.log`

