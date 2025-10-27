# TODO: Modificar Carrito de Compras para Mostrar Productos en Tarjetas y Agregar Sección de Productos Disponibles

## Tareas Pendientes
- [x] Actualizar `app/Livewire/Admin/ShoppingCart.php` para incluir 'image' y 'stock' en el array de productos.
- [x] Modificar `resources/views/livewire/admin/shopping-cart.blade.php` para mostrar productos en tarjetas de e-commerce (imagen, nombre, precio, stock, cantidad, precio editable, remover).
- [x] Corregir accessor de imagen en `app/Models/Product.php` para usar ruta correcta.
- [x] Verificar que el cálculo del total siga funcionando correctamente.
- [x] Probar la funcionalidad de agregar, editar y remover productos.
- [x] Agregar sección de productos disponibles con stock en grid de 2 columnas, mostrando nombre, imagen, precio y stock, con botón para agregar al carrito.
- [x] Agregar método addProductById en ShoppingCart.php para agregar productos desde la sección de disponibles.
- [x] Eliminar sección duplicada de productos disponibles en la vista.
- [x] Cambiar productos del carrito de tabla a tarjetas.
- [x] Arreglar cálculo del total en el componente para incluir ITBIS (18%).
- [x] Limpiar Alpine.js para evitar conflictos.
