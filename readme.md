<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Version Utilizada:
- Laravel Version 5.8

## Comandos:
- composer install

NOTA: Configurar en el archivo .env las credenciales de la Base de Datos, Mailtrap y la variable QUEUE_CONNECTION 
asignarle el valor de database. 

Luego ejecutar:
- php artisan key:generate
- php artisan migrate:refresh --seed

Disponer de 2 terminales una para el servidor y otra para el control de las colas:

- Terminal 1:
    - php artisan serve
- Terminal 2:
    - php artisan queue:listen
    
    
Luego acceder a http://localhost:8000
