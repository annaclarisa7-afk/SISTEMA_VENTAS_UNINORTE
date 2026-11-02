CREATE TABLE IF NOT EXISTS `tm_producto` (
  `prod_id` INT(11) NOT NULL AUTO_INCREMENT,
  `prod_nom` VARCHAR(150) NOT NULL,
  `est` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tm_producto` (`prod_nom`, `est`) VALUES
('Laptop', 1),
('Mouse', 1),
('Teclado', 1);