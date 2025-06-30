# 🎓 Zentrix - Sistema de Gestión Académica

![Zentrix Logo](public/images/zentrix-logo.png)

**Zentrix Grupo de Estudios** es un sistema integral de gestión académica desarrollado con Laravel que permite administrar de manera eficiente estudiantes, matrículas, pagos, cursos y horarios en instituciones educativas.

## ✨ Características Principales

### 📚 Gestión Académica Completa
- **Estudiantes**: Registro completo con datos personales, académicos y familiares
- **Apoderados**: Gestión de responsables con información de contacto
- **Matrículas**: Control total del proceso de matriculación
- **Cursos**: Administración de materias y niveles educativos
- **Horarios**: Programación de clases con control de conflictos

### 💰 Gestión Financiera
- **Pagos**: Registro y seguimiento de pagos con múltiples métodos
- **Comprobantes**: Generación automática de recibos
- **Reportes**: Estadísticas financieras en tiempo real
- **Control de Morosos**: Seguimiento de pagos pendientes

### 📊 Dashboard y Reportes
- **Panel de Control**: Vista general con métricas importantes
- **Estadísticas en Tiempo Real**: Contadores dinámicos
- **Reportes Visuales**: Gráficos y tablas interactivas
- **Historial Completo**: Seguimiento de todas las actividades

### 🔐 Seguridad y Usuarios
- **Autenticación**: Sistema de login seguro
- **Perfiles de Usuario**: Gestión de cuentas y permisos
- **Configuración**: Panel completo de ajustes del sistema

## 🚀 Tecnologías Utilizadas

- **Backend**: Laravel 10.x (PHP 8.2+)
- **Frontend**: Bootstrap 5.3, Font Awesome 6.4
- **Base de Datos**: MySQL 8.0+
- **Autenticación**: Laravel Breeze
- **Almacenamiento**: Laravel Storage (local/cloud)

## 📋 Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 16.x (para compilar assets)
- Extensiones PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON

## 🛠️ Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/tu-usuario/zentrix-gestion.git
cd zentrix-gestion
```

### 2. Instalar Dependencias
```bash
# Dependencias PHP
composer install

# Dependencias Node.js (si usas)
npm install
```

### 3. Configuración del Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Crear enlace simbólico para storage
php artisan storage:link
```

### 4. Configurar Base de Datos
Edita el archivo `.env` con tus credenciales:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zentrix_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar Migraciones
```bash
# Crear tablas
php artisan migrate

# Ejecutar seeders (opcional)
php artisan db:seed
```

### 6. Configurar Permisos
```bash
# Permisos de storage
chmod -R 775 storage bootstrap/cache

# Propietario (en producción)
chown -R www-data:www-data storage bootstrap/cache
```

### 7. Iniciar Servidor
```bash
# Servidor de desarrollo
php artisan serve

# Acceder a: http://localhost:8000
```

## 📁 Estructura del Proyecto

```
zentrix-gestion/
├── app/
│   ├── Http/Controllers/     # Controladores principales
│   ├── Models/              # Modelos Eloquent
│   └── Http/Requests/       # Validaciones de formularios
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/            # Datos de prueba
├── public/
│   └── images/             # Logos y assets
├── resources/
│   └── views/
│       ├── admin/          # Vistas del sistema
│       ├── layouts/        # Plantillas base
│       └── profile/        # Configuración de usuario
└── routes/
    └── web.php             # Rutas del sistema
```

## 🎯 Funcionalidades por Módulo

### 👨‍🎓 Estudiantes
- ✅ Registro completo con validaciones
- ✅ Búsqueda y filtros avanzados
- ✅ Historial académico
- ✅ Relación con apoderados
- ✅ Estados (activo, inactivo, graduado)

### 👨‍👩‍👧‍👦 Apoderados
- ✅ Datos de contacto completos
- ✅ Relación con múltiples estudiantes
- ✅ Historial de comunicaciones

### 📝 Matrículas
- ✅ Proceso de matriculación paso a paso
- ✅ Asignación de cursos y horarios
- ✅ Cálculo automático de costos
- ✅ Estados de matrícula
- ✅ Descuentos y promociones

### 💳 Pagos
- ✅ Múltiples métodos de pago
- ✅ Generación de comprobantes
- ✅ Control de pagos en exceso
- ✅ Estados: completado, pendiente, anulado
- ✅ Reportes financieros

### 📚 Cursos
- ✅ Gestión por niveles educativos
- ✅ Información detallada
- ✅ Asignación de horarios
- ✅ Control de cupos

### ⏰ Horarios
- ✅ Programación semanal
- ✅ Control de conflictos
- ✅ Asignación de salones
- ✅ Cupos máximos

## 🔧 Configuración Avanzada

### Variables de Entorno Importantes
```env
APP_NAME="Zentrix Grupo de Estudios"
APP_URL=http://localhost:8000
APP_TIMEZONE=America/Lima

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña
```

### Configuración de Storage
```bash
# Para imágenes de perfil
mkdir storage/app/public/avatars

# Para comprobantes
mkdir storage/app/public/comprobantes
```

## 📱 Uso del Sistema

### Acceso Inicial
1. Crear usuario administrador:
```bash
php artisan tinker
User::create([
    'name' => 'Administrador',
    'email' => 'admin@zentrix.edu.pe',
    'password' => Hash::make('admin123'),
    'role' => 'admin'
]);
```

2. Acceder con las credenciales creadas
3. Configurar información de la institución en el panel

### Flujo de Trabajo Recomendado
1. **Configurar** cursos y horarios
2. **Registrar** apoderados
3. **Registrar** estudiantes
4. **Crear** matrículas
5. **Gestionar** pagos

## 🚀 Despliegue en Producción

### Optimizaciones
```bash
# Cache de configuración
php artisan config:cache

# Cache de rutas
php artisan route:cache

# Cache de vistas
php artisan view:cache

# Optimización de autoloader
composer install --optimize-autoloader --no-dev
```

### Seguridad
- Cambiar `APP_DEBUG=false` en producción
- Usar HTTPS
- Configurar backup automático
- Implementar monitoreo de logs

## 🤝 Contribuciones

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear un Pull Request

## 📞 Soporte

- **Email**: soporte@zentrix.edu.pe
- **Teléfono**: +51 1 234-5678
- **Dirección**: Av. Principal 123, Lima, Perú
