<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["correo"];
                $usu_pass = $_POST["passwd"];
                if(empty($usu_correo) and empty($usu_pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM usuario WHERE usu_correo=? and usu_pass=? and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->bindValue(2,$usu_pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_apep"]=$resultado["usu_apep"];
                        $_SESSION["usu_apem"]=$resultado["usu_apem"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["usu_rol"]=$resultado["usu_rol"];
                        header("Location:".Conectar::ruta()."views/inicio.php");
                        exit();
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }   
        
        public function insert_usuario($usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_rol){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuario (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_pass, usu_rol, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,now(),'1');";
     
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

        public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_rol){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = ?,
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
            $sql = "SELECT * FROM usuario WHERE est = 1";
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

        

    }
?>