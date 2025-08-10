# Laravel Task Management Project

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 📥 Project Installation Guide

Follow these steps to set up the Task Management project:

### 1. Clone the Repository
Clone the project repository using Git:
```bash
git clone https://github.com/muhamed-ibrahim/task.git
cd task
```
### 2. Set Up Environment Configuration
Copy the example environment configuration file:
```bash
cp .env.example .env
```
### 3. Install PHP Dependencies
Install Composer dependencies:
```bash
composer install
```
### 4. Configure Database Connection
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
### 5. Run Migrations and Seeders
Migrate database and seed initial data:
```bash
php artisan migrate --seed
```
### 6. Generate Application Key
Generate encryption key:
```bash
php artisan key:generate
```
### 7. Run Project
```bash
php artisan serve
```
### 8. Set Up Mail Configuration (Optional)
Configure mail settings in `.env` for daily reports:
```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
### 9. Generate JWT Secret
Generate JWT encryption key:
```bash
php artisan jwt:secret
```
### 10. Run Daily Report Command (Optional)
Execute daily email report:
```bash
php artisan app:daily-report
```
## 🛠️ Additional Information
- **Authentication**: Uses JWT for API authentication
- **Mail Testing**: Use Mailgun/Mailtrap for local email capture
- **Security**: Never commit `.env` to version control
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
