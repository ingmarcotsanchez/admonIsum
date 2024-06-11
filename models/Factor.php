<?php
    class Factor extends Conectar{
        public function insert_factor($fac_cod, $fac_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO factor (fac_id, fac_cod, fac_nombre, est) VALUES (NULL,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_cod);
            $sql->bindValue(2, $fac_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_factor($fac_id,$fac_cod,$fac_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE factor
                SET
                    fac_cod = ?,
                    fac_nombre = ?
                WHERE
                    fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_cod);
            $sql->bindValue(2, $fac_nombre);
            $sql->bindValue(3, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_factor($fac_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE factor SET est=0 WHERE fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function factor(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM factor WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function factor_id($fac_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM factor WHERE est = 1 AND fac_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>