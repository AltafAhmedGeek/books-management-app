# Laravel Book Management System

This project is a Laravel-based Book Management System. Follow the steps below to set up and run the project on your local environment.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP >= 8.1
- Composer
- MySQL or any other compatible database
- Git

## Setup Instructions

### 1. Clone the Repository

Clone the repository from GitHub and navigate into the project directory:

```bash
git clone https://github.com/AltafAhmedGeek/books-management-app.git
cd books-management-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
use email : test@example.com and password : 123 to login

### 2. Optimize Routes (optional)
These steps are optional but are good to do.
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
