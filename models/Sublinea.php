<?php
    class Sublinea extends Conectar{
        public function insert_sublinea($sublinea_nom,$sublinea_est){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO sublineas (sublinea_id, sublinea_nom, sublinea_est,fech_crea, est) 
                                VALUES (NULL,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sublinea_nom);
            $sql->bindValue(2, $sublinea_est);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_sublinea($sublinea_id,$sublinea_nom,$sublinea_est){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sublineas
                SET
                    sublinea_nom = ?,
                    sublinea_est = ?
                WHERE
                    sublinea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sublinea_nom);
            $sql->bindValue(2, $sublinea_est);
            $sql->bindValue(3, $sublinea_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_sublinea($sublinea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE sublineas SET est=0 WHERE sublinea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sublinea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function sublineas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM sublineas WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function sublineas_id($sublinea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM sublineas WHERE est = 1 AND sublinea_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sublinea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($sublinea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE sublineas SET sublinea_est=1 WHERE sublinea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sublinea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($sublinea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE sublineas SET sublinea_est=0 WHERE sublinea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sublinea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>