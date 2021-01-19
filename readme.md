# Proyecto ADS
Proyecto para el curso de ADS, hecha con Laravel y Vue.js, usando autenticación JWT.

# ¿Cómo subir?
```git
git clone
git checkout -b <nombre de cualquier rama que quieras>
git add .
git commit -m 'mensaje que quieras'
git push --set-upstream origin <nombre de la rama>
```
# Guía para trabajar con autenticación JWT
Se usará la libreria de Sean Tymon, ya se encuentra instalada.
En la guía se encuentra como crear los controladores, modelos para la autenticación.

https://blog.peterplucinski.com/setting-up-jwt-authentication-with-laravel-and-vue-part-1/

# Guía para correr tanto Laravel y Vue
El proyecto se ha creado con Laravel 5.5.

Correr los cambios hechos en el front-end
Primero instalar las dependencias que se ubican en el package.json usando el comando
```JavaScript
npm i
```
Para correr los cambios realizados en el front-end
```JavaScript
npm run watch
```
Correr laravel
```PHP
php artisan serve
```
Se tomó como referencia esta guía.

https://bluuweb.github.io/tutorial-laravel/vue/#intalaciones


git branch -> muestra todas las ramas remotas existentes 
git branch <nombre de su rama> -> crean una rama 
git checkout <nombre de la rama destino> -> te ubicas a la rama destino  


Crear un cotroller

php artisan make:controller Controller --resource

