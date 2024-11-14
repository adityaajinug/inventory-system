# Inventory System

This is a Laravel-based inventory management system running in a Dockerized environment with laravel version is laravel 10 php 8.2 and database mysql.

---

## Prerequisites

Ensure you have the following installed on your system:

1. [Docker](https://www.docker.com/get-started)
2. [Docker Compose](https://docs.docker.com/compose/)

---

## Installation Guide

### 1. Clone the Project Repository
 Clone the repository:
   ```bash
   git clone https://github.com/adityaajinug/inventory-system.git
   ```

### 2. Navigating project
   
   ```bash
   cd inventory-system
   ```
### 3. Start Docker Containers
  
   ```bash
   docker-compose up -d
   ```
### 4. Install Composer 
  ```bash
   docker exec -it inventory_laravel_app bash
   ```
  ```bash
   composer install
   ```
### 5. Setup .env 
Notes : still in bash and do
  ```bash
   cp .env.example .env

   php artisan key:generate
   ```
Notes : if not in bash
  ```bash
   docker exec -it inventory_laravel_app cp .env.example .env

   docker exec -it inventory_laravel_app php artisan key:generate

   ```
if the env not setup db, you can copy paste this
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=inventory_user
DB_PASSWORD=passworddb
```
### 5. Setup .env 
Notes : still in bash and do
  ```bash
   php artisan migrate
   ```
Notes : if not in bash
  ```bash
   docker exec -it inventory_laravel_app php artisan migrate
   ```
### 6. Access the Application
```
http://localhost:8080
```