<?php
    class Semillero extends Conectar{
        public function insert_semillero($sem_nom,$sem_anno,$prof_id,$grup_id,$linea_id,$sublinea_id,$sem_mision,$sem_vision,$sem_objetivo){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO semilleros (sem_id, sem_nom, sem_anno, prof_id, grup_id, linea_id, sublinea_id, sem_mision, sem_vision, sem_objetivo, est) VALUES (NULL,?,?,?,?,?,?,?,?,?,'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $grup_id);
            $sql->bindValue(5, $linea_id);
            $sql->bindValue(6, $sublinea_id);
            $sql->bindValue(7, $sem_mision);
            $sql->bindValue(8, $sem_vision);
            $sql->bindValue(9, $sem_objetivo);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_semillero($sem_id,$sem_nom,$sem_anno,$prof_id,$grup_id,$linea_id,$sublinea_id,$sem_mision,$sem_vision,$sem_objetivo){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE semilleros
                SET
                    sem_nom = ?,
                    sem_anno = ?,
                    prof_id = ?,
                    grup_id = ?,
                    linea_id = ?,
                    sublinea_id = ?,
                    sem_mision = ?,
                    sem_vision = ?,
                    sem_objetivo = ?
                WHERE
                    sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $grup_id);
            $sql->bindValue(5, $linea_id);
            $sql->bindValue(6, $sublinea_id);
            $sql->bindValue(7, $sem_mision);
            $sql->bindValue(8, $sem_vision);
            $sql->bindValue(9, $sem_objetivo);
            $sql->bindValue(10, $sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_semillero($sem_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE semilleros SET est=0 WHERE sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sem_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function lideresxsemillero(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            semilleros.sem_id,
            semilleros.sem_nom,
            semilleros.sem_anno,
            profesor.prof_id,
            profesor.prof_nom,
            profesor.prof_apep,
            profesor.prof_apem
            FROM semilleros
            INNER JOIN profesor on semilleros.prof_id = profesor.prof_id
            WHERE semilleros.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_semilleroDetallexid($sem_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            semilleros.sem_id,
            semilleros.sem_nom,
            semilleros.sem_anno,
            profesor.prof_id,
            profesor.prof_nom,
            profesor.prof_apep,
            profesor.prof_apem,
            grupos.grup_id,
            grupos.grup_nom,
            lineas.linea_id,
            lineas.linea_nom,
            sublineas.sublinea_id,
            sublineas.sublinea_nom,
            semilleros.sem_mision,
            semilleros.sem_vision,
            semilleros.sem_objetivo
            FROM semilleros
            INNER JOIN profesor on semilleros.prof_id = profesor.prof_id
            INNER JOIN grupos on semilleros.grup_id = grupos.grup_id
            INNER JOIN lineas on semilleros.linea_id = lineas.linea_id
            INNER JOIN sublineas on semilleros.sublinea_id = sublineas.sublinea_id
            WHERE semilleros.sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function semilleros(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semilleros WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function semillero_id($sem_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM semilleros WHERE est = 1 AND sem_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sem_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_semilleros(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM semilleros WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>