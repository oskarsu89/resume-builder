# Laravel CV Builder App

This is a Laravel-based CV builder.

Following Laravel ecosistem packages are used in this project:
[Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)
[Inertia](https://inertiajs.com/) with Vue.js for frontend
[Sail](https://laravel.com/docs/11.x/sail) for Docker-based development with PostgreSQL.


## Requirements

- **Docker** (with Docker Compose)
- **Node.js** & **npm**
- **Composer**
- **Git**

## Installation

### 1. Clone the Repository

```bash
git clone git@github.com:oskarsu89/aizdevums-dev-test.git
cd aizdevums-dev-test
```

### 2. Install Dependencies

```bash
# PHP dependancies
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update the .env file for PostgreSQL:

```bash
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 4. Start Docker Containers

```bash
./vendor/bin/sail up -d
```

### 5. Migrate the Database

```bash
./vendor/bin/sail artisan migrate
```

### 6. Run Backend

```bash
./vendor/bin/sail artisan serve
```

### 7. Run Frontend

```bash
# Install JavaScript dependencies
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail npm run dev
```