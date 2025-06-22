# Laravel API with Blade Frontend

## 🚀 Overview

This project is a secure and modular Laravel API following Clean Code principles, with a Blade-based frontend to manage products.

It includes:

- RESTful API for product management
- User authentication with token
- Blade frontend for login, registration, and product dashboard
- Modal confirmation before deleting a product

## ⚙️ Requirements

Make sure you have the following installed on your machine:

- PHP >= 8.1
- Composer
- MySQL (or compatible database)
- Laravel CLI (optional but recommended)

Install Laravel globally if needed:

```
composer global require laravel/installer
```
## 📦 Installation

Clone the project:
```
git clone https://github.com/gabrielmartins0312/API-in-laravel.git
cd API-in-laravel
```
Install dependencies:
```
composer install
```
Copy and configure the .env file:
```
cp .env.example .env
php artisan key:generate
```
Set up your database in .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_in_laravel
DB_USERNAME=root
DB_PASSWORD=your_password
```
Run the migrations:
```
php artisan migrate
```

## 🧪 Running the Application

You need to run two servers separately: one for the API and one for the Blade frontend.
1. Start the API Server (e.g., on port 8000)
```
php artisan serve --host=127.0.0.1 --port=8000
```
This will serve your API endpoints at http://127.0.0.1:8000.
2. In a new terminal, start the Blade Frontend Server (e.g., on port 8001)
```
php artisan serve --host=127.0.0.1 --port=8001
```
This will serve your Blade views (login, dashboard) at http://127.0.0.1:8001.

⚠️ The frontend is configured to make HTTP requests to the API at http://127.0.0.1:8000, so both must be running at the same time.
## ✅ Features

✅ Token-based login and logout

✅ Product CRUD (Create, Read, Update, Delete)

✅ Blade UI with Bootstrap

✅ Confirmation modal before deletion

✅ Clean architecture with Repositories and Services

## 🔐 Security

.env is not committed

Passwords use Bcrypt encryption

All API routes are protected by token

Form Requests ensure input validation

## 🧼 Clean Code Structure

Controllers are slim and delegate logic

Business logic lives in Services

Database access is abstracted in Repositories

All inputs are validated via custom Request classes

## 📫 Author

Gabriel Martins – github.com/gabrielmartins0312
