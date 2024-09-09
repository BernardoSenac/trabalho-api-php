<?php
    require_once 'Connection.php';

    class OrderDAO{
        public function getOrders(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM pedido;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createOrder(OrderModel $orderData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO pedido
            VALUES(
            :orderId, 
            :userId, 
            :statusId
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderId', $orderData->orderId);
            $stmt->bindValue(':userId', $orderData->userId);
            $stmt->bindValue(':statusId', $orderData->statusId);
            
            return $stmt->execute();
        }

        public function getOrderById(int $orderId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM pedido WHERE idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getOrdersByUserId(int $userId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM pedido WHERE idUsuario = :userId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateOrder(OrderModel $orderData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE pedido SET idUsuario = :userId, idStatus = :statusId WHERE idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':userId', $orderData->userId);
            $stmt->bindValue(':statusId', $orderData->statusId);
            $stmt->bindValue(':orderId', $orderData->orderId);
            
            return $stmt->execute();
        }

        public function deleteOrder(int $orderId){
            $connection = (new connection)->getConnection();

            $sql = "DELETE FROM pedido WHERE idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            
            return $stmt->execute();
        }

        public function updateOrderStatusById(OrderModel $orderData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE pedido SET idStatus = :statusId WHERE idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':statusId', $orderData->statusId);
            $stmt->bindValue(':orderId', $orderData->orderId);
            
            return $stmt->execute();
        }
    }
?>