<?php
    class Estudiante extends Conectar{
        public function insert_estudiante($est_dni, $est_tipo, $est_cedula,$est_nom,$est_apep,$est_apem,$est_fecnac,$est_correo,$est_sex,$est_telf,$est_seme,$est_egre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO estudiante (est_id, est_dni, est_tipo, est_cedula, est_nom, est_apep, est_apem, est_fecnac, est_correo, est_sex, est_telf, est_seme, est_egre, est_grado, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,'pendiente',1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_dni);
            $sql->bindValue(2, $est_tipo);
            $sql->bindValue(3, $est_cedula);
            $sql->bindValue(4, $est_nom);
            $sql->bindValue(5, $est_apep);
            $sql->bindValue(6, $est_apem);
            $sql->bindValue(7, $est_fecnac);
            $sql->bindValue(8, $est_correo);
            $sql->bindValue(9, $est_sex);
            $sql->bindValue(10, $est_telf);
            $sql->bindValue(11, $est_seme);
            $sql->bindValue(12, $est_egre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_estudiante($est_id,$est_dni, $est_tipo, $est_cedula,$est_nom,$est_apep,$est_apem,$est_fecnac,$est_correo,$est_sex,$est_telf,$est_seme,$est_egre,$est_grado){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE estudiante
                SET
                    est_dni = ?,
                    est_tipo = ?,
                    est_cedula = ?,
                    est_nom = ?,
                    est_apep = ?,
                    est_apem = ?,
                    est_fecnac = ?,
                    est_correo = ?,
                    est_sex = ?,
                    est_telf = ?,
                    est_seme = ?,
                    est_egre = ?,
                    est_grado = ?  
                WHERE
                    est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_dni);
            $sql->bindValue(2, $est_tipo);
            $sql->bindValue(3, $est_cedula);
            $sql->bindValue(4, $est_nom);
            $sql->bindValue(5, $est_apep);
            $sql->bindValue(6, $est_apem);
            $sql->bindValue(7, $est_fecnac);
            $sql->bindValue(8, $est_correo);
            $sql->bindValue(9, $est_sex);
            $sql->bindValue(10, $est_telf);
            $sql->bindValue(11, $est_seme);
            $sql->bindValue(12, $est_egre);
            $sql->bindValue(13, $est_grado);
            $sql->bindValue(14, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE estudiante SET est=0 WHERE est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes_id($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1 AND est_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
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

        /*TODO: Insert Curso por Usuario */
        public function insert_estudiante_asignatura($est_id,$asig_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO asignaturaXestudiante (asigxest_id,est_id,asig_id,asigxest_nota, asigxest_est,est) VALUES (NULL,?,?,'0.0',0,1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->bindValue(2, $asig_id);
            $sql->execute();
//conocer el último id insertado
            $sql1="select last_insert_id() as 'asigxest_id'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetch(pdo::FETCH_ASSOC);
        }

        public function total_estudiantes_activos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_ausentes(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_egresados(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=3";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_nograduado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=4";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_desertores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=5";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>