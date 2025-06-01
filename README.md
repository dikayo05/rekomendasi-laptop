# rekomendasi-laptop
web rekomendasi laptop menggunakan laravel + sqlite

## Getting Started

### Step1: Clone Project
```bash
git clone https://github.com/dikayo05/rekomendasi-laptop.git
cd rekomendasi-laptop
```

### Step2: Install Dependencies
```bash
composer install
npm install
npm run build
```

### Step3: Add Requirement
```bash
copy .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
```

## How to Run
```bash
php artisan serve
```
or
```bash
composer run dev
```