*Esta herramienta digital forma parte del catálogo de herramientas del **Banco Interamericano de Desarrollo**. Puedes conocer más sobre la iniciativa del BID en [code.iadb.org](code.iadb.org)*

## API del Sistema CIUM (Captura de Indicadores en Unidades Médicas).

  

[![Build Status](https://travis-ci.org/checherman/CIUM-API.svg?branch=master)]

### Descripción y contexto
---
<p style="text-align: justify;">
La secretaria de salud (ISECH) a través de la Dirección de Informática, con el apoyo del Proyecto Salud Mesoamérica 2015 (SM2015), Ponen en marcha la mejora de los sistemas de medición de calidad y abastos en las unidades médicas (etab y cium), esto con el fin de proporcionar las herramientas de monitoreo de una forma sencilla y a la vez más completa que permitan la correcta toma de decisiones y acciones en base a la medición de sus indicadores.
</p>

### Guía de usuario
---
##### Manual de Usuario:
Para guiar y ser mas explicito a cualquier usuario encargado para trabajar con CIUM

 > - [Manual de usuario](public/api/Contents) [pdf](public/manual-usuario.pdf)

  
##### Manual Técnico:

Para la continuidad en el desarrollo de CIUM se brinda un Manual Técnico:

[ver](public/doc)

### Guía de instalación
---
#### Requisitos
##### Software
Para poder instalar y utilizar esta API, deberá asegurarse de que su servidor cumpla con los siguientes requisitos:

* [APACHE]('http://www.apache.org/')
* [PHP 5.6]('https://secure.php.net/')  o superior 
* [MYSQL]('https://www.mysql.com/')
* [LARAVEL 5.2]('http://laravel.com/docs/master') o superios

* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* [Composer](https://getcomposer.org/) es una librería de PHP para el manejo de dependencias.
* Opcional [Postman](https://www.getpostman.com/) que permite el envío de peticiones HTTP REST sin necesidad de desarrollar un cliente.

#### Instalación
Guia de Instalación Oficial de Laravel 5.2 [Aquí](https://laravel.com/docs/5.2/installation)
##### Proyecto (API)
El resto del proceso es sencillo.
1. Clonar el repositorio con: `git clone https://github.com/checherman/CIUM-API.git`
2. Instalar dependencias: `composer install`
3. Renombrar el archivo `base.env` a `.env` ubicado en la raiz del directorio de instalación y editarlo.

```   
        APP_ENV=local                                                              // Definir el entorno ejemplo local, producción o testing 
        APP_DEBUG=true                                                             // Habilitar/Deshabilitar el debug de laravel
        APP_KEY=base64:6LGdKVVArWgzNMMPPgCzoteVB093uiLVL8VDrPyQlrU=                // Clave de cifrado

        DB_HOST=localhost                                                          // HOST de la base de datos
        DB_DATABASE=CIUM                                                           // Nombre de la base de datos 
        DB_USERNAME=root                                                           // Usuario de la base de datos 
        DB_PASSWORD=                                                               // Contraseña de la base de datos 

        CACHE_DRIVER=file                                                          
        SESSION_DRIVER=file                                                        

        OAUTH_SERVER = http://api.oa2.che                                          // Ruta del servidor de OAUTH 2.0 (Solo si se va usar) 
        CLIENT_ID=1111                                                             // ID del cliente en el servidor OAUTH 2.0
        CLIENT_SECRET=1111                                                         // Clave secreta del cliente en OAUTH 2.0

        JWT_SECRET=1111                                                            // Clave de encritacion para jwt
        JWT_BLACKLIST_ENABLED = false                                              // Habilitar/Deshabilitar lista negra

        NOCAPTCHA_SECRET=6LfJlxUUAAAAAH1v6rrt1iV0Fg5I63T2Z9OZYIuF                  // Clave secreta para google recaptcha v2
        NOCAPTCHA_SITEKEY=6LfJlxUUAAAAADhVzxCiIYsZ8aCOlhanl4h8q3nL                 // Clave de sitio para google recaptcha v2

        CORREO_CONTACTO=ejemplo@gmail.com                                          // Correo del administrador del sitio para las notificaciones por correo

        MAIL_DRIVER=smtp                                                           // Configuración para el envio de correo 
        MAIL_HOST=smtp.gmail.com                                                   
        MAIL_PORT=587                                                                   
        MAIL_USERNAME=ejemplo@gmail.com
        MAIL_PASSWORD=1234567890
        MAIL_ENCRYPTION=tls
        MAIL_ADDRESS=contacto@algo.com.mx
        MAIL_NAME=CIUM

        APP_RUTA=http://localhost/cium/ANGULAR                                      // Ruta del cliente web de CIUM 

```
       
    
* **APP_KEY**: Clave de encriptación para laravel.
* **APP_DEBUG**: `true` o `false` dependiento si desea o no tener opciones de debug en el código.
* **DB_HOST**: Dominio de la conexión a la base de datos.
* **DB_DATABASE**: Nombre de la base de datos.
* **DB_USERNAME**: Usuario con permisos de lectura y escritura para la base de datos.
* **DB_PASSWORD**: Contraseña del usuario.

* **CLIENT_ID**: ID de la cliente para conexion con salud id.
* **CLIENT_SECRET**: Llave para el proyecto salud id.

##### Base de Datos del proyecto
> - 1.- Crear la base de datos Cium	[ver](database)
> - 2.- Correr el script para generar los schemas 
> - 3.- Instalar la libreria sudo apt-get install php5-mysqlnd o yum install php56w-mysqlnd para el retorno de tipos de datos de mysql
> - 4.- Una vez configurado el proyecto se inicia con `php artisan serve` y nos levanta un servidor: 
    * `http://127.0.0.1:8000` o su equivalente `http://localhost:8000`

### Cómo contribuir
---
Si deseas contribuir con este proyecto, por favor lee las siguientes guías que establece el [BID](https://www.iadb.org/es "BID"):

* [Guía para Publicar Herramientas Digitales](https://el-bid.github.io/guia-de-publicacion/ "Guía para Publicar") 
* [Guía para la Contribución de Código](https://github.com/EL-BID/Plantilla-de-repositorio/blob/master/CONTRIBUTING.md "Guía de Contribución de Código")

### Código de conducta 
---
Puedes ver el código de conducta para este proyecto en el siguiente archivo [CODEOFCONDUCT.md](https://github.com/EL-BID/Supervision-SISBEN-ML/blob/master/CODEOFCONDUCT.md).

### Autor/es
---
> - Secretaria de salud del estado de chiapas ISECH
> - Salud Mesoamerica 2015 SM2015
> - akira.redwolf@gmail.com 
> - h.cortes@gmail.com 
> * **[Eliecer Ramirez Esquinca](https://github.com/checherman "Github")**

### Información adicional
---
Para usar el sistema completo con una interfaz web y/o movil y no solo realizar las peticiones HTTP REST, debe tener configurado el siguiente proyecto:
* **[Cliente WEB CIUM](https://github.com/checherman/CIUM-WEB "Proyecto WEB que complenta el sistema")**
* **[Cliente ANDROID CIUM](https://github.com/joramdeveloper/CIUM_movil "Proyecto WEB que complenta el sistema")**

### Licencia 
---
La Documentación de Soporte y Uso del software se encuentra licenciada bajo Creative Commons IGO 3.0 Atribución-NoComercial-SinObraDerivada (CC-IGO 3.0 BY-NC-ND)  [LICENSE.md](https://github.com/checherman/CIUM-API/blob/master/LICENSE.md)

## Limitación de responsabilidades

El BID no será responsable, bajo circunstancia alguna, de daño ni indemnización, moral o patrimonial; directo o indirecto; accesorio o especial; o por vía de consecuencia, previsto o imprevisto, que pudiese surgir:

i. Bajo cualquier teoría de responsabilidad, ya sea por contrato, infracción de derechos de propiedad intelectual, negligencia o bajo cualquier otra teoría; y/o

ii. A raíz del uso de la Herramienta Digital, incluyendo, pero sin limitación de potenciales defectos en la Herramienta Digital, o la pérdida o inexactitud de los datos de cualquier tipo. Lo anterior incluye los gastos o daños asociados a fallas de comunicación y/o fallas de funcionamiento de computadoras, vinculados con la utilización de la Herramienta Digital.
