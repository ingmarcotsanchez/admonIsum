<?php
    class Asignatura extends Conectar{
        public function insert_asignatura($asig_nom,$asig_alfa,$asig_nrc,$asig_cred,$asig_horas,$seme_id){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO asignaturas (asig_id, asig_nom, asig_alfa, asig_nrc, asig_cred, asig_horas, seme_id, est) 
                                VALUES (NULL,?,?,?,?,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asig_nom);
            $sql->bindValue(2, $asig_alfa);
            $sql->bindValue(3, $asig_nrc);
            $sql->bindValue(4, $asig_cred);
            $sql->bindValue(5, $asig_horas);
            $sql->bindValue(6, $seme_id);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_asignatura($asig_id,$asig_nom,$asig_alfa,$asig_nrc,$asig_cred,$asig_horas,$seme_id){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE asignaturas
                SET
                    asig_nom = ?,
                    asig_alfa = ?,
                    asig_nrc = ?,
                    asig_cred = ?,
                    asig_horas = ?,
                    seme_id = ?
                WHERE
                    asig_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $asig_nom);
            $sql->bindValue(2, $asig_alfa);
            $sql->bindValue(3, $asig_nrc);
            $sql->bindValue(4, $asig_cred);
            $sql->bindValue(5, $asig_horas);
            $sql->bindValue(6, $seme_id);
            $sql->bindValue(7, $asig_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_asignatura($asig_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE asignaturas SET est=0 WHERE asig_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$asig_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignaturas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM asignaturas WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignaturas2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                asignaturas.asig_id,
                asignaturas.asig_nom,
                asignaturas.asig_alfa,
                asignaturas.asig_nrc,
                asignaturas.asig_cred,
                asignaturas.asig_horas,
                semestres.seme_id,
                semestres.seme_nombre
                FROM asignaturas
                INNER JOIN semestres on asignaturas.seme_id = semestres.seme_id
                WHERE asignaturas.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function asignaturas_mantenimiento($est_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM asignaturas WHERE asignaturas.est = 1
                AND asig_id not in (select asig_id from asignaturaXestudiante where est_id=?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function asignaturas_id($asig_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM asignaturas WHERE est = 1 AND asig_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$asig_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_asignaturas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM asignaturas WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>