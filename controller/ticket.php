<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();
    require_once("../models/Usuario.php");
    $usuario = new Usuario();
    require_once("../models/Documento.php");
    $documento = new Documento();
 
    switch($_GET["opc"]){
        case "asignar":
            $ticket->update_ticket_asignacion($_POST["tick_id"],$_POST["usu_asig"]);
            break;
        case "insert":
            //$ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["tick_titulo"],$_POST["tick_descrip"]);//,$_POST["prio_id"]);
            $datos=$ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["cats_id"], $_POST["tick_titulo"],$_POST["tick_descrip"],$_POST["prio_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["tick_id"] = $row["tick_id"];
                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../document/ticket/".$output["tick_id"]."/";
                        $files_arr = array();

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];
                            $documento->insert_documento( $output["tick_id"],$_FILES['files']['name'][$index]);
                            move_uploaded_file($doc1,$destino);
                        }
                    }
                }
            }
            echo json_encode($datos);
            break;
        case "insertdetalle":
            $datos=$ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["dtick_descrip"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["dtick_id"] = $row["dtick_id"];
                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../document/ticket_detalle/".$output["dtick_id"]."/";
                        $files_arr = array();

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];
                            $documento->insert_documento_detalle( $output["dtick_id"],$_FILES['files']['name'][$index]);
                            move_uploaded_file($doc1,$destino);
                        }
                    }
                }
            }
            echo json_encode($datos);
            break;
        case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            //var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                if ($row["prio_id"]==1){
                    $sub_array[] = '<strong class="text-danger">'.$row["prio_nom"].'</strong>';
                }elseif($row["prio_id"]==2){
                    $sub_array[] = '<strong class="text-orange">'.$row["prio_nom"].'</strong>';
                }else{
                    $sub_array[] = '<strong class="text-success">'.$row["prio_nom"].'</strong>';
                }
                //$sub_array[] = $row["prio_nom"];

                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<strong class="text-success">Abierto</strong>';
                }else{
                    $sub_array[] = '<a class="btn btn-sm btn-danger" onClick="CambiarEstado('.$row["tick_id"].')">Cerrado</a>';
                }
                
                if($row["fech_asig"]==NULL){
                    $sub_array[] = '<strong class="text-secondary">Sin Asignar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }
                
                if($row["fech_cierre"]==null){
                    $sub_array[] = '<strong class="text-dark">Sin Cerrar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                }
                if($row["usu_asig"]==null){
                    $sub_array[] = '<strong class="text-info">Sin Asignar</strong>';
                    /* $sub_array[] = '<a onClick="asignar('.$row["tick_id"].');"><span class="bnt btn-warning btn-sm">Sin Asignar</span></a>'; */
                }else{
                    $datos1=$usuario->usuario_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<strong class="text-info">'. $row1["usu_nom"].'</strong>';
                    }
                }
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                if($row["tick_estado"]=="Cerrado"){
                    $sub_array[] = '<button type="button" onClick="evaluar('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-outline-primary btn-sm ladda-button"><i class="fa fa-key"></i></button>';
                }else{
                    $sub_array[] = '<button disabled type="button" onClick="evaluar('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-outline-primary btn-sm ladda-button"><i class="fa fa-key"></i></button>'; 
                }
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"] = $row["tick_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["cat_id"] = $row["cat_id"];

                    $output["tick_titulo"] = $row["tick_titulo"];
                    $output["tick_descrip"] = $row["tick_descrip"];

                    if ($row["tick_estado"]=="Abierto"){
                        $output["tick_estado"] = '<span class="btn btn-sm btn-success">Abierto</span>';
                    }else{
                        $output["tick_estado"] = '<span class="btn btn-sm btn-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["tick_estado"];

                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    if ($row["fech_cierre"]==NULL){
                        $output["fech_cierre"] = "Sin cerrar";
                    }else{
                        $output["fech_cierre"] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    }
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["cat_nom"] = $row["cat_nom"];
                    $output["cats_nom"] = $row["cats_nom"];
                    $output["tick_estre"] = $row["tick_estre"];
                    $output["tick_coment"] = $row["tick_coment"];
                    $output["prio_nom"] = $row["prio_nom"];
                }
                echo json_encode($output);
            }   
            break;
        case "listar":
            $datos=$ticket->listar_ticket();
            //var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];
                
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                if ($row["prio_id"]==1){
                    $sub_array[] = '<strong class="text-danger">'.$row["prio_nom"].'</strong>';
                }elseif($row["prio_id"]==2){
                    $sub_array[] = '<strong class="text-orange">'.$row["prio_nom"].'</strong>';
                }else{
                    $sub_array[] = '<strong class="text-success">'.$row["prio_nom"].'</strong>';
                }
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="btn btn-success btn-sm">Abierto</span>';
                }else{
                    $sub_array[] = '<span class="btn btn-danger btn-sm" onClick="CambiarEstado('.$row["tick_id"].')">Cerrado</span>';
                }
                if($row["fech_asig"]==NULL){
                    $sub_array[] = '<strong class="text-secondary">Sin Asignar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }
                if($row["fech_cierre"]==null){
                    $sub_array[] = '<strong class="text-dark">Sin Cerrar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                }

                if($row["usu_asig"]==null){
                    $sub_array[] = '<a style="cursor:pointer;" class="bnt btn-warning btn-sm" onClick="asignar('.$row["tick_id"].');">Pendiente</a>';
                }else{
                    $datos1=$usuario->usuario_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<strong class="text-info">'. $row1["usu_nom"].'</strong>';
                    }
                }
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                
                $sub_array[] = '<button disabled type="button" onClick="evaluar('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-outline-primary btn-sm ladda-button"><i class="fa fa-key"></i></button>';
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php foreach($datos as $row): ?>
                    <div class="timeline" id="DtlleTicket">
            
                        <div class="time-label">
                            <span class="bg-dark"><?php echo date("d/m/Y", strtotime($row["fech_crea"]));?></span>
                        </div>
        
                        <div>
                            <?php if ($row['usu_rol']=="E"): ?>
                            <i class="fas fa-user bg-blue"></i>
                            <?php else: ?>
                            <i class="fas fa-user bg-info"></i>
                            <?php endif; ?>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> <?php echo date("H:i:s", strtotime($row["fech_crea"]));?></span>
                                <h3 class="timeline-header"><a href="#"><?php 
                                            if ($row['usu_rol']=="E"){
                                            echo 'Estudiante';
                                        }else{
                                            echo 'Soporte';
                                        } 
                                    ?>:</a> <?php echo $row['usu_nom'].' '.$row['usu_apep'].' '.$row['usu_apem'];?></h3>

                                <div class="timeline-body">
                                    <?php echo $row["dtick_descrip"];?>
                                </div>
                                <div class="timeline-footer">
                                    <?php 
                                        $datos_detalle=$documento->get_documento_detalle_x_ticketd($row['dtick_id']);
                                        if (is_array($datos_detalle)==true and count($datos_detalle)>0){
                                    ?>
                                    <strong>Documentos Adjuntos</strong>
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                        <thead>
                                            <tr>
                                                <th style="width: 90%;">Nombre</th>
                                                <th class="text-center" style="width: 10%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($datos_detalle as $row_detalle): ?>
                                            <tr>
                                                <td><?php echo $row_detalle['det_nom']; ?></td>
                                                <td><a href="../document/ticket_detalle/<?php echo $row_detalle['dtick_id']; ?>/<?php echo $row_detalle['det_nom']; ?>" target="_blank" class="btn btn-inline btn-primary btn-sm"><i class="fa fa-eye"></i> Ver</a></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php 
                                        }
                                    ?>
                                </div>

                            </div>
                        </div>
                    
                    <div>     
                <?php endforeach;?>
            <?php
            break;
        case "update":
            $ticket->update_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
            break;
        case "total";
            $datos=$ticket->get_ticket_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalabierto";
            $datos=$ticket->get_ticket_totalabierto();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalcerrado";
            $datos=$ticket->get_ticket_totalcerrado();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;
        case "grafico";
            $datos=$ticket->get_ticket_grafico();  
            echo json_encode($datos);
            break;
       
        case "reabrir":
            $ticket->reabrir_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_reabrir($_POST["tick_id"],$_POST["usu_id"]);
            break;
        case "encuesta":
            $ticket->insert_encuesta($_POST["tick_id"],$_POST["tick_estre"],$_POST["tick_coment"]);
            break;
    }
?>