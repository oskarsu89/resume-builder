# Laravel CV Builder App

This is a Laravel-based CV builder using Breeze for authentication, Inertia.js with Vue.js for frontend, and Sail for Docker-based development with PostgreSQL.

## Requirements

- **Docker** (with Docker Compose)
- **Node.js** & **npm**
- **Composer**
- **Git**

## Installation

### 1. Clone the Repository

```bash
git clone git@github.com:oskarsu89/aizdevums-dev-test.git
cd cv-builder-app
```

### 2. Install Dependencies

```bash
# PHP dependancies
composer install
# JavaScript dependencies
./vendor/bin/sail npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
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

### 6. Run Frontend

```bash
./vendor/bin/sail npm run dev
```

### 7. Run Backend

```bash
./vendor/bin/sail artisan serve
```