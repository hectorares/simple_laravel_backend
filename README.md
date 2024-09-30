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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Laravel Simple Backend

This is a simple Laravel backend project.

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/hectorares/simple_laravel_backend.git
   ```

2. **Navigate to the project directory:**

   ```bash
   cd simple_laravel_backend
   ```

3. **Install dependencies:**

   Make sure you have [Composer](https://getcomposer.org/) installed. Then, run:

   ```bash
   composer install
   ```

4. **Set up the environment file:**

   Copy the example `.env` file to create your environment configuration:

   ```bash
   cp .env.example .env
   ```

5. **Generate the application key:**

   Run the following command to generate a key for your Laravel application:

   ```bash
   php artisan key:generate
   ```

6. **Configure your database:**

   Open the `.env` file and configure your database settings (e.g., `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`).

Update as correspond
```bash
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=laravel
 DB_USERNAME=root
 DB_PASSWORD=
 ```

7. **Run the migrations:**

   After configuring your database, run the migrations to set up the database schema:

   ```bash
   php artisan migrate
   ```

8. **Start the development server:**

   To start the local development server, run:

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.

 you can see customers on : http://127.0.0.1:8000/api/customers
 and add see it on postman or with curl
 ```bash
 curl -X GET "http://localhost:8000/api/customers" -H "Accept: application/json"
 ```

 ```bash
 curl -X POST "http://localhost:8000/api/customers" \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{"name": "John Doess", "email": "john.doesss@example.com"}'
```

## Running Tests

You can run the tests using PHPUnit. To do so, use the following command:

```bash
php artisan test
```

## Additional Commands

- **Clear application cache:**

  ```bash
  php artisan cache:clear
  ```

- **Run database seeders:**

  ```bash
  php artisan db:seed
  ```

## Add new field to the customers table

Example: add last_name

1.- On file database/migrations/2024_09_29_210211_create_customers_table.php
add new field
  ```bash
   $table->string('name');  
   $table->string('last_name');  // Add last_name column
   $table->string('email')->unique(); 
  ```


 2.- On file app/Http/Controllers/CustomerController.php add new field
      ```bash
      $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email', // Add last_name
            'last_name' => 'required|string|max:255',
      ]);
      ```


3.- On file app/Models/Customer.php add new field
 ```bash
 protected $fillable = ['name', 'email', 'last_name']; // Add last_name
 ```


4.- 
```bash
php artisan migrate:rollback 
```
Nota: Se borraran los datos de la tabla

5.-
 ```bash
 php artisan migrate (Se creara la tabla con los nuevos campos)
```



## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
