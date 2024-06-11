<?php
    class Semestre extends Conectar{
        public function insert_semestre($seme_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO semestres (seme_id, seme_nombre, est) VALUES (NULL,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $seme_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_semestre($seme_id,$seme_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE semestres
                SET
                    seme_nombre = ?
                WHERE
                    seme_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $seme_nombre);
            $sql->bindValue(2, $seme_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_semestre($seme_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE semestres SET est=0 WHERE seme_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$seme_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function semestre(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semestres WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function semestre_id($seme_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semestres WHERE est = 1 AND seme_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$seme_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>