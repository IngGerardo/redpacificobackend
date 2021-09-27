# redpacificobackend
Ejercicio practico para medir mis habilidades de software.

• Instrucciones para instalar y configurar los prerrequisitos de la aplicación.
git clone https://github.com/IngGerardo/redpacificobackend.git
Tener instalado previamente el xampp con la version PHP 7.2 y el gestor de dependencias composer.
colocar el proyecto en la carpeta de htdocs por lo general se encuentra en la ruta: C:\xampp\htdocs.
Configurar el archivo .env para asignarle las credenciales e ip necesarias para la conexion a 
la base de datos en caso de no existir el archivo (.env) usar el archivo .env.example. como
base para realizar la configuracion.

• Instrucciones para crear e inicializar la base de datos.
Se debe ejecutar el comando para crear la base de datos que se encuentra en el archivo
https://github.com/IngGerardo/redpacificobackend/blob/desarrollo/scripts/redpacifico.sql
y despues de esto se debe de abrir una ventana de query con la base de datos creada y despues 
crear las tablas que vienen en el archivo sql antes mencionado.

• Instrucciones para preparar el código fuente para compilarlo y correrlo de manera apropiada.
Una vez descargado el proyecto se tienen que descargar las dependencias 
abriendo el cmd y posicionandote en le carpeta del proyecto para ejecutar la instruccion
"composer update" despues de esto se necesita iniciar el servidor Web de apache y acceder a 
las url que le pertenecen al proyecto un ejemplo seria esta:
http://localhost/redpacificobackend/public/clientes

-Links de software necesario:
https://getcomposer.org/download/
https://www.apachefriends.org/es/download.html
https://www.postgresql.org/download/

Tecnologia usada: Lumen - PHP Micro-Framework By Laravel
Lenguaje: PHP
