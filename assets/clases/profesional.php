<?php

class profesional {
    
    public static function obtenerNombreProfesional($idProf) {
        require_once("../../modules/db/dbConnection.php");
        try {
            $sql = "select nombre from profesionales where id =:idProfesional limit 1";
            // $p = $database::conectar()->prepare($sql);
            $p = db::conectar()->prepare($sql);
            $p->bindValue('idProfesional', $idProf);
            $p->execute();
            if($p){
                $datos = $p->fetchAll(PDO::FETCH_ASSOC);
                foreach($datos as $row) {
                    return $row['nombre'];
                }
            } else {
                return 'sin datos';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
}

?>