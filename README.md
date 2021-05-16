# Laravel 8 Application

Laravel is a PHP full-stack web framework that is light, fast, flexible and secure. More information can be found at
the [official site](https://laravel.com).

## Server Requirements

PHP version 7.3 or higher is required.

## Setup

> You must complete the following steps to initialize the project.

Run command in you domain root

`git clone https://github.com/sihoulette/laravel.local.git .`

## Update composer dependence

`composer update`

## Application settings

Copy `.env.example` to `.env` and tailor for your app, specifically the APP_URL and any database settings.

## Running migrations

`php artisan migrate`

## Running seeders

+ `composer dump-autoload`
+ `php artisan db:seed`

## Prerequisites to compile themes

> + Make sure to have the ***Node.js*** installed & running in your computer. If you already have installed nodejs on your computer, you can skip this step
>+ Make sure to have the ***Gulp*** installed & running in your computer. If you already have installed gulp on your computer, you can skip this step. In order to install, just run command `npm install -g gulp` from your terminal.

## Compiling admin theme

+ `cd resources/themes/ui`
+ `npm install`
+ `gulp build`
