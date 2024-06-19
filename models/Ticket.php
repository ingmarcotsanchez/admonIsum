<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id, $cat_id, $tick_titulo, $tick_descrip ){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="INSERT INTO ticket (tick_id, usu_id, cat_id, tick_titulo, tick_descrip, tick_estado, fech_crea, est) VALUES (NULL, ?, ?, ?, ?, 'Abierto', now(), 1)";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $tick_titulo);
            $sql->bindValue(4, $tick_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="UPDATE ticket
                    SET
                        tick_estado = 'Cerrado',
                        fech_cierre = now()
                    WHERE
                        tick_id = ?";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
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
                ticket.tick_estado,
                ticket.fech_cierre,
                ticket.usu_asig,
                ticket.fech_asig,
                usuario.usu_id,
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

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.cat_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.tick_estado,
                ticket.fech_crea,
                ticket.fech_cierre,
                ticket.usu_asig,
                ticket.fech_asig,
                usuario.usu_nom,
                usuario.usu_apep,
                usuario.usu_apem,
                categoria.cat_nom
                /* ticket.prio_id,
                prioridad.prio_nom */
                FROM 
                ticket
                INNER join categoria on ticket.cat_id = categoria.cat_id
                INNER join usuario on ticket.usu_id = usuario.usu_id
                /* INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id */
                WHERE
                ticket.est = 1
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.cat_id,
                /* ticket.cats_id, */
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.tick_estado,
                ticket.fech_crea,
                /* ticket.fech_cierre,
                ticket.tick_estre,
                ticket.tick_coment, */
                usuario.usu_nom,
                usuario.usu_apep,
                usuario.usu_apem,
                usuario.usu_correo,
                /* usuario.usu_telf, */
                categoria.cat_nom
                /* subcategoria.cats_nom,
                ticket.prio_id,
                prioridad.prio_nom */
                FROM 
                ticket
                INNER join categoria on ticket.cat_id = categoria.cat_id
                /* INNER join subcategoria on ticket.cats_id = subcategoria.cats_id */
                INNER join usuario on ticket.usu_id = usuario.usu_id
                /* INNER join prioridad on ticket.prio_id = prioridad.prio_id */
                WHERE
                ticket.est = 1
                AND ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                detalle_ticket.dtick_id,
                detalle_ticket.dtick_descrip,
                detalle_ticket.fech_crea,
                usuario.usu_nom,
                usuario.usu_apep,
                usuario.usu_apem,
                usuario.usu_rol
                FROM 
                detalle_ticket
                INNER join usuario on detalle_ticket.usu_id = usuario.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id,$usu_id,$dtick_descrip){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="INSERT INTO detalle_ticket (dtick_id,tick_id,usu_id,dtick_descrip,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $dtick_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                //$sql="call sp_i_ticketdetalle_01(?,?)";
            $sql="INSERT INTO detalle_ticket (dtick_id,tick_id,usu_id,dtick_descrip,fech_crea,est) VALUES (NULL,?,?,'Ticket Cerrado',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        /* TODO: Insertar linea adicional al reabrir el ticket */
      /*    public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="	INSERT INTO td_ticketdetalle 
                    (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) 
                    VALUES 
                    (NULL,?,?,'Ticket Re-Abierto...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } */


        /* TODO:Cambiar estado del ticket al reabrir */
       /*   public function reabrir_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estado = 'Abierto'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } */

         public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update ticket 
                set	
                    usu_asig = ?,
                    fech_asig = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();

            /* $sql1="INSERT INTO tm_notificacion (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null,?,'Se le ha asignado el ticket Nro : ',?,2)";
            $sql1=$conectar->prepare($sql1);
            $sql1->bindValue(1, $usu_asig);
            $sql1->bindValue(2, $tick_id);
            $sql1->execute(); */

            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT categoria.cat_nom AS nom,COUNT(*) AS total
            FROM ticket JOIN categoria ON ticket.cat_id = categoria.cat_id  
            WHERE ticket.est = 1
            GROUP BY 
            categoria.cat_nom 
            ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Actualizar valor de estrellas de encuesta */
         /* public function insert_encuesta($tick_id,$tick_estre,$tick_comment){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estre = ?,
                    tick_coment = ?
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_estre);
            $sql->bindValue(2, $tick_comment);
            $sql->bindValue(3, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } */

        /* TODO: Filtro Avanzado de ticket */
        /* public function filtrar_ticket($tick_titulo,$cat_id,$prio_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call filtrar_ticket (?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, "%".$tick_titulo."%");
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $prio_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }*/
        
    }
?>