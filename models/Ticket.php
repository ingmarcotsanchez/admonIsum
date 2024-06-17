<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id, $cat_id, $tick_titulo, $tick_descrip ){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="INSERT INTO ticket (tick_id, usu_id, cat_id, tick_titulo, tick_descrip, fech_crea, est) VALUES (NULL, ?, ?, ?, ?, now(), 1)";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $tick_titulo);
            $sql->bindValue(4, $tick_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id, $usu_id, $cat_id, $tick_titulo, $tick_descrip ){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="UPDATE ticket
                    SET
                        usu_id = ?, 
                        cat_id = ?, 
                        tick_titulo = ?,
                        tick_descrip = ?
                    WHERE
                        tick_id = ?";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $tick_titulo);
            $sql->bindValue(4, $tick_descrip);
            $sql->bindValue(5, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

       

        public function delete_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket
                    SET
                        est = ?
                    WHERE
                        tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.cat_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.fech_crea,
                /* ticket.tick_estado,
                
                ticket.fech_cierre,
                ticket.usu_asig,
                ticket.fech_asig, */
                usuario.usu_nom,
                usuario.usu_apep,
                usuario.usu_apem,
                categoria.cat_id,
                categoria.cat_nom
                FROM 
                ticket
                INNER join categoria on ticket.cat_id = categoria.cat_id
                INNER join usuario on ticket.usu_id = usuario.usu_id
                /* INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id */
                WHERE
                ticket.est = 1
                AND usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
    }
?>