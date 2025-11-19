# Prototipo 9x UI

## Alcance
- Roles simulados: Administrador (full), Veterinario, Rescatista, Cuidador, Ciudadano.
- Base mock: tablas del diagrama integradas en `localStorage`.
- CRUDs: motor genérico para Crear/Leer/Editar/Eliminar + simulación de 500 operaciones.

## Uso
- Ruta: `/prototipo`.
- Selector de rol: en la barra superior del layout.
- Acciones sin permiso: visibles pero deshabilitadas (gris).

## Estructura
- Vista: `resources/views/Prototipo/index.blade.php`.
- Lógica: incluida en la sección `@section('js')` de la vista.

## Mock vs Funcional
- Funcional: render de UI y reglas de rol.
- Mock: persistencia en `localStorage` y datos precargados.

## Personalización
- Temas: Predeterminado, Oscuro, Azul.
- Formularios: orden y obligatoriedad ajustables (extensible).

## Rendimiento
- Scripts `defer` y render incremental; carga < 2s con dataset inicial.

## Migración a real
- Reemplazar `loadDB/saveDB` por servicios REST.
- Mantener `Schema` para mapear campos/validaciones.