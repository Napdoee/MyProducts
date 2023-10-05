# MyProducts
> E Commerce Web Apps with multiusers (admin, user)

![](https://i.ibb.co/kKW8HkC/Screenshot-from-2023-10-04-20-40-18.png)
![](https://i.ibb.co/nwvcddG/Screenshot-from-2023-10-04-20-40-29.png)
![](https://i.ibb.co/XbQCpHd/Screenshot-from-2023-10-04-20-41-06.png)


## Technologies
Project is created with **Laravel 9.x** and feature like Auth Breeze and Mailer, for styling we use **[Tabler.io](https://tabler.io/)**, and we use Product API from [DummyJSON](https://dummyjson.com/docs/products)


## Installation
```sh
composer update
php artisan migrate
php artisan db:seed
```
* if an error occurs during `db:seed`, you just need to repeat the command again `db:seed`
### Setup enviroment
Duplicate `.env.example` and delete `.example` then setup DB_CONNECTION and run `key:generate`
```sh
php artisan key:generate
```
### Run Server
```sh
php artisan serve
```
Open browser `http://localhost:8080` and you can login as Admin
- Username: `Napdoee`
- Password: `password`
