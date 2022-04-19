# KamilCraftAPI

API for kamilcraft.com projects

## Requirements

### Required

* Docker 20.10.x (Engine) or later

### Optional

* PHP 8.0 or later
* Composer 2.3.x or later
* Nodejs 16.14.x or later

## Preparation and installation

1) Copy the contents of the .env.example file into .env
   ```shell
   cp .env.example .env
   ```

2) Build the image needed for Laravel
   ```shell
   docker-compose build
   ```

3) Run the images prepared in ``docker-compose.yml``
   ```shell
   docker-compose up -d
   ```

4) Install the dependencies needed for Laravel and Nodejs. \
   **The installer for Laravel generates the key and migrates the database.** \
   **In the case of Nodejs, it generates page styles.**
   ```shell
   docker-compose exec laravel install
   ```
   
5) Go to ``http://localhost/dashboard`` in your browser.
