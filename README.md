# VetCare - Sistema de Gestión Veterinaria 🐾

![VetCare Banner](public/img/dogs_banner.png)

## Descripción

**VetCare** es una plataforma moderna y eficiente diseñada específicamente para clínicas veterinarias. Facilita la administración integral de pacientes, citas médicas, inventario y facturación, proporcionando un panel de control intuitivo tanto para administradores como para el personal veterinario.

El sistema fue desarrollado con el objetivo de optimizar los flujos de trabajo diarios de la clínica, mejorando la experiencia del usuario y asegurando un seguimiento detallado de la salud de las mascotas.

## Características Principales ✨

- **Control de Acceso Basado en Roles (RBAC):** Interfaces personalizadas para perfiles de *Administrador* y *Veterinario*.
- **Gestión de Citas Médicas:** Panel dinámico para ver las citas del día, pendientes y completadas.
- **Expedientes Clínicos:** Registro de mascotas, historiales de consultas, vacunas y desparasitaciones.
- **Dashboard Estadístico:** Visualización de ingresos, servicios más solicitados (consultas, vacunación, cirugías) y resúmenes mensuales.
- **Interfaz Moderna y Responsiva:** Diseño claro y amigable desarrollado sobre el framework de Laravel y SB Admin 2 (con un tema personalizado "Light/Purple").

## Tecnologías Utilizadas 🛠️

- **Backend:** Laravel (PHP)
- **Base de Datos:** MySQL
- **Frontend:** HTML5, CSS3 (Bootstrap 4 / SB Admin 2 Modificado), JavaScript
- **Autenticación:** Sistema de autenticación de Laravel con gestión de roles

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- Servidor Web (Apache/Nginx o Artisan CLI)
- MySQL >= 8.0 o MariaDB

## Instalación 🚀

Sigue estos pasos para levantar el entorno de desarrollo en tu máquina local:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/YvnPretty/veterinaria.git
   cd veterinaria
   ```

2. **Instalar las dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   - Duplica el archivo de configuración base:
     ```bash
     cp .env.example .env
     ```
   - Configura las credenciales de tu base de datos en el nuevo archivo `.env`.

4. **Generar la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones:**
   ```bash
   php artisan migrate:fresh
   ```

6. **Iniciar el servidor local:**
   ```bash
   php artisan serve
   ```
   El proyecto estará disponible en `http://localhost:8000`.

## Autor

Desarrollado y mantenido por **YvnPretty**.

---
*Hecho con ❤️ para el cuidado de los que no tienen voz.*
