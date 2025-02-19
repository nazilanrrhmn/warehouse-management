
# Warehouse Management

This project is a Laravel-based application for managing stock, customer, and supplier transactions.
This application is equipped with CRUD features and confirmation buttons using SweetAlert.


## Features

- Stock Management
- Customer Management
- Supplier Management
- Tailwind Templating
- Eloquent ORM for Query Database


## Installation

Clone Repository warehouse-management with git

```bash
  git clone https://github.com/nazilanrrhmn/warehouse-management.git
  cd warehouse-management
```

Install Dependecies

```bash
    composer install
    npm install
```
Database Copy & Configuration .env

```bash
    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite
    DB_FOREIGN_KEYS=true
```
Database Migration

```bash
    php artisan migrate
```
Run Server

```bash
    php artisan serve
```
## Demo

Adding Data
Click the Add Stock Transaction, Add Customer, or Add Supplier button.
Fill in the form, then press Submit.

Editing Data
Click the Edit button on the data you want to update.
Update the information, then click Update.

Deleting Data
Click the Delete button, then confirm the deletion with Javascript.


## Tech Stack

**Client:** PHP Blade, TailwindCSS

**Server:** Laravel, SQLite


## Requirement
- PHP 8.2.12
- Composer 2.8.4
- SQLite
- Laravel
- Tailwindcss