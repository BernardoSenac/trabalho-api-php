<?php
    require_once 'Connection.php';

    class UserDAO{
        public function getUsers(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM usuario;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verifyCPF(?int $userId, string $userCPF){
            $connection = (new connection)->getConnection();

            $sql = "SELECT cpfUsuario FROM usuario WHERE cpfUsuario = :userCPF AND idUsuario != :userId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':userCPF', $userCPF);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function createUser(userModel $userData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO usuario 
            VALUES(
            :userId, 
            :userTypeId, 
            :userName, 
            :userCpf, 
            :userPassword
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':userId', $userData->userId);
            $stmt->bindValue(':userTypeId', $userData->userTypeId);
            $stmt->bindValue(':userName', $userData->userName);
            $stmt->bindValue(':userCpf', $userData->userCpf);
            $stmt->bindValue(':userPassword', $userData->userPassword);
            
            return $stmt->execute();
        }

        public function getUserById(int $userId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM usuario WHERE idUsuario = :userId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateUser(userModel $userData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE usuario SET 
            idTipoUsuario = :userTypeId, 
            nomeUsuario = :userName, 
            cpfUsuario = :userCpf, 
            senhaUsuario = :userPassword 
            WHERE idUsuario = :userId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':userId', $userData->userId);
            $stmt->bindValue(':userTypeId', $userData->userTypeId);
            $stmt->bindValue(':userName', $userData->userName);
            $stmt->bindValue(':userCpf', $userData->userCpf);
            $stmt->bindValue(':userPassword', $userData->userPassword);
            
            return $stmt->execute();
        }

        public function deleteUser(int $userId){
            $connection = (new connection)->getConnection();

            $sql = "DELETE FROM usuario WHERE idUsuario = :userId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            
            return $stmt->execute();
        }
    }
?>