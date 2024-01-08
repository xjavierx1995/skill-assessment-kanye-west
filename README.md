## Developer
Name: Javier Rodriguez <br/>
Email: xjavierx1995@gmail.com<br/>

### Description
This is a project made with Laravel 9 + passport + vue 3 + typescript + pinia + PrimeVue + axios + vite

### Instructions

1. install dependencies
```bash
composer install
```
```bash
npm i
```
2. generate secret key
```bash
php artisan key:generate
```
3. Config passport
```bash
php artisan passport:install
```
```bash
php artisan migrate --seed
```
4. Create a copy of the .env.example file as .env
5. Create a DB and set the credentials in .env file
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=skill_assessment
DB_USERNAME=root
DB_PASSWORD=
```

### Execute project
```bash
php artisan serve
```
```bash
npm run dev
```

If you want to test features, execute this comand:
```bash
php artisan test
```
BEFORE EXECUTE, YOU HAVE TO CREATE A TABLE NAMED `testing`

You can access with this credentials:

For admin
`email: admin@user.com`
`Password: admin`
For user
`email: normal@user.com`
`Password: 123abc`


### Dependencies

This project use:
* Node 20.10.0
* php 8.1

### More information
This project was carried out by [Javier Rodriguez](https://github.com/xjavierx1995) for a requested test using Vue 3 + Vuex. If you want to contact me, visit my [LinkedIn](https://www.linkedin.com/in/javier-rodr%C3%ADguez-93a61619a/).
