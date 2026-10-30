-- ========================================================
-- Script de Base de Datos para PostgreSQL
-- Compatible con PostgreSQL 12+
-- ========================================================

-- Opcional: Crear base de datos (ejecutar antes como superusuario si no existe)
-- CREATE DATABASE taller_db WITH ENCODING 'UTF8';

-- --------------------------------------------------------
-- Tabla: clientes
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS clientes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    direccion VARCHAR(200) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado SMALLINT DEFAULT 1
);

-- --------------------------------------------------------
-- Tabla: configuracion
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS configuracion (
    id SERIAL PRIMARY KEY,
    nombre_sistema VARCHAR(100) DEFAULT 'Sistema Taller',
    moneda VARCHAR(10) DEFAULT 'PEN',
    simbolo_moneda VARCHAR(5) DEFAULT 'S/',
    impuesto NUMERIC(5,2) DEFAULT 18.00,
    telefono VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    direccion TEXT DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    logo VARCHAR(100) DEFAULT NULL,
    terminos_orden TEXT DEFAULT NULL,
    mensaje_ticket VARCHAR(255) DEFAULT '¡Gracias por su preferencia!'
);

INSERT INTO configuracion (id, nombre_sistema, moneda, simbolo_moneda, impuesto, telefono, email, direccion, updated_at, logo, terminos_orden, mensaje_ticket)
VALUES (1, 'Taller Pro', 'PEN', 'S/', 18.00, '', '', '', '2025-12-26 20:03:42', 'logo_1766779180.png', NULL, '¡Gracias por su preferencia!')
ON CONFLICT (id) DO NOTHING;

-- --------------------------------------------------------
-- Tabla: usuarios
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) DEFAULT 'tecnico' CHECK (rol IN ('admin', 'tecnico', 'vendedor')),
    estado SMALLINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (id, nombre, email, password, rol, estado, created_at)
VALUES (1, 'Administrador', 'admin@taller.com', '$2y$10$WVB1Io6aUFuZvY9dfnT4c.9dfopRl3REY92A9t2rfxOESDS82yF1G', 'admin', 1, '2025-12-26 18:36:20')
ON CONFLICT (id) DO NOTHING;

-- --------------------------------------------------------
-- Tabla: productos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS productos (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE DEFAULT NULL,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT DEFAULT NULL,
    precio_compra NUMERIC(10,2) DEFAULT NULL,
    precio_venta NUMERIC(10,2) DEFAULT NULL,
    stock INTEGER DEFAULT 0,
    categoria VARCHAR(20) DEFAULT 'repuesto' CHECK (categoria IN ('repuesto', 'accesorio', 'equipo')),
    imagen VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado SMALLINT DEFAULT 1
);

-- --------------------------------------------------------
-- Tabla: ordenes_servicio
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS ordenes_servicio (
    id SERIAL PRIMARY KEY,
    cliente_id INTEGER NOT NULL REFERENCES clientes(id) ON DELETE RESTRICT,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE RESTRICT,
    tipo_servicio VARCHAR(20) DEFAULT 'taller' CHECK (tipo_servicio IN ('taller', 'domicilio')),
    direccion_servicio VARCHAR(200) DEFAULT NULL,
    fecha_recepcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_promesa TIMESTAMP DEFAULT NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'pendiente',
    equipo_tipo VARCHAR(50) DEFAULT NULL,
    equipo_marca VARCHAR(50) DEFAULT NULL,
    equipo_modelo VARCHAR(50) DEFAULT NULL,
    equipo_serie VARCHAR(100) DEFAULT NULL,
    falla_reportada TEXT DEFAULT NULL,
    observaciones_tecnicas TEXT DEFAULT NULL,
    costo_mano_obra NUMERIC(10,2) DEFAULT 0.00,
    total NUMERIC(10,2) DEFAULT 0.00
);

-- --------------------------------------------------------
-- Tabla: orden_repuestos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS orden_repuestos (
    id SERIAL PRIMARY KEY,
    orden_id INTEGER NOT NULL REFERENCES ordenes_servicio(id) ON DELETE CASCADE,
    producto_id INTEGER NOT NULL REFERENCES productos(id) ON DELETE RESTRICT,
    cantidad INTEGER NOT NULL,
    precio_unitario NUMERIC(10,2) NOT NULL,
    subtotal NUMERIC(10,2) NOT NULL
);

-- --------------------------------------------------------
-- Tabla: historial_ordenes
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS historial_ordenes (
    id SERIAL PRIMARY KEY,
    orden_id INTEGER NOT NULL REFERENCES ordenes_servicio(id) ON DELETE CASCADE,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE RESTRICT,
    accion VARCHAR(255) NOT NULL,
    detalle VARCHAR(255) DEFAULT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
-- Tabla: gastos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS gastos (
    id SERIAL PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    categoria VARCHAR(50) DEFAULT 'General',
    monto NUMERIC(10,2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_id INTEGER REFERENCES usuarios(id) ON DELETE SET NULL
);

-- --------------------------------------------------------
-- Tabla: kardex
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS kardex (
    id SERIAL PRIMARY KEY,
    producto_id INTEGER NOT NULL REFERENCES productos(id) ON DELETE RESTRICT,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE RESTRICT,
    tipo VARCHAR(10) NOT NULL CHECK (tipo IN ('entrada', 'salida')),
    cantidad INTEGER NOT NULL,
    stock_anterior INTEGER NOT NULL,
    stock_actual INTEGER NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
-- Tabla: ventas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS ventas (
    id SERIAL PRIMARY KEY,
    cliente_id INTEGER REFERENCES clientes(id) ON DELETE SET NULL,
    usuario_id INTEGER DEFAULT 1 REFERENCES usuarios(id) ON DELETE SET NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total NUMERIC(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
-- Tabla: detalle_ventas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS detalle_ventas (
    id SERIAL PRIMARY KEY,
    venta_id INTEGER NOT NULL REFERENCES ventas(id) ON DELETE CASCADE,
    producto_id INTEGER NOT NULL REFERENCES productos(id) ON DELETE RESTRICT,
    cantidad INTEGER NOT NULL,
    precio_unitario NUMERIC(10,2) NOT NULL,
    subtotal NUMERIC(10,2) NOT NULL
);

-- Reset de secuencias para los registros iniciales insertados manualmente
SELECT setval('configuracion_id_seq', (SELECT MAX(id) FROM configuracion));
SELECT setval('usuarios_id_seq', (SELECT MAX(id) FROM usuarios));

