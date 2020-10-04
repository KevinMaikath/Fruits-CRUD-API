# Fruits-CRUD-API

Simple Laravel API with a Fruit CRUD

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Desctiption
This project uses Laravel 7.2.29 with a MySQL database to work as a RESTful API with a basic CRUD of fruits. It uses Passport to bring token Authentication.

# Set Up
In order to properly make use of this API, follow the these steps:
- Make sure you have installed Laravel **version 7.2.19** and PHP Composer.
- Properly set up the database connection (inside .env file): 
```dotenv
DB_CONNECTION=your_db_type (example: mysql)
DB_HOST=your_db_IP
DB_PORT=your_db_PORT
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
- Install Composer dependencies:
```
composer install
```
- Run database migrations:
```
php artisan migrate
```
- Generate Passport Client Keys (necessary for Authentication Token generation:
```
php artisan passport:install
```

# Testing
In order to run the tests just execute the following command:
```
php artisan test
```
**Note:** It will automatically use a local sqlite database for the tests, so that the real database isn't modified while running the tests.
