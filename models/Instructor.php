<?php
    class Instructor extends Conectar{
        public function insert_categoria($id_categoria,$curso,$descripcion,$fecha_ini,$fecha_fin,$profesor){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO cursos (cur_id, id_categoria, curso, descripcion, fecha_ini, fecha_fin, profesor, fecha_crea, estado) 
            VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_categoria);
            $sql->bindValue(2, $curso);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $fecha_ini);
            $sql->bindValue(5, $fecha_fin);
            $sql->bindValue(6, $profesor);
            return $resultado = $sql->fetchAll();
        }

        public function update_categoria($cur_id,$id_categoria,$curso,$descripcion,$fecha_ini,$fecha_fin,$profesor){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_curso
                SET
                id_categoria =?,
                curso = ?,
                descripcion = ?,
                fecha_ini = ?,
                fecha_fin = ?,
                profesor = ?
                WHERE
                    cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_categoria);
            $sql->bindValue(2, $curso);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $fecha_ini);
            $sql->bindValue(5, $fecha_fin);
            $sql->bindValue(6, $profesor);
            $sql->bindValue(7, $cur_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_categoria($cur_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE cursos SET estado=0 WHERE cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function instructor(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM instructor WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function categoria_id($cur_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM cursos WHERE estado = 1 AND cur_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>