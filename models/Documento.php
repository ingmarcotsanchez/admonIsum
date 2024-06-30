<?php
    class Documento extends Conectar{
    /* Docuemntos del ticket */
        public function insert_documento($tick_id,$doc_nom){
            $conectar= parent::conexion();
            $sql="INSERT INTO documentos (doc_id,tick_id,doc_nom,fech_crea,est) VALUES (null,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$tick_id);
            $sql->bindParam(2,$doc_nom);
            $sql->execute();
        }

        
        public function get_documento_x_ticket($tick_id){
            $conectar= parent::conexion();
            $sql="SELECT * FROM documentos WHERE tick_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$tick_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }

        /* Docuemntos del detalle de ticket */
        public function insert_documento_detalle($dtick_id,$det_nom){
            $conectar= parent::conexion();
            $sql="INSERT INTO documentos_detalle (det_id,dtick_id,det_nom,est) VALUES (null,?,?,1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$dtick_id);
            $sql->bindParam(2,$det_nom);
            $sql->execute();
        }


        public function get_documento_detalle_x_ticketd($dtick_id){
            $conectar= parent::conexion();
            $sql="SELECT * FROM documentos_detalle WHERE dtick_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$dtick_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>