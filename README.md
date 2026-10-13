# Sistema de Autenticacion y Gestion de Transacciones (CRUD)

Aplicacion web desarrollada con **CakePHP 5** para la gestion de usuarios y control de transacciones financieras. El sistema implementa una arquitectura MVC estricta con autenticacion basada en sesiones seguras, politicas de denegacion por defecto (Deny-by-Default), proteccion contra ataques CSRF y encriptacion criptografica de contraseñas.

---

## Caracteristicas Principales

* **Sistema de Autenticacion Completo:** Flujos de Registro, Inicio de Sesion y Cierre de Sesion gestionados a traves del plugin oficial `CakePHP Authentication`.
* **Proteccion Global de Rutas (Deny-by-Default):** Todas las URLs y controladores (`UsersController`, `TransactionsController`) se encuentran protegidos por defecto. Unicamente las rutas `/login` y `/register` son de acceso publico.
* **Seguridad Criptografica de Contraseñas:** Hashing unidireccional utilizando **Bcrypt** con generacion de salt dinamico mediante `DefaultPasswordHasher`. Las contraseñas estan excluidas de cualquier serializacion mediante la propiedad `$_hidden`.
* **Manejo Seguro de Sesiones:** Sesiones del lado del servidor gestionadas con cookies seguras y proteccion activa contra ataques CSRF (`CsrfProtectionMiddleware` con atributo `HttpOnly`).
* **CRUD Protegido de Usuarios:** Administracion completa de cuentas de usuario con validaciones de unicidad de correo y longitud minima de contraseña.
* **CRUD Protegido de Transacciones con Integridad Referencial:** Registro, edicion, listado y eliminacion de transacciones financieras. El sistema vincula automaticamente la transaccion a la identidad autenticada (`user_id`), evitando la suplantacion de identidad.
* **Diseño Responsivo e Independiente:** Interfaz estilizada con CSS3 nativo, sin dependencias de frameworks CSS externos pesados.

---

## Requisitos del Sistema

* **PHP:** >= 8.2 (con extensiones activas: `intl`, `mbstring`, `pdo_mysql`, `openssl`).
* **Manejador de Dependencias:** Composer 2.x o superior.
* **Base de Datos:** MySQL 5.7+ / MariaDB 10.3+ (o SQLite).
* **Servidor Web:** Apache / Nginx / CakePHP Built-in Server.

---

## Instalacion y Puesta en Marcha

Sigue estos pasos para desplegar la aplicacion en tu entorno local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/TU_REPOSITORIO.git
cd S3P3_CRUD_Login/app
```

### 2. Instalar dependencias

Ejecuta Composer para descargar las librerias del framework y sus plugins:

```bash
composer install
```

### 3. Configurar la base de datos

Copia el archivo de configuracion local de ejemplo:

```bash
cp config/app_local.example.php config/app_local.php
```

Abre `config/app_local.php` y configura tus credenciales de conexion a la base de datos:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'tu_usuario',
        'password' => 'tu_contraseña',
        'database' => 'nombre_base_datos',
    ],
],
```

### 4. Ejecutar Migraciones y Seeds

Crea las tablas en la base de datos y carga los datos de prueba iniciales:

```bash
# Ejecutar migraciones (creacion de tablas users y transactions)
bin/cake migrations migrate

# Sembrar datos iniciales de prueba
bin/cake migrations seed
```

### 5. Iniciar el Servidor de Desarrollo

Levanta el servidor integrado de CakePHP:

```bash
bin/cake server
```

Por defecto, la aplicacion estara disponible en: `http://localhost:8765`

---

## Credenciales de Acceso por Defecto

Para ingresar inmediatamente con los datos sembrados por el Seeder:

* **Correo:** `mateoenriquez@gmail.com`
* **Contraseña:** `Mateo12345*`

Tambien puedes registrar un nuevo usuario desde la ruta `/register`.

---

## Arquitectura y Estructura del Proyecto

```text
app/
├── config/
│   ├── Migrations/          # Definicion del esquema de base de datos
│   ├── Seeds/               # Datos iniciales de prueba
│   ├── routes.php           # Enrutamiento de URLs
│   └── app_local.php        # Credenciales locales (ignorado en Git)
├── src/
│   ├── Application.php      # Pipeline de Middlewares y AuthenticationService
│   ├── Controller/
│   │   ├── AppController.php          # Controlador base: carga global de autenticacion
│   │   ├── UsersController.php        # Logica de Login, Register y CRUD de usuarios
│   │   └── TransactionsController.php # Logica del CRUD protegido de transacciones
│   ├── Model/
│   │   ├── Entity/
│   │   │   ├── User.php               # Entidad Usuario con hashing Bcrypt mutador
│   │   │   └── Transaction.php        # Entidad Transaccion
│   │   └── Table/
│   │       ├── UsersTable.php         # Reglas de validacion e integridad
│   │       └── TransactionsTable.php  # Asociaciones relacionales (belongsTo / hasMany)
│   └── View/                          # Logica de renderizado de vistas
├── templates/
│   ├── layout/default.php   # Layout maestro con navbar dinamica y alertas Flash
│   ├── Users/               # Vistas de login, register, index, add, edit
│   └── Transactions/        # Vistas de index, add, edit
└── webroot/                 # Archivos estaticos publicos (CSS, imagenes, fuentes)
```

---

## Implementacion de Seguridad

1. **Mutador en Entidad (`User.php`):**
   El metodo `_setPassword(string $password)` aplica `(new DefaultPasswordHasher())->hash($password)` en el momento exacto en que la entidad es poblada o modificada.
2. **Deny-by-Default (`AppController.php`):**
   `$this->loadComponent('Authentication.Authentication')` bloquea preventivamente todas las acciones. Cualquier metodo que requiera acceso publico debe ser explicitamente declarado mediante `$this->Authentication->addUnauthenticatedActions(...)`.
3. **Asociacion de Usuario en Servidor (`TransactionsController.php`):**
   El identificador de usuario `user_id` nunca se confia a parametros enviados por el cliente (`POST`), sino que se obtiene directamente de la sesion validada: `$this->Authentication->getIdentity()->getIdentifier()`.

---

## Licencia

Proyecto academico desarrollado para la asignatura de **Ingenieria Web** - Universidad de Las Américas (UDLA).
