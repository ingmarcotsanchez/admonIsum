<?php
    class Barra extends Conectar{

        public function obtenerEstudiantesPorRangoDeAños($inicio, $fin) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $sql = "SELECT 
                        SUBSTRING(est_seme, 1, 4) AS año,
                        SUBSTRING(est_seme, 6) AS semestre,
                        COUNT(*) AS cantidad_estudiantes
                    FROM estudiante 
                    WHERE (est_seme BETWEEN ? AND ?) AND est != 0
                    GROUP BY año, semestre";
        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $inicio);
            $sql->bindValue(2, $fin);
            $sql->execute();
        
            return $resultado = $sql->fetchAll();
        }
        
        
        
    }
?>