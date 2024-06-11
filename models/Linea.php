<?php
    class Linea extends Conectar{
        public function insert_linea($linea_nom,$linea_est){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO lineas (linea_id, linea_nom, linea_est,fech_crea, est) 
                                VALUES (NULL,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $linea_nom);
            $sql->bindValue(2, $linea_est);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_linea($linea_id,$linea_nom,$linea_est){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lineas
                SET
                    linea_nom = ?,
                    linea_est = ?
                WHERE
                    linea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $linea_nom);
            $sql->bindValue(2, $linea_est);
            $sql->bindValue(3, $linea_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_linea($linea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET est=0 WHERE linea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$linea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function lineas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM lineas WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function lineas_id($linea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM lineas WHERE est = 1 AND linea_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$linea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($linea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET linea_est=1 WHERE linea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$linea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($linea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lineas SET linea_est=0 WHERE linea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$linea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>