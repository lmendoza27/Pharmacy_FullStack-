# Desarrollo de Proyecto FullStack - Farmacia
<div id="top"></div>
<center>
<img src="https://bimboesta.000webhostapp.com/svg/Group%2034.svg" width="200">
</center>
<br><br><br>

<center>
<img src="https://myoctocat.com/assets/images/base-octocat.svg" width="200">
</center>


<br><br><br>
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

### Built With

* [Vue.js](https://vuejs.org/)
* [Laravel](https://laravel.com)
* [Bootstrap](https://getbootstrap.com)

<p align="right">(<a href="#top">back to top</a>)</p>

### Instalación

1. Clonar el proyecto
   ```sh
   git clone https://github.com/lmendoza27/Pharmacy_FullStack-
   ```
2. Crear un base de datos `farmacia`
3. Ingresa al proyecto y realizar los comandos de ejecucion Laravel (`php 8.0 o superior`)
   ```sh
   cd Farmacia_FullStack // Ubicarnos dentro del directorio base del proyecto
   composer install
   cp .env.example .env // crear archivo de variables de entorno
   //actualizar datos de acceso a base de datos
   php artisan key:generate
   php artisan jwt:secret
   php artisan migrate --seed
   ```
4. Cambia la variable `LOG_CHANNEL` en el archivo`.env` para el registro de logs del sistema de forma diaria. Esto se puede visualizar en la ruta:`http://127.0.0.1:8000/log-viewer` o desde administración.
   
   ```sh
    LOG_CHANNEL=daily
    ```
4. Ejecuta el servicio web
   ```sh
   php artisan serve
   ```
5. Una vez en el navegador (`http://127.0.0.1:8000/`) inicie sesión con las credenciales predeterminadas:

> Las credenciales de abajo funcionan tanto en el proyecto de Vue.js para determinar las farmacias cercanas como para el ingreso como Administrador...
   ```txt
   usuario: lmendoza@autonoma.edu.pe
   contraseña: password
   ```

<p align="right">(<a href="#top">back to top</a>)</p>


### Problemática

<p align="right">Para mejorar la experiencia de un afiliado y/o paciente, la farmacia default que se ofrece para adquirir un medicamento debe ser la más cercana a su ubicación. Para esto, una de las funcionalidades que se necesita es conocer la más cercana a un punto dado (latitud y longitud), tomando en cuenta que este punto es la ubicación del paciente.</p>

### Requerimientos 

* Diseñar e implementar un Admin para el ABM de las farmacias y su ubicación.

> La administración cuenta con un CRUD realizado con AJAX, de los cuales se podrá en el momento de ingresar tener un listado completo de las farmacias, agregar nuevas, modificar existentes y borrar, asímismo está la opción de comprobar los Logs, el Tracking y la documentación de las APIs realizado con la herramienta Swagger. 

<center>
<img src="https://i.imgur.com/mh0r0Xw.png" width="600">
</center>

<br>
* Diseñar e implementar un servicio que exponga en su API las operaciones CRUD (únicamente creación y lectura por id) de la entidad Farmacia y la consulta de la farmacia más cercana a un punto 🎲. 

> Por lo que comprendí en un inicio al leer lo especificado planteé desarrollar el CRUD para la entidad Farmacia, luego de ello realicé una operación mediante SQL capaz de listarme mediante mi ubicación o una ubicación determinada las demás farmacias creadas que se encuentran más cerca del punto establecido, ello para posteriormente documentarlo con Swagger, además de agregar JWT. 

<center>
<img src="https://i.imgur.com/73WN0V9.png" width="600">
</center>
<br>

* Diseñar e implementar (Test Unitario) al menos un caso de prueba exitoso y uno no exitoso de dominio para la operación de creación de una farmacia. 

>Aparte de estos Test Unitarios como caso de prueba exitoso y no exitoso se hizo el test correspondiente al Login de un usuario. 

Para empezar a ejecutar estas pruebas unitarias será necesario que se cuente con una base de datos diferente a la especificada en el <b>.env</b>, en este caso se hará copia de la misma en el <b>.env.testing</b> con especificación a otra base de datos como prueba.

Para poder correr los comandos tendremos primero que descomentar la siguiente línea encontrada en <b>test/Feature/FarmaciaAPITest.php</b>

   ```sh
   use RefreshDatabase;
```

El objetivo de esto será migrar las tablas a la nueva base de datos de prueba, luego de ello se deberá comentar...

   ```sh
   //use RefreshDatabase;
```

>Una vez se realice lo antes mencionado para poder hacer Testing se debe de ejecutar cualquiera de los siguentes dos comandos. 

Ejecución (Opción 1)
   ```sh
   ./vendor/bin/phpunit
```

Ejecución (Opción 2)
```sh
php artisan test
```
<center>
<img src="https://i.imgur.com/O4oWKB8.png" width="600">
</center>

>Tal como se aprecia se están dando los Test Unitarios de manera exitosa más uno no exitoso que en este caso se trata de la creación de farmacias como se especificó.
<br>
* Diseñar e implementar al menos un test unitario exitoso del cálculo de distancias. 

> Para poder hacer el test unitario exitoso del cálculo de distancias al ser un método GET que recibe los parámetros indicados tanto de latitud como longitud se debe de procesar un factory en el cual se genere una farmacia y se tome su latitud como longitud para poder hacer el GET respectivo y recibir el estado 200.


<center>
<img src="https://i.imgur.com/wrBD7Dd.png" width="600">
</center>
<br>

* Diseñar e implementar una web singlepage en vue.js que solicite la ubicación del usuario(ubicación del navegador web) y liste las farmacias cercanas ordenadas por distancia. (Consumir la API previamente desarrollada)


> Al ingresar al Sistema el proyecto en Vue.js se verá empezando con la vista de Login, y es que como se había indicado cuenta con una autenticación con JWT. Por el momento recibe usuarios tipo Admin, básicamente cualquier usuario existente en la base de datos; caso contrario solicitará las credenciales para el acceso. Cabe aclarar que en caso no encuentre alguna farmacia dentro de su ubicación, se comprenderá que no hay alguna alrededor de 50 km de donde se encuentra, lo recomendable será entrar a la administración para crear tales farmacias cercanas.

<center>
<img src="https://i.imgur.com/JtHETdz.png" width="600">
</center>
<br>

Cabe destacar que en caso no se contemple de manera óptima el buen funcionamiento y consumo del proyecto se deberá ingresar en <b>resources/js/components/LoginComponent.vue</b> en la etiqueta <script/> para modificar el ENDPOINT_PATH y cambiar a la ruta local del servidor que se utilice, por defecto está en:

   ```sh
   const ENDPOINT_PATH = "http://127.0.0.1:8000/api/v1/";
```




<!-- CONTACT -->
## Contact

Luis Angel Mendoza Chate - email@lmendoza27@autonoma.edu.pe

Project Link: [https://github.com/lmendoza27/Pharmacy_FullStack-](https://github.com/lmendoza27/Pharmacy_FullStack-)

<p align="right">(<a href="#top">back to top</a>)</p>