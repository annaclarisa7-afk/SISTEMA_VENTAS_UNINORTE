<?php

// La clase Usuario hereda las funciones de la clase Conectar
class Usuario extends Conectar
{
    // Obtiene todos los usuarios activos sin eliminación lógica
    public function get_usuario()
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT usu_id, usu_nom, usu_sesion, usu_clave,
                       DATE_FORMAT(fech_crea, '%d/%m/%Y %H:%i') as fech_crea,
                       DATE_FORMAT(fech_modi, '%d/%m/%Y %H:%i') as fech_modi,
                       fech_elim
                FROM tm_usuario
                WHERE fech_elim IS NULL";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // Obtiene un usuario específico mediante su ID
    public function get_usuario_x_id($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT * FROM tm_usuario WHERE usu_id = ? AND fech_elim IS NULL";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // Eliminación lógica de un usuario actualizando fech_elim
    public function delete_usuario($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE tm_usuario
                SET
                    fech_elim = now()
                WHERE
                    usu_id = ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // Inserta un nuevo usuario
    public function insert_usuario($usu_nom, $usu_sesion, $usu_clave)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO tm_usuario
                (usu_id, usu_nom, usu_sesion, usu_clave, fech_crea, fech_modi, fech_elim)
                VALUES (NULL, ?, ?, ?, now(), NULL, NULL)";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_sesion);
        $sql->bindValue(3, $usu_clave);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // Actualiza los datos del usuario. Si la contraseña no se envía o está vacía, se mantiene la actual.
    public function update_usuario($usu_id, $usu_nom, $usu_sesion, $usu_clave = "")
    {
        $conectar = parent::conexion();
        parent::set_names();

        if (empty($usu_clave)) {
            // Actualización sin cambiar la contraseña
            $sql = "UPDATE tm_usuario
                    SET
                        usu_nom = ?,
                        usu_sesion = ?,
                        fech_modi = now()
                    WHERE
                        usu_id = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_sesion);
            $sql->bindValue(3, $usu_id);
        } else {
            // Actualización cambiando también la contraseña
            $sql = "UPDATE tm_usuario
                    SET
                        usu_nom = ?,
                        usu_sesion = ?,
                        usu_clave = ?,
                        fech_modi = now()
                    WHERE
                        usu_id = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_sesion);
            $sql->bindValue(3, $usu_clave);
            $sql->bindValue(4, $usu_id);
        }

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
}
?>