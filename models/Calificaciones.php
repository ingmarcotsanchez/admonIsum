<?php
    class calificacion extends Conectar{

        public function calificaciones($est_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                asignaturaXestudiante.asigxest_id,
                asignaturaXestudiante.est_id,
                asignaturaXestudiante.asig_id,
                estudiante.est_id,
                estudiante.est_nom,
                estudiante.est_apep,
                estudiante.est_apem,
                asignaturas.asig_id,
                asignaturas.asig_nom,
                asignaturas.asig_alfa,
                asignaturas.asig_nrc,
                asignaturaXestudiante.asigxest_nota,
                asignaturaXestudiante.asigxest_est
                FROM asignaturaXestudiante
                INNER JOIN estudiante on asignaturaXestudiante.est_id = estudiante.est_id
                INNER JOIN asignaturas on asignaturaXestudiante.asig_id = asignaturas.asig_id
                WHERE asignaturaXestudiante.est_id = ? AND asignaturaXestudiante.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante_asignatura($asigxest_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE asignaturaXestudiante
                SET
                    est = 0
                WHERE
                    asigxest_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asigxest_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estudiante_asignatura($asigxest_id, $asigxest_nota, $asigxest_est ){
            $conectar= parent::conexion();
            parent::set_names();
            /*if($asigxest_nota > 2.9){
                $sql="UPDATE asignaturaXestudiante
                    SET
                        asigxest_nota = ?,
                        asigxest_est = 1
                    WHERE
                        asigxest_id = ?";
            }else{*/
                $sql="UPDATE asignaturaXestudiante
                    SET
                        asigxest_nota = ?,
                        asigxest_est = ?
                    WHERE
                        asigxest_id = ?";
            //}
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asigxest_nota);
            $sql->bindValue(2, $asigxest_est);
            $sql->bindValue(3, $asigxest_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function calificaciones_id($asigxest_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM asignaturaXestudiante WHERE est = 1 AND asigxest_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$asigxest_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function obtenerCreditosAprobados($est_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT SUM(asignaturas.asig_cred) as total_creditos
                FROM asignaturaXestudiante
                INNER JOIN asignaturas ON asignaturaXestudiante.asig_id = asignaturas.asig_id
                WHERE asignaturaXestudiante.est_id = ? AND asignaturaXestudiante.asigxest_nota >= ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->bindValue(2, 3.0);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        }

        public function total_creditos($asigxest_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT 
                    asignaturaXestudiante.asigxest_id, 
                    asignaturaXestudiante.asig_id, 
                    asignaturas.asig_id, 
                    asignaturas.asig_cred, 
                    asignaturaXestudiante.asigxest_nota,
                    asignaturaXestudiante.asigxest_est 
                    FROM asignaturaXestudiante 
                    INNER JOIN asignaturas ON asignaturaXestudiante.asig_id = asignaturas.asig_id 
                    WHERE asignaturaXestudiante.asigxest_nota > 2.9 
                    AND asignaturaXestudiante.asigxest_est =1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$asigxest_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        
    }
?>