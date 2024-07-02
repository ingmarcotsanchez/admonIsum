<?php
    class Notificacion extends Conectar{
        public function get_notificacion_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM notificaciones WHERE usu_id = ? AND est = 2 limit 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_notificacion_x_estado($not_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE notificaciones SET est=1 WHERE not_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $not_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_notificacion_x_estado_read($not_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE notificaciones SET est=0 WHERE not_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $not_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }