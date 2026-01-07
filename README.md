## Resources
- PHP >= 8.2
- Laravel ^11
- MySQL / MariaDB
- Composer
- Node.js & NPM

---

## Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/mnardynsyh/ppdb-pkl.git
cd ppdb-pkl
```
Kalau pake ZIP, ekstrak folder ZIP lalu buka projek nya.

### 2. Install Dependensi
---
#### Composer
```bash
composer install
```
Kalau ada error/warning, jalankan:
```bash
composer update
```
---
#### Node Module
```bash
npm install
```
---
### 3. Konfigurasi .env
- Copy file `.env copy`, lalu rename menjadi `.env`.
- Kemudian sesuaikan konfigurasi database di file `.env`:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppdb_pkl
DB_USERNAME=root
DB_PASSWORD=
```
---
### 4. Generate Application Key
```bash
php artisan key:generate
```
---
### 5. Migrasi Database & Seeder
```bash
php artisan migrate --seed
```
---
### Done.

Default login Admin:<br>
- Email: admin@gmail.com<br>
- Pass: admin123

---
