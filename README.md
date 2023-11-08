# Lab App

Simple app for storing and accessing encrypted lab results.

## Installation

First install the project by running `composer install`. After that create the .env file `cp .env.example`. Next run the `php artisan key:generate` command to generate a general key. After this migrate the database `php artisan migrate`. Finally the project can be started with `php artisan serve`.

## API
The following API-endpoints are implemented;
### Unauthenticated
- [POST] `/api/tokens` - get api token
- [GET] `/api/labresults/{code}` - get labresults by code
### Authenticated
- [GET] `/api/labresults` - get all lab results
- [POST] `/api/labresults` - store new lab result
- [GET] `/api/logout` - invalidate api token

A postman json file (`lab-app.postman_collection.json`) is included in the project aswell. 

After running the migrations one user (`fred@mail.nl:Wachtwoord01`) is predefined in the database.

## Encryption
Encryption for lab results is implemented with AES 256. For this the aplication retrieves one of the encryption keys from the database. Multiple keys can be setup, even in a rotating maner. Encrypting/ hashing the keys in the database would add another layer of security to the application.