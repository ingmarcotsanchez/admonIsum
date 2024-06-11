<?php
    class Autoevaluacion extends Conectar{
        public function insert_autoevaluacion($fac_id,$aut_ponderacion,$aut_califica,$aut_cumple,$aut_anno){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO autoevaluacion (aut_id, fac_id, aut_ponderacion, aut_califica, aut_cumple, aut_anno, fech_crea, est) 
                                VALUES (NULL,?,?,?,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $aut_ponderacion);
            $sql->bindValue(3, $aut_califica);
            $sql->bindValue(4, $aut_cumple);
            $sql->bindValue(5, $aut_anno);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_autoevaluacion($aut_id,$fac_id,$aut_ponderacion,$aut_califica,$aut_cumple,$aut_anno){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE autoevaluacion
                SET
                    fac_id = ?,
                    aut_ponderacion = ?,
                    aut_califica = ?,
                    aut_cumple = ?,
                    aut_anno = ?,
                    prof_sex = ?,
                    prof_telf = ?,
                    rol_id = ?,
                    esc_id = ?
                WHERE
                    aut_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $aut_ponderacion);
            $sql->bindValue(3, $aut_califica);
            $sql->bindValue(4, $aut_cumple);
            $sql->bindValue(5, $aut_anno);
            $sql->bindValue(6, $aut_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_autoevaluacion($aut_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE autoevaluacion SET est=0 WHERE aut_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$aut_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function autoevaluaciones(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }


        public function autoevaluaciones_id($aut_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion WHERE est = 1 AND aut_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$aut_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function autoevaluaciones2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                autoevaluacion.aut_id,
                factor.fac_id,
                factor.fac_cod,
                factor.fac_nombre,
                autoevaluacion.aut_ponderacion,
                autoevaluacion.aut_califica,
                autoevaluacion.aut_cumple,
                autoevaluacion.aut_anno
                FROM autoevaluacion
                INNER JOIN factor on autoevaluacion.fac_id = factor.fac_id
                WHERE autoevaluacion.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>