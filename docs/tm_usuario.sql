-- Estructura de la tabla `tm_usuario` para la base de datos `ventas`
-- Conforme a las especificaciones requeridas para el Trabajo Práctico

USE `ventas`;

CREATE TABLE IF NOT EXISTS `tm_usuario` (
  `usu_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usu_nom` VARCHAR(150) NOT NULL COMMENT 'Nombre del usuario',
  `usu_sesion` VARCHAR(150) NOT NULL COMMENT 'Nombre de usuario para iniciar sesión',
  `usu_clave` VARCHAR(150) NOT NULL COMMENT 'Contraseña del usuario',
  `fech_crea` DATETIME NOT NULL COMMENT 'Fecha de creación del registro',
  `fech_modi` DATETIME DEFAULT NULL COMMENT 'Fecha de última modificación',
  `fech_elim` DATETIME DEFAULT NULL COMMENT 'Fecha de eliminación lógica',
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Datos de prueba iniciales (basados en el ejemplo de referencia del documento)
INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_sesion`, `usu_clave`, `fech_crea`, `fech_modi`, `fech_elim`) VALUES
(1, 'Administrador', 'admin', '123456', '2025-10-01 08:30:00', '2025-10-02 10:15:00', NULL),
(2, 'Juan Pérez', 'jperez', '123456', '2025-10-05 14:20:00', '2025-10-05 14:20:00', NULL),
(3, 'María Gómez', 'mgomez', '123456', '2025-10-10 09:10:00', '2025-10-12 16:45:00', NULL);
