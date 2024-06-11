<?php
    class Info extends Conectar{
        public function update($info_nombre, $info_snies, $info_resolucion, $info_creditos, $info_semestres, $info_metodologia, $info_nivel){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE informacion
                SET
                info_nombre = ?,
                info_snies = ?,
                info_resolucion = ?,
                info_creditos = ?,
                info_semestres = ?,
                info_metodologia = ?,
                info_nivel = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $info_nombre);
            $sql->bindValue(2, $info_snies);
            $sql->bindValue(3, $info_resolucion);
            $sql->bindValue(4, $info_creditos);
            $sql->bindValue(5, $info_semestres);
            $sql->bindValue(6, $info_metodologia);
            $sql->bindValue(7, $info_nivel);
            //$sql->bindValue(8, $info_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function info(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM informacion";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>