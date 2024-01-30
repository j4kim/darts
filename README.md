# Darts

Simple and stupid Darts championship manager using PHP, HTMX and MySQL.

## Wireframe

https://www.tldraw.com/r/bQhuH_q9lF8Oi2Fy5STSX?viewport=-5,-113,2170,1174&page=page:page

## Set up a local environment

Install mysql, php and composer.

Install php dependencies:
```
composer install
```

Create config from example:
```
cp config.example.php config.php
```

Configure DB conection in `config.php`.

Create database:
```
composer migrate
```

Run local server:
```
composer serve
```

Install js dependencies:
```
npm install
```

Run tailwind:
```
npm run lezgo
```

## Deployment

Made via Github Webhook making a post request to /webhook. all pushes to master branch should produce an update on the server.
