# A simple online library
## Technical information
- Ubuntu 20.04
- Laravel 8
- Docker compose
- PHP 7.4
- MySQL
- Codeception
- Jquery

## Instructions for starting

Copy the .env.example file and make the following changes:
- APP_NAME(***Example*** Olibrary)
- APP_DEBUG(`false`)
- DB_USERNAME(***Example*** `root`)
- DB_PASSWORD(***Example*** `password`)
- DB_HOST(`mysql`)
- MAIL_HOST(***Example*** `stmp.mailtrap.io`)
- MAIL_PORT(***Example*** `465`)
- MAIL_USERNAME(YOUR_USERNAME)
- MAIL_PASSWORD(YOUR_PASSWORD)
- MAIL_ENCRYPTION(***Example*** `TLS`)
- MAIL_FROM_ADDRESS(YOUR_ADDRESS)
- QUEUE_CONNECTION(`database`)
```bash
chmod 755 -R Olibrary/storage/
```

To start the containers, execute the command:
```bash
docker-compose up --build -d
```
Next, you need to open the container with PHP. 

CONTAINER ID of the container with php:
```bash
docker ps
```
![docker ps](https://i.postimg.cc/y6cFS4Qr/New-Project-5.jpg)

To enter the container, execute the command:
```bash
docker exec -it CONTAINER_ID /bin/bash
```
![docker exec](https://i.postimg.cc/GpvMQ7bc/New-Project-6.jpg)
Execute the following commands in the container:
```bash
composer i
```
```bash
php artisan key:generate 
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan storage:link
```
### After completing all the commands, you have a working application:
![example](https://i.postimg.cc/Jz9dgY7D/New-Project-7.jpg)

# Implemented functionality
- Login, registration;
- Email confirmation, Google login, password reset;
- View books with filters, pagination;
- Adding books to favorites;
- View favorites in your personal account;
- Ability to download the book from the site;
- Changing data in the personal account;
- Admin panel. CRUD Users, Books and Authors. 

### The personal account:
![profile](https://i.postimg.cc/fLkdFrY4/New-Project-8.jpg)
### Admin dashboard:
![dashboard](https://i.postimg.cc/V6qN7yNL/New-Project-9.jpg)
