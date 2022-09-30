# Coodect Technologies
Hola!, Este es un desarrollo open source creado con livewire, laravel, alpine js, by Coodect Technologies
  
## Funcionalidades 📃​

* Dashboard
	* General
	* Ordenes
	* Blogs
	* Correos web
* Banners
* Nosotros
* Team
* Socios
* Galería
* Videos
* Blog
	* Post
	* Categorías
	* Etiquetas
* Correos web
* Ordenes
* Catalogo
	* Marcas
	* Género
	* Categorías
	* Productos
		* Colores
		* Medidas
		* Exportar productos con Excel
		* Importar productos con Excel
* Usuarios
	* Perfil
	* Ordenes
	* Ingresos
	* Direcciones de envío
	* Logs
	* Roles
	* Permisos
	* Cuenta conectada a Google
* Notificaciones de sistema
	* Orden nueva
	* Subscriptor nuevo
	* Correo web nuevo
	* Comentario nuevo
* Ajustes
	* Roles
	* Permisos
	* Información cuenta bancaria
	* Paises
	* Estados
	* Copias de seguridad
	* Clases de envío
	* Zonas de envío
	* Logs
	* Contacto

## Funciones a destacar 😎
A continuación algunas opciones a destacar sobre el desarrollo

### Copias de seguridad
		Por cada copia de seguridad de la base de datos, se mandará esta copia de seguridad al correo 
		que se te fue creado en el proyecto. Así teniendo siempre copias de seguridad en la nube 
		mediante el correo electrónico.
		
### Datos estadísticos
	Cada producto y blog creado almacenará aquellas visitas que recopila de cada usuario 
	que visita el producto / blog creado. 
	Adjuntando en el sistema graficas que representen estos comportamientos a lo largo del tiempo.

### Productos
	Capacidad para exportar productos masivamente con excel
	Capacidad para importar productos masivamente con excel

### Sitemap
	Automatización de generar un archivo sitemap.xml encargado de hacerle saber a Google que hay nuevo contenido en caso de que haya nuevo contenido creado en la página, (Nuevo producto, nuevo blog, etc).

### Imágenes
	Toda imagen insertada en el sistema será optimizada
	Toda imagen será convertida a formato webp por motivos de estandares de Google
	Imágenes en webp aumentan la optimización a nivel de página web

### Dashboard general
	Conoce inmediatamente lo siguiente
	* Cantidad de post
	* Cantidad de ordenes
	* Cantidad de comentarios
	* Cantidad de correos web
	* Ultimas 3 ordenes
	* Ultimos 3 post
	* Ultimos logs
	* Ultimos correos web

### Dashboard ordenes
	* Ingresos por día
	* Ingresos por mes
	* Ingresos total
	* Cantidad de ordenes procesando
	* Cantidad de ordenes completas
	* Cantidad de ordenes canceladas
	* Cantidad de productos publicados
	* Cantidad de productos en borrador
	* Cantidad de comentarios aprobados
	* Cantidad de productos NO aprobados
	* Gráfica de ingresos del año
	* Gráfica de cantidades de ordenes agrupadas por status (Completadas, Procesando, Canceladas)
	* Listado de ordenes procesando
	* Listado de ordenes recientes
	* Listado de los productos más vendidos
	* Listado de los productos más vistos
	* Listado de productos con un stock bajo
	* Listado de comentarios no aprobados

# ¿Eres desarrollador? 
De ser así puedes seguir leyendo la documentación para su mantenimiento a futuro.

## Templates utilizados 🌐​
* Metronic v8 (admin)

## Comenzando ​🕛​
Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local._

### Pre-requisitos 📃​
_Que cosas necesitas para instalar el software y como instalarlas_

```
1.- PHP v7.4+

2.- Servidor XAMMP, WAMPP o Laragon

```

### a: Instalación 🔧
_1.- Deberás de instalar las dependencias de laravel con el siguiente comando_

```
git clone https://github.com/CoodectTechnologies/administrator.git

composer install

```

_2.- Una vez que se terminen de descargar el proyecto y las dependencias_

```
php artisan key:generate
```

_3.- Deberás de rellenar las variables del archivo .env.example, una vez finalizado le podrás cambiar el nombre a .env_
__

_4.- Ejecutando las migraciones_

```
php artisan migrate:fresh --seed

```
### b: Instalación con  docker compose
- `git clone https://github.com/CoodectTechnologies/administrator.git && cd administrator`
- `cp .env.example .env`
- `docker compose up -d --build` ( despues configurar credenciales de email)
- `docker compose exec app sh -s 'composer install'`
- `docker compose exec app sh -s 'php artisan key:generate'`
- `docker compose exec app sh -s 'php artisan migrate:fresh --seed'`
- `docker compose exec app sh -s 'php artisan storage:link'`

acceder a : https://localhost/admin

### Configuración ​⚙️​

**Correo:**
_1.- Deberás de configurar las variables de entorno MAIL con tus datos de acceso de tu dominio o datos de prueba con mailtrap o el que prefieras. Esto para el funcionamiento de envíos de correo._

**Google Socialite:**
_1.- Habilitar la API de google analytics en [Console Cloud Google](https://console.cloud.google.com/)_
_2.- Deberás de obtener tus credenciales y remplazar las variables de GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT_URL_

## Ejecutar comando schedule ​⚙️​
**_El sistema cuenta con 3 comandos por default en Kernel_**

**_backup:run --only-db este comando generará una copia de tu base de datos semanalmente y la enviará al correo que tengas en tu variable de .env DB_BACKUP_EMAIL_**

**_sitemap:generate este comando generará un archivo sitemap.xml en tu carpeta public, con todas las rutas publicas que crees en el sistema_**

**_queue:work --stop-when-empty este comando ejecutará todas las colas que vallas a tener en el sistema_**

## Herramientas ​​✒️
**_Dependencias de laravel que ayudaron a la construcción del proyecto_**
```
	* asantibanez/livewire-charts
	* cviebrock/eloquent-sluggable
	* cyrildewit/eloquent-viewable
	* hardevine/shoppingcart
	* intervention/image
	* jackiedo/dotenv-editor
	* laravel/socialite
	* laravel/ui
	* livewire/livewire
	* lukeraymonddowning/honey
	* maatwebsite/excel
	* mercadopago/dx-php
	* spatie/laravel-activitylog
	* spatie/laravel-backup
	* spatie/laravel-permission
```
## Autor ❤️
* **Agencia en desarrollo de software** - [www.coodect.com] 😊
---
