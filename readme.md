
Gõ lênh để tạo project
composer create-project --prefer-dist laravel/laravel project_name

copy file .env.example => env
copy .env.example .env

trong file .env bắt buộc tạo key APP_KEY
Chạy: php artisan key:generate

Tạo migration (seed db)
php artisan make:migration create_[table_name]_table

Tạo controller
php artisan make:controller PostController

Seed db
php artisan migrate:fresh --seed

C:\xampp\apache\conf\extra\httpd-vhosts.conf => config virtual host.
C:\Windows\System32\Drivers\etc\hosts 

php artisan serve



