# Lab App

App for storing and accessing encrypted lab results.

<!-- TODO write readme -->

## Installation

First install the project by running `composer install`. After that create the .env file `cp .env.example`. Next run the `php artisan key:generate` command to generate a general key. After this migrate the database `php artisan migrate`. Finally the project can be started with `php artisan serve`.

<!-- ## API -->
<!-- explain endpoints and which are authenticaded -->
<!-- explain postman file -->

<!-- ## Encryption -->
<!-- explain how encryption of data is done with rotation keys -->