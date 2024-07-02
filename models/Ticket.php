<?php
    class Ticket extends Conectar{
         //metodos de inserción - insert

        public function insert_ticket($usu_id, $cat_id, $cats_id,$tick_titulo, $tick_descrip, $prio_id ){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="INSERT INTO ticket (tick_id, usu_id, cat_id, cats_id, tick_titulo, tick_descrip, tick_estado, fech_crea, prio_id, est) VALUES (NULL, ?, ?, ?, ?, ?, 'Abierto', now(),?, 1)";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $cats_id);
            $sql->bindValue(4, $tick_titulo);
            $sql->bindValue(5, $tick_descrip);
            $sql->bindValue(6, $prio_id);
            $sql->execute();
            $sql1="SELECT last_insert_id() AS 'tick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
            //return $resultado=$sql->fetchAll();
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
            $sql1="SELECT last_insert_id() AS 'dtick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
            //return $resultado=$sql->fetchAll();
            $ticket = new Ticket();
                $datos = $ticket->listar_ticket_x_id($tick_id);
                foreach ($datos as $row){
                    $usu_asig = $row["usu_asig"];
                    $usu_crea = $row["usu_id"];
                }
            if($_SESSION["usu_rol"]=="E"){
                
                
                $sql2="INSERT INTO notificaciones (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null,$usu_asig,'Tiene una respuesta del ticket Nro : ',$tick_id,2)";
                $sql2=$conectar->prepare($sql2);
                $sql2->execute(); 
            }else{
                $sql2="INSERT INTO notificaciones (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null,$usu_crea,'Tiene una respuesta del ticket Nro : ',$tick_id,2)";
                $sql2=$conectar->prepare($sql2);
                $sql2->execute(); 
            }
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
        public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO detalle_ticket (dtick_id,tick_id,usu_id,dtick_descrip,fech_crea,est) VALUES (NULL,?,?,'Ticket Re-Abierto...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //metodos de modificación - update

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

        /* TODO:Cambiar estado del ticket al reabrir */
        public function reabrir_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket 
                SET	
                    tick_estado = 'Abierto'
                WHERE
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket 
                SET	
                    usu_asig = ?,
                    fech_asig = now()
                WHERE
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();

            $sql1="INSERT INTO notificaciones (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null,?,'Se le ha asignado el ticket Nro : ',?,2)";
            $sql1=$conectar->prepare($sql1);
            $sql1->bindValue(1, $usu_asig);
            $sql1->bindValue(2, $tick_id);
            $sql1->execute(); 

            return $resultado=$sql->fetchAll();
        }

        /* TODO: Actualizar valor de estrellas de encuesta */
        public function insert_encuesta($tick_id,$tick_estre,$tick_coment){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket 
                SET	
                    tick_estre = ?,
                    tick_coment = ?
                WHERE
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_estre);
            $sql->bindValue(2, $tick_coment);
            $sql->bindValue(3, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //select

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
                usuario.usu_correo,
                /* categoria.cat_id, */
                categoria.cat_nom,
                ticket.prio_id,
                prioridad.prio_nom
                FROM 
                ticket
                INNER JOIN categoria ON ticket.cat_id = categoria.cat_id
                INNER JOIN usuario ON ticket.usu_id = usuario.usu_id
                INNER join prioridad on ticket.prio_id = prioridad.prio_id
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
                categoria.cat_nom,
                ticket.prio_id,
                prioridad.prio_nom
                FROM 
                ticket
                INNER JOIN categoria ON ticket.cat_id = categoria.cat_id
                INNER JOIN usuario ON ticket.usu_id = usuario.usu_id
                INNER join prioridad on ticket.prio_id = prioridad.prio_id
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
                ticket.cats_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.tick_estado,
                ticket.fech_crea,
                ticket.fech_cierre,
                ticket.tick_estre,
                ticket.tick_coment,
                ticket.usu_asig,
                usuario.usu_nom,
                usuario.usu_apep,
                usuario.usu_apem,
                usuario.usu_correo,
                categoria.cat_nom,
                subcategoria.cats_nom,
                ticket.prio_id,
                prioridad.prio_nom
                FROM 
                ticket
                INNER JOIN categoria ON ticket.cat_id = categoria.cat_id
                INNER JOIN subcategoria ON ticket.cats_id = subcategoria.cats_id
                INNER JOIN usuario ON ticket.usu_id = usuario.usu_id
                INNER join prioridad on ticket.prio_id = prioridad.prio_id
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
                FROM detalle_ticket
                INNER JOIN usuario ON detalle_ticket.usu_id = usuario.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket WHERE tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket WHERE tick_estado='Cerrado'";
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
        
    }
?>