https://codehafeez.com/fantasy/public/api/leagues

composer install

php artisan migrate
php artisan serve

Post => http://127.0.0.1:8000/api/register
Post => http://127.0.0.1:8000/api/login




CREATE TABLE leagues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

php artisan make:model League
php artisan make:controller Api/LeaguesController --api

