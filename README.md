# Darts

Simple and stupid Darts championship manager using PHP and MySQL.

## Wireframe

https://www.tldraw.com/r/bQhuH_q9lF8Oi2Fy5STSX?viewport=-5,-113,2170,1174&page=page:page

## Set up a local environment

Install mysql, php and composer.

Install php dependencies:
```
composer install
```

Configure DB conection in `config.php`.

Create database darts:
```
mysql --password=sandwich --execute="create database darts"
```

Create tables:
```
mysql --password=sandwich darts < db/create_tables.sql
```

Seed example data:
```
mysql --password=sandwich darts < db/seed.sql
```

Run local server:
```
php -S localhost:1234 -t public
```

Install js dependencies:
```
npm install
```

Run tailwind:
```
npx tailwindcss -i ./input.css -o ./public/output.css --watch
# or
npm run lezgo
```
