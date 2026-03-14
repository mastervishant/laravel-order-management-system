# Laravel Order Management System

A simple Order Management System built with Laravel (PHP 7.4) that allows customers to create and manage their own orders.

## Features

* Create orders with multiple items
* View order details
* Update order status
* Cancel orders (only if status is PENDING)
* List all orders with optional status filtering
* Customers can only see and manage their own orders
* Automatic background job that updates PENDING orders to PROCESSING every 5 minutes
* Bootstrap-based responsive UI

## Tech Stack

* PHP 7.4
* Laravel
* MySQL
* Bootstrap 5
* Blade Templates

## Installation

1. Clone the repository

```
git clone https://github.com/mastervishant/laravel-order-management-system.git
```

2. Navigate into the project

```
cd laravel-order-management-system
```

3. Install dependencies

```
composer install
```

4. Copy environment file

```
cp .env.example .env
```

5. Generate application key

```
php artisan key:generate
```

6. Configure your database in `.env`

Example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=order_management
DB_USERNAME=root
DB_PASSWORD=
```

7. Run database migrations

```
php artisan migrate
```

8. Start the application

```
php artisan serve
```

The application will run at:

```
http://127.0.0.1:8000
```

## Order Status Flow

Orders move through the following statuses:

```
PENDING → PROCESSING → SHIPPED → DELIVERED
        ↘
        CANCELED
```

## Background Job

A Laravel scheduler command automatically updates orders from **PENDING → PROCESSING** every 5 minutes.

Run the scheduler locally:

```
php artisan schedule:work
```

## Authentication

Users must register/login before accessing the order system.
Each user can only view and manage their own orders.

## Project Structure

```
app/
 ├ Models
 │   ├ Order.php
 │   └ OrderItem.php
 ├ Http/Controllers
 │   └ OrderController.php

database/
 ├ migrations
 └ seeders

resources/views/
 ├ layouts
 └ orders

routes/
 └ web.php
```

## Author

Vishant

GitHub:
https://github.com/mastervishant

