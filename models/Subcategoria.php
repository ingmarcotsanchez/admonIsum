<?php
    class Subcategoria extends Conectar{

        /* TODO: Obtener registros por id de categoria */
        public function get_subcategoria($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM subcategoria WHERE cat_id=? AND est=1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Obtener todos los registros sin filtro */
        public function get_subcategoria_all(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            subcategoria.cats_id,
            subcategoria.cat_id,
            subcategoria.cats_nom,
            categoria.cat_nom
            FROM subcategoria INNER JOIN
            categoria on subcategoria.cat_id = categoria.cat_id
            WHERE subcategoria.est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_subcategoria($cat_id,$cats_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO subcategoria (cats_id,cat_id,cats_nom,est) VALUES (NULL,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cats_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_subcategoria($cats_id,$cat_id,$cats_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE subcategoria set
                cat_id = ?,
                cats_nom = ?
                WHERE
                cats_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cats_nom);
            $sql->bindValue(3, $cats_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_subcategoria($cats_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE subcategoria SET
                est = 0
                WHERE 
                cats_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cats_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_subcategoria_x_id($cats_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM subcategoria WHERE cats_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cats_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>