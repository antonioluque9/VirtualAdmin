Este proyecto en laravel fue creado como trabajo de fin de curso, lo hice basandome en las necesidades de la empresa en 
la que hice las practicas, basicamente es una web que sirve para centralizar el software Virtualmin usando su API

Para lograr poner en funcionamiento este proyecto debes seguir estos pasos:
-Crear una base de datos, ya sea local o remota pero debes especificarlo correctamente en el .env(ip, nombre de la base
de datos, usuario, contraseña, ...), ademas debes asegurarte de que esten creados la base de datos y el usuario
que vas a usar.
-Lanzar composer install una vez que clones el proyecto para descargar todos los paquetes necesarios para el correcto
funcionamiento de laravel, recuerda que debes tener todas las dependecias de php instaladas, para saber cuales necesita 
laravel puedes mirar la documentacion de la web oficial.
-Crear la carpeta jsonfiles en la carpeta database.
-Generar una Key, simplemente escribe en la terminal "php artisan key:generate", ten en cuenta que esta clave es la que
se usa para cifrar y descrifrar algunos de los datos que usa el programa para su funcionamiento, de modo que si se
regenera esta clave algunos de los datos se perderan tambien y posiblemente se creen algunos conflictos
-Lazar php artisan migrate, este paso se debe realizar despues de introducir los datos de la base de datos en .env, de
lo contrario las tablas no se crearan
-Por ultimo debes añadir al .env el metodo de envio de correos electronicos que usaras(protocolo, servidor de correo,
usuario, contraseña, cifrado, etc)

Tras esto lo unico que debes hacer es lanzar la ruta en la que se haye el proyecto, registrarte una unica vez y comenzar
usar la web
