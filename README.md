# EBOARD

## Intialization

Clone the repository. Then run:

**NOTE:** _you must have docker installed._

```bash
cd eboard
# command that installs composer dependencies
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \laravelsail/php82-composer:latest composer install --ignore-platform-reqs
```

Afterwards, create a .env file and copy the contents of .env.example file inside it. Then run:

```bash
# Note: This assumes you've created a sail aliases on your machine if you haven't you can use ./vendor/bin/sail or create a sail alias. Please refer to laravel sail documentation for instructions on how to do this.
sail up
# in another terminal on the eboard directory run:
sail npm install
sail php artisan key:generate
sail php artisan migrate:fresh --seed
sail restart
```

When you've run all the commands visit <http://localhost:8080> to view the application.
