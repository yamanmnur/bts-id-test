# DEVIXEL BACKEND TEST

## Tech Specification
 
1. Laravel 8.83.16
2. Composer 1.8.6
3. PHP 7.4.16
4. MySQL 8.0.27
5. JWT 1.0.2


## Installation

Use the composer to install some packages, set .env before and run some commands in terminal

```bash
#1 Install Some Packages
composer install

#2. Create .env file
cp .env.example .env

#3. running migration
php artisan migrate

#5. jwt key
php artisan jwt:secret

```

## Usage

```bash
#run project
php artisan serve
```


## Collection Postman
```bash
#FILE LOCATION COLLECTION POSTMAN FILE
{root_project}/dokumentasi.json
```