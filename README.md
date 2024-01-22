# Darts

Simple and stupid Darts championship manager using PHP and MySQL.

## Wireframe

https://www.tldraw.com/r/bQhuH_q9lF8Oi2Fy5STSX?viewport=-5,-113,2170,1174&page=page:page

## Set up a local environment

Install mysql and php.

Configure DB conection in `config.php`.

Create database darts:
```
mysql --password=sandwich --execute="create database darts"
```

Create tables:
```
mysql --password=sandwich darts < db/create_tables.sql
```

Create a first user:
```
mysql --password=sandwich darts --execute="insert into users (username, password) values ('admin', md5('admin'))"
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
```