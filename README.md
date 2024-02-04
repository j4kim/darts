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

Create database (assuming the password for mysql is "sandwich"):
```
composer migrate
```

Install js dependencies:
```
npm install
```

## Run

Run local server:
```
composer serve
```

Run tailwind:
```
npm run lezgo
```

## Test

While local server and tailwind are running. Open cypress using:

```
composer test
```

## Deploy

Deployment is performed via a [Github Webhook](https://github.com/j4kim/darts/settings/hooks) making a post request to `/webhook`. All pushes to branch master produces an update on the server.

Before a push to master, build css:

```
npm run build
```