<?php
    require_once 'Connection.php';

    class StatusDAO{
        public function getStatuses(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM status;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getStatusById(int $statusId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM status WHERE idStatus = :statusId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':statusId', $statusId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>