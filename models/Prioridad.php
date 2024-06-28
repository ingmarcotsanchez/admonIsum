<?php
    class Prioridad extends Conectar{
        public function insert_prioridad($prio_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO prioridad (prio_id,prio_nom, est) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prio_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_prioridad($prio_id,$prio_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE prioridad
                SET
                    prio_nom = ?
                WHERE
                    prio_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prio_nom);
            $sql->bindValue(2, $prio_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_prioridad($prio_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE prioridad SET est=0 WHERE prio_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prio_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function prioridad(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM prioridad WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function prioridad_id($prio_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM prioridad WHERE est = 1 AND prio_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prio_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_prioridad(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM prioridad WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>