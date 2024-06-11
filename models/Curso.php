<?php
    class Curso extends Conectar{
        public function curso(){
            $conectar = parent::Conexion();
            parent::set_names();
            //$sql = "SELECT * FROM cursos WHERE estado = 1";
            $sql = "
            SELECT
                cursos.cur_id,
                cursos.curso,
                cursos.descripcion,
                cursos.fecha_ini,
                cursos.fecha_fin,
                cursos.id_categoria,
                categoria.nombre,
                cursos.profesor,
                instructor.nombrei,
                instructor.ape_paternoi,
                instructor.ape_maternoi,
                instructor.correo,
                instructor.sexo,
                instructor.telefono
                FROM cursos
                INNER JOIN categoria on cursos.id_categoria = categoria.id
                INNER JOIN instructor on cursos.profesor = instructor.inst_id
                WHERE cursos.estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insert_curso($id_categoria,$curso,$descripcion,$fecha_ini,$fecha_fin,$profesor){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO cursos (cur_id, id_categoria, curso, descripcion, fecha_ini, fecha_fin, profesor, fecha_crea, estado) VALUES (NULL,?,?,?,?,?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_categoria);
            $sql->bindValue(2, $curso);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $fecha_ini);
            $sql->bindValue(5, $fecha_fin);
            $sql->bindValue(6, $profesor);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_curso($cur_id,$id_categoria,$curso,$descripcion,$fecha_ini,$fecha_fin,$profesor){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE cursos
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

        public function delete_curso($cur_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE cursos SET estado=0 WHERE cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }  

        public function curso_id($cur_id){
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