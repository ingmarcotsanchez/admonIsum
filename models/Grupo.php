<?php
    class Grupo extends Conectar{
        public function insert_grupo($grup_nom,$grup_est){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO grupos (grup_id, grup_nom, grup_est,fech_crea, est) 
                                VALUES (NULL,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $grup_nom);
            $sql->bindValue(2, $grup_est);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_grupo($grup_id,$grup_nom,$grup_est){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE grupos
                SET
                    grup_nom = ?,
                    grup_est = ?
                WHERE
                    grup_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $grup_nom);
            $sql->bindValue(2, $grup_est);
            $sql->bindValue(3, $grup_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_grupo($grup_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE grupos SET est=0 WHERE grup_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$grup_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function grupos(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM grupos WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function grupos_id($grup_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM grupos WHERE est = 1 AND grup_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$grup_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($grup_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE grupos SET grup_est=1 WHERE grup_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$grup_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($grup_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE grupos SET grup_est=0 WHERE grup_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$grup_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>