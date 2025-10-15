# Sistema de Reporte Rápido de Animales en Riesgo

## Descripción
Sistema de acceso rápido para reportar animales en situación de emergencia, especialmente durante incendios. Permite a usuarios sin cuenta registrada realizar reportes de manera inmediata.

## Características Implementadas

### 1. Botón de Acceso Rápido en Login
- Botón "Reporte Rápido" con icono de advertencia
- Estilo AdminLTE3 con color de advertencia (amarillo)
- Acceso directo desde la página de login

### 2. Página de Reporte Rápido
- **Ubicación**: `resources/views/ReporteRapido/index.blade.php`
- **Ruta**: `/reporte-rapido`

#### Funcionalidades:
- **Mapa interactivo**: Utiliza Leaflet para mostrar ubicación
- **Marcado de ubicación**: Click en el mapa para marcar posición exacta
- **Formulario completo** con las siguientes opciones:

#### Campos del Formulario:
1. **Tipo de Emergencia**:
   - Animales en Incendio (por defecto)
   - Otra Emergencia

2. **Tipo de Usuario**:
   - Solo estoy reportando
   - Soy rescatista (muestra campo CI)

3. **Cédula de Identidad** (solo para rescatistas):
   - Campo obligatorio cuando se selecciona "Soy rescatista"
   - Se muestra/oculta dinámicamente

4. **Cantidad de Animales**:
   - Campo numérico obligatorio
   - Mínimo 1 animal

5. **Tipo de Animales** (Opcional):
   - Domésticos
   - Silvestres
   - Mixtos

6. **Observaciones Adicionales**:
   - Campo de texto libre
   - Máximo 1000 caracteres

### 3. Página de Confirmación
- **Ubicación**: `resources/views/ReporteRapido/confirmacion.blade.php`
- Muestra resumen completo del reporte enviado
- Diseño atractivo con iconos y colores
- Opciones para nuevo reporte o volver al login

### 4. Validaciones Implementadas
- Validación de ubicación (latitud/longitud requeridas)
- Validación de campos obligatorios
- Validación de CI para rescatistas
- Confirmación antes de enviar

## Rutas Agregadas

```php
// Mostrar formulario de reporte rápido
Route::get('/reporte-rapido', function () {
    return view('ReporteRapido.index');
})->name('reporte-rapido');

// Procesar reporte rápido
Route::post('/reporte-rapido', function (Request $request) {
    // Validaciones y procesamiento
})->name('reporte-rapido.store');
```

## Tecnologías Utilizadas

- **Frontend**: AdminLTE3, Bootstrap 4, Font Awesome
- **Mapas**: Leaflet.js
- **Backend**: Laravel (rutas y validaciones)
- **JavaScript**: Vanilla JS para interactividad

## Estructura de Archivos

```
resources/views/
├── auth/
│   └── login.blade.php (modificado - botón agregado)
└── ReporteRapido/
    ├── index.blade.php (formulario principal)
    └── confirmacion.blade.php (página de confirmación)

routes/
└── web.php (rutas agregadas)
```

## Funcionalidades JavaScript

1. **Inicialización del Mapa**:
   - Coordenadas por defecto: Santa Cruz, Bolivia
   - Marcador al hacer click
   - Guardado automático de coordenadas

2. **Validación Dinámica**:
   - Mostrar/ocultar campo CI según tipo de usuario
   - Validación de ubicación antes de enviar
   - Confirmación de envío

3. **Interactividad**:
   - Cambio dinámico de campos
   - Validación en tiempo real
   - Feedback visual

## Próximos Pasos Sugeridos

1. **Base de Datos**: Crear migración para tabla `reportes_rapidos`
2. **Notificaciones**: Integrar sistema de notificaciones
3. **API**: Crear endpoints para móviles
4. **Dashboard**: Panel de administración para ver reportes
5. **Geolocalización**: Detectar ubicación automáticamente

## Uso

1. Acceder a la página de login
2. Hacer click en "Reporte Rápido"
3. Marcar ubicación en el mapa
4. Completar formulario
5. Enviar reporte
6. Ver confirmación

El sistema está listo para usar y puede ser extendido según las necesidades específicas del proyecto.
