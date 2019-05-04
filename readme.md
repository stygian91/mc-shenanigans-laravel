## Installation

1. Checkout the repo:
`git clone git@github.com:stygian91/mc-shenanigans-laravel.git`

2. Install php dependencies. You need to install the package manager composer, if you don't already have it.
`composer install`

2. Copy the `.env.example` file
`cp .env.example .env`

3. Edit the `.env` file. Most likely you'll only need to update your database settings.

4. Generate the application key:
`php artisan key:generate`

5. Run the database migrations:
`php artisan migrate`

6. Make sure that all requests redirect to `public/index.php` (https://laravel.com/docs/5.8/installation#web-server-configuration)

7. Add a new user so you can access the pages (registration is currently disabled). You can do that through `php artisan tinker`. Example:
```
\App\User::create([
'name' => 'John Doe',
'email' => 'someone@example.com',
'password' => bcrypt('password'),//very hard password
]);
```

8. Build JS/CSS:
 * `yarn` or `npm i`
 * `yarn prod` or `npm run prod`
