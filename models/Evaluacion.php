<?php
    class Evaluacion extends Conectar{
        public function insert_evaluacion($prof_id,$eva_fecha,$eva_nota,$eva_est){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO evaluacion (eva_id, prof_id, eva_fecha, eva_nota, eva_est, est) VALUES (NULL,?,?,?,?,'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_id);
            $sql->bindValue(2, $eva_fecha);
            $sql->bindValue(3, $eva_nota);
            $sql->bindValue(4, $eva_est);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_evaluacion($eva_id,$prof_id,$eva_fecha,$eva_nota,$eva_est){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE evaluacion
                SET
                    prof_id = ?,
                    eva_fecha = ?,
                    eva_nota = ?,
                    eva_est = ?
                WHERE
                    eva_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_id);
            $sql->bindValue(2, $eva_fecha);
            $sql->bindValue(3, $eva_nota);
            $sql->bindValue(4, $eva_est);
            $sql->bindValue(5, $eva_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_evaluacion($eva_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE evaluacion SET est=0 WHERE eva_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$eva_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function notasxprofesorAll(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            evaluacion.eva_id,
            profesor.prof_id,
            profesor.prof_nom,
            profesor.prof_apep,
            profesor.prof_apem,
            evaluacion.eva_fecha,
            evaluacion.eva_nota,
            evaluacion.eva_est
            FROM evaluacion
            INNER JOIN profesor on evaluacion.prof_id = profesor.prof_id
            WHERE evaluacion.est = 1";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function notasxprofesor($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            evaluacion.eva_id,
            profesor.prof_id,
            profesor.prof_nom,
            profesor.prof_apep,
            profesor.prof_apem,
            evaluacion.eva_fecha,
            evaluacion.eva_nota,
            evaluacion.eva_est
            FROM evaluacion
            INNER JOIN profesor on evaluacion.prof_id = profesor.prof_id
            WHERE evaluacion.est = 1 AND profesor.prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaluaciones(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM evaluacion WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaluacion_id($eva_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM evaluacion WHERE est = 1 AND eva_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$eva_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_evaluaciones($prof_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM evaluacion WHERE prof_id=? AND est=1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>