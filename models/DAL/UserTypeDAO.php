<?php
    require_once 'Connection.php';

    class UserTypeDAO{
        public function getUserTypes(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM tipo_usuario;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUserTypeById(int $userTypeId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM tipo_usuario WHERE idTipoUsuario = :userTypeId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':userTypeId', $userTypeId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?> 