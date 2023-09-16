composer i
php artisan key:generate
configure .env file (database, JWT_SECRET, mail)
php artisan migrate --seed
php artisan jwt:secret

user - email user@test.com, pass 12345678
