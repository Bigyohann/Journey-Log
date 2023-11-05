# Matawan technical test

## Requirements
- PHP 8.2
- Composer

## Installation
- Clone the repository
- Run `composer install`
- It's built as a library, so you can use it in your own project, or you can run it as a standalone application

## Running the test
- Run `php src/app.php` from the root directory, just to see the output
- Run test with `php vendor/bin/pest` from the root directory

## Possible improvements
- Split Transportation into different classes
- Split Formatter into different classes and attach them to the Transportation classes