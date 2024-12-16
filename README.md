# 1. Clone repository

-   Buka Command Prompt atau Terminal
-   Navigasi ke direktori web Anda (contoh: cd c:\laragon\www)
-   Clone repository:
    ```
    git clone https://github.com/username/display-digital.git display
    ```
-   Masuk ke direktori project:
    ```
    cd display
    ```

# 2. Install dependencies composer

composer install

# 3. Install dependencies npm

npm install && npm run dev

# 4. Copy .env

cp .env.example .env

# 5. Generate app key

php artisan key:generate

# 6. Buat database MySQL

php artisan migrate

# 7. Konfigurasi database di .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=display
DB_USERNAME=root
DB_PASSWORD=

# 8. Migrate dan seed database

php artisan migrate --seed

# 9. Link storage

php artisan storage:link


# 11. Clear cache

php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 12. Jalankan server

php artisan serve

# 13. Watch perubahan asset

npm run dev

# 14. Build asset untuk production

npm run build

# 15. Clear semua cache

php artisan optimize:clear

# 16. Reset database dan seed ulang

php artisan migrate:fresh --seed

# 17. Buat storage link ulang

rm public/storage
php artisan storage:link

# 18. Cek route list

php artisan route:list

# 19. Clear cache

php artisan optimize:clear
