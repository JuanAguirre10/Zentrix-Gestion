@extends('layouts.app')

@section('title', 'Configuración')

@section('header', 'Configuración del Sistema')

@section('content')
<div class="row">
    <!-- Navegación lateral de configuraciones -->
    <div class="col-md-3">
        <div class="config-sidebar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                    <i class="fas fa-user me-2"></i>Perfil de Usuario
                </button>
                <button class="nav-link" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab">
                    <i class="fas fa-key me-2"></i>Seguridad
                </button>
                <button class="nav-link" id="v-pills-institution-tab" data-bs-toggle="pill" data-bs-target="#v-pills-institution" type="button" role="tab">
                    <i class="fas fa-building me-2"></i>Institución
                </button>
                <button class="nav-link" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab">
                    <i class="fas fa-cogs me-2"></i>Sistema
                </button>
                <button class="nav-link" id="v-pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notifications" type="button" role="tab">
                    <i class="fas fa-bell me-2"></i>Notificaciones
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido de configuraciones -->
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            
            <!-- PERFIL DE USUARIO -->
            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel">
                <div class="config-section">
                    <div class="section-header">
                        <h4><i class="fas fa-user me-2"></i>Perfil de Usuario</h4>
                        <p class="text-muted">Actualiza tu información personal y datos de contacto</p>
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>Perfil actualizado exitosamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="profile-image-section">
                                    <div class="current-image">
                                        <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" 
                                             alt="Avatar" class="profile-avatar">
                                    </div>
                                    <div class="mt-3">
                                        <label for="avatar" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-camera me-1"></i>Cambiar Foto
                                        </label>
                                        <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="{{ old('phone', $user->phone ?? '') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Cargo</label>
                                        <input type="text" class="form-control" id="position" name="position" 
                                               value="{{ old('position', $user->position ?? 'Administrador') }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SEGURIDAD -->
            <div class="tab-pane fade" id="v-pills-account" role="tabpanel">
                <div class="config-section">
                    <div class="section-header">
                        <h4><i class="fas fa-key me-2"></i>Seguridad de la Cuenta</h4>
                        <p class="text-muted">Gestiona la seguridad de tu cuenta y contraseña</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Contraseña Actual</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                    @error('current_password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-lock me-1"></i>Actualizar Contraseña
                                </button>
                            </div>

                            <div class="col-md-6">
                                <div class="security-info">
                                    <h6>Recomendaciones de Seguridad</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Usa al menos 8 caracteres</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Incluye mayúsculas y minúsculas</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Incluye números</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Incluye símbolos especiales</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- INSTITUCIÓN -->
            <div class="tab-pane fade" id="v-pills-institution" role="tabpanel">
                <div class="config-section">
                    <div class="section-header">
                        <h4><i class="fas fa-building me-2"></i>Configuración de la Institución</h4>
                        <p class="text-muted">Información y configuraciones de Zentrix Grupo de Estudios</p>
                    </div>

                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="institution_name" class="form-label">Nombre de la Institución</label>
                                    <input type="text" class="form-control" id="institution_name" 
                                           value="Zentrix Grupo de Estudios" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="institution_address" class="form-label">Dirección</label>
                                    <textarea class="form-control" id="institution_address" rows="3">Av. Principal 123, Lima, Perú</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="institution_phone" class="form-label">Teléfono Principal</label>
                                    <input type="tel" class="form-control" id="institution_phone" value="+51 1 234-5678">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="institution_email" class="form-label">Email de Contacto</label>
                                    <input type="email" class="form-control" id="institution_email" 
                                           value="contacto@zentrix.edu.pe">
                                </div>

                                <div class="mb-3">
                                    <label for="institution_website" class="form-label">Sitio Web</label>
                                    <input type="url" class="form-control" id="institution_website" 
                                           value="https://www.zentrix.edu.pe">
                                </div>

                                <div class="mb-3">
                                    <label for="academic_year" class="form-label">Año Académico</label>
                                    <select class="form-select" id="academic_year">
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SISTEMA -->
            <div class="tab-pane fade" id="v-pills-system" role="tabpanel">
                <div class="config-section">
                    <div class="section-header">
                        <h4><i class="fas fa-cogs me-2"></i>Configuraciones del Sistema</h4>
                        <p class="text-muted">Personaliza la apariencia y comportamiento del sistema</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="setting-group">
                                <h6>Apariencia</h6>
                                <div class="mb-3">
                                    <label for="theme" class="form-label">Tema</label>
                                    <select class="form-select" id="theme">
                                        <option value="light">Claro</option>
                                        <option value="dark">Oscuro</option>
                                        <option value="auto">Automático</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="language" class="form-label">Idioma</label>
                                    <select class="form-select" id="language">
                                        <option value="es">Español</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="setting-group">
                                <h6>Regional</h6>
                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Zona Horaria</label>
                                    <select class="form-select" id="timezone">
                                        <option value="America/Lima">Lima (UTC-5)</option>
                                        <option value="America/Bogota">Bogotá (UTC-5)</option>
                                        <option value="America/Mexico_City">Ciudad de México (UTC-6)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="currency" class="form-label">Moneda</label>
                                    <select class="form-select" id="currency">
                                        <option value="PEN">Soles Peruanos (S/)</option>
                                        <option value="USD">Dólares ($)</option>
                                        <option value="EUR">Euros (€)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="setting-group">
                                <h6>Configuraciones Avanzadas</h6>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="auto_backup" checked>
                                    <label class="form-check-label" for="auto_backup">
                                        Respaldo automático diario
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_reports" checked>
                                    <label class="form-check-label" for="email_reports">
                                        Enviar reportes por email
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="maintenance_mode">
                                    <label class="form-check-label" for="maintenance_mode">
                                        Modo mantenimiento
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar Configuración
                        </button>
                    </div>
                </div>
            </div>

            <!-- NOTIFICACIONES -->
            <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel">
                <div class="config-section">
                    <div class="section-header">
                        <h4><i class="fas fa-bell me-2"></i>Configuración de Notificaciones</h4>
                        <p class="text-muted">Controla qué notificaciones quieres recibir y cómo</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="notification-group">
                                <h6>Notificaciones por Email</h6>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_new_students" checked>
                                    <label class="form-check-label" for="email_new_students">
                                        Nuevos estudiantes registrados
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_payments" checked>
                                    <label class="form-check-label" for="email_payments">
                                        Pagos recibidos
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_overdue">
                                    <label class="form-check-label" for="email_overdue">
                                        Pagos vencidos
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="email_reports" checked>
                                    <label class="form-check-label" for="email_reports">
                                        Reportes mensuales
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="notification-group">
                                <h6>Notificaciones del Sistema</h6>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="system_updates" checked>
                                    <label class="form-check-label" for="system_updates">
                                        Actualizaciones del sistema
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="system_backups" checked>
                                    <label class="form-check-label" for="system_backups">
                                        Confirmación de respaldos
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="system_errors">
                                    <label class="form-check-label" for="system_errors">
                                        Errores del sistema
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar Preferencias
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.config-sidebar {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.config-sidebar .nav-link {
    color: #6c757d;
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 5px;
    transition: all 0.3s ease;
    text-align: left;
}

.config-sidebar .nav-link:hover {
    background: #f8f9fa;
    color: #007bff;
}

.config-sidebar .nav-link.active {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.config-section {
    background: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.section-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 15px;
    margin-bottom: 25px;
}

.section-header h4 {
    color: #2c3e50;
    margin-bottom: 5px;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
}

.security-info {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
}

.setting-group {
    margin-bottom: 30px;
}

.setting-group h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e9ecef;
}

.notification-group {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.notification-group h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 15px;
}

.form-check-switch .form-check-input {
    width: 3em;
    height: 1.5em;
}

.form-check-switch .form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}
</style>
@endsection

@section('scripts')
<script>
// Preview de imagen de perfil
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.profile-avatar').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Validación de contraseña en tiempo real
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /\d/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };
    
    // Aquí puedes agregar indicadores visuales de los requisitos
});
</script>
@endsection