<?php
    class Semillero extends Conectar{
        public function insert_semillero($sem_nom,$sem_anno,$prof_id,$sem_linea){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO semilleros (sem_id, sem_nom, sem_anno, prof_id, sem_linea, est) VALUES (NULL,?,?,?,?,'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $sem_linea);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_semillero($sem_id,$sem_nom,$sem_anno,$prof_id,$sem_linea){
          
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE semilleros
                SET
                    sem_nom = ?,
                    sem_anno = ?,
                    prof_id = ?,
                    sem_linea = ?
                WHERE
                    sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_anno);
            $sql->bindValue(3, $prof_id);
            $sql->bindValue(4, $sem_linea);
            $sql->bindValue(5, $sem_id);
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
            semilleros.sem_linea,
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