<?php
    class Cv extends Conectar{
        /* TODO: Insertar registro  */
        public function insert_cv($prof_id,$cv_nom){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="INSERT INTO cv (cv_id,prof_id,cv_nom,fech_crea,est) VALUES (null,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$prof_id);
            $sql->bindParam(2,$cv_nom);
            $sql->execute();
        }

        public function get_cv_x_profesor($prof_id){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM cv WHERE prof_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>