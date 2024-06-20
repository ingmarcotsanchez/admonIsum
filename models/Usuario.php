<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["correo"];
                $usu_pass = $_POST["passwd"];
                $usu_rol = $_POST["usu_rol"];

                if(empty($usu_correo) and empty($usu_pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    
                    $sql = "SELECT * FROM usuario WHERE usu_correo=? and usu_pass=MD5(?) and usu_rol=? and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->bindValue(2,$usu_pass);
                    $stmt->bindValue(3,$usu_rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_apep"]=$resultado["usu_apep"];
                        $_SESSION["usu_apem"]=$resultado["usu_apem"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["usu_rol"]=$resultado["usu_rol"];
                        if($usu_rol == "C" || $usu_rol == "GA" ||$usu_rol == "GI"||$usu_rol == "AU"){
                            header("Location:".Conectar::ruta()."views/inicio.php");
                            exit();
                        }else{
                            header("Location:".Conectar::ruta()."views/admTikets.php");
                            exit();
                        }
                        
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        } 
        
        public function recuperar(){
            $conectar = parent::Conexion();
            parent::set_names();
            

            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["correo"];
                
                if(empty($usu_correo)){
                    header("Location:".Conectar::ruta()."recuperar.php?m=3");
                    exit();
                }elseif(!empty($usu_correo)){
                    $sql = "SELECT usu_correo FROM usuario WHERE usu_correo=?";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    var_dump($resultado);
                    if($resultado == false){
                        header("Location:".Conectar::ruta()."recuperar.php?m=1");
                        exit();
                    }else{
                        $logitudPass = 5;
                        $miPassword = substr( md5(microtime()), 1, $logitudPass);
                        $clave = $miPassword;
                        var_dump($clave);
                        $updateClave = "UPDATE usuario SET usu_pass='$clave' WHERE usu_correo=? ";
                        $stmt = $conectar->prepare($updateClave);
                        $stmt->bindValue(1,$usu_correo);
                        $stmt->execute();
                        $resultado = $stmt->fetch();
                       
                        $destinatario = $usu_correo; 
                        $asunto = "Recuperando Clave";
                        $cuerpo = '
                                    <!DOCTYPE html>
                                    <html lang="es">
                                    <head>
                                    <title>Recuperar Clave de Usuario</title>';
                        $cuerpo .= ' 
                                    <style>
                                        * {
                                            margin: 0;
                                            padding: 0;
                                            box-sizing: border-box;
                                        }
                                        body {
                                            font-family: "Roboto", sans-serif;
                                            font-size: 16px;
                                            font-weight: 300;
                                            color: #888;
                                            background-color:rgba(230, 225, 225, 0.5);
                                            line-height: 30px;
                                            text-align: center;
                                        }
                                        .contenedor{
                                            width: 80%;
                                            min-height:auto;
                                            text-align: center;
                                            margin: 0 auto;
                                            background: #ececec;
                                            border-top: 3px solid #E64A19;
                                        }
                                        .btnlink{
                                            padding:15px 30px;
                                            text-align:center;
                                            background-color:#cecece;
                                            color: crimson !important;
                                            font-weight: 600;
                                            text-decoration: blue;
                                        }
                                        .btnlink:hover{
                                            color: #fff !important;
                                        }
                                        .imgBanner{
                                            width:100%;
                                            margin-left: auto;
                                            margin-right: auto;
                                            display: block;
                                            padding:0px;
                                        }
                                        .misection{
                                            color: #34495e;
                                            margin: 4% 10% 2%;
                                            text-align: center;
                                            font-family: sans-serif;
                                        }
                                        .mt-5{
                                            margin-top:50px;
                                        }
                                        .mb-5{
                                            margin-bottom:50px;
                                        }
                                    </style>
                        ';

                        $cuerpo .= '
                                    </head>
                                    <body>
                                        <div class="contenedor">
                                            <img class="imgBanner" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fincentivosbancasegurosbpop.segurosalfa.com.co%2Fweb%2Fasesores%2Frecuperar-contrasena&psig=AOvVaw32-AJpOJCqpQQXN8C5KjE3&ust=1718391111678000&source=images&cd=vfe&opi=89978449&ved=0CBAQjRxqFwoTCJD_0fGf2YYDFQAAAAAdAAAAABAE">
                                            <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                                                <tr>
                                                    <td style="background-color: #ffffff;">
                                                        <div class="misection">
                                                            <h2 style="color: red; margin: 0 0 7px">Hola, '.$_SESSION['usu_nom'].'</h2>
                                                            <p style="margin: 2px; font-size: 18px">te hemos creado una nueva clave temporal para que puedas iniciar sesión, la clave temporal es: <strong>'.$clave.'</strong> </p>
                                                            <p>&nbsp;</p>
                                                            <p>&nbsp;</p>
                                                            <a href="https://localhost/ISUM/" class="btnlink">Iniciar Sesión </a>
                                                            <p>&nbsp;</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>'; 
                        $cuerpo .= '
                                        </div>
                                    </body>
                                </html>';
        
                        $headers  = "MIME-Version: 1.0\r\n"; 
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
                        $headers .= "From: WebDeveloper\r\n"; 
                        $headers .= "Reply-To: "; 
                        $headers .= "Return-path:"; 
                        $headers .= "Cc:"; 
                        $headers .= "Bcc:"; 
                        (mail($destinatario,$asunto,$cuerpo,$headers));
                        header("Location:".Conectar::ruta()."recuperar.php?m=2");
                        exit();
                    }
                }else{
                    header("Location:".Conectar::ruta()."recuperar.php");
                    exit();
                }
                

            }

        }
        
        public function insert_usuario($usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_rol){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuario (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_pass, usu_rol, fech_crea, est) VALUES (NULL,?,?,?,?,MD5(?)//,?,now(),'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_correo);
            $sql->bindValue(5, $usu_pass);
            $sql->bindValue(6, $usu_rol);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        public function update_perfil($usu_id,$usu_pass){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario 
                    SET 
                    usu_clave = ?
                    WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_pass);
            $sql->bindValue(2,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_rol){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = MD5(?),
                    usu_rol = ?,
                    fech_mod = now()
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $usu_rol);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "call sp_listar()";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_id($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuario WHERE est = 1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario where est=1 and usu_rol='GI' OR usu_rol='GA' OR usu_rol='AU' OR usu_rol='C' ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM profesor WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_proyectos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM proyectos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_semilleros(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM semilleros WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_productos_unitic(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM productos WHERE sem_id=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_productos_satsoc(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM productos WHERE sem_id=6";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_productos_tecnoreciclaje(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM productos WHERE sem_id=4";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_productos_bigdata(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM productos WHERE sem_id=9";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_NoGraduados(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=4";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_egresados(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=3";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_desertores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=5";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_ausentes(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_activos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_egre=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_estudiantes(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_total_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalabierto_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where usu_id = ? and tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalcerrado_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where usu_id = ? and tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT categoria.cat_nom AS nom,COUNT(*) AS total
                FROM ticket JOIN categoria ON ticket.cat_id = categoria.cat_id  
                WHERE ticket.est = 1 AND ticket.usu_id = ?
                GROUP BY 
                categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        /* TODO: Actualizar contraseña del usuario */
        /* public function update_usuario_pass($usu_id,$usu_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usu_pass = MD5(?)
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }  */

    }
?>