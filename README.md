# KamilCraftAPI

API for kamilcraft.com projects

## Requirements

### Required

* Docker 20.10.x (Engine) or later

### Optional

* PHP 8.1.x or later
* Composer 2.4.x or later
* Nodejs 18.14.x or later

## Preparation and installation

1) Copy the contents of the .env.example file into .env
   ```shell
   cp .env.example .env
   ```

2) Build the image needed for Laravel and Node.js
   ```shell
   docker-compose build --no-cache --pull
   ```

3) Run the images prepared in ``docker-compose.yml``
   ```shell
   docker-compose up -d
   ```

4) Install the dependencies needed for Laravel and Nodejs
   ```shell
   docker-compose exec -u "$(id -u):$(id -g)" php composer install
   ```
   ```shell
   docker-compose run --rm -u "$(id -u):$(id -g)" npm install
   ```

5) Key and data generation
   ```shell
   docker-compose exec -u "$(id -u):$(id -g)" php php artisan key:generate
   ```
   ```shell
   docker-compose exec -u "$(id -u):$(id -g)" php php artisan migrate:fresh --seed
   ```
   ```shell
   docker-compose run --rm -u "$(id -u):$(id -g)" npm run dev
   ```

6) Go to ``http://localhost/dashboard`` in your browser.
