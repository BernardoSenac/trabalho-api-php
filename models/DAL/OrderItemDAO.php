<?php
    require_once 'Connection.php';

    class OrderItemDAO{
        public function createOrderItem(OrderItemModel $orderItemData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO item_pedido
            VALUES(
            :orderItemId, 
            :orderId, 
            :productId,
            :productQuantity
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderItemId', $orderItemData->orderItemId);
            $stmt->bindValue(':orderId', $orderItemData->orderId);
            $stmt->bindValue(':productId', $orderItemData->productId);
            $stmt->bindValue(':productQuantity', $orderItemData->productQuantity);
            
            return $stmt->execute();
        }

        public function getOrderItemsById(int $orderId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM item_pedido WHERE idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateOrderItem(OrderItemModel $orderItemData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE item_pedido SET idPedido = :orderId, idProduto = :productId, quantidadeProduto = :productQuantity WHERE idItemPedido = :orderItemId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderItemId', $orderItemData->orderItemId);
            $stmt->bindValue(':orderId', $orderItemData->orderId);
            $stmt->bindValue(':productId', $orderItemData->productId);
            $stmt->bindValue(':productQuantity', $orderItemData->productQuantity);
            
            return $stmt->execute();
        }

        public function getOrderPriceByOrderId(int $orderId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT SUM(i.quantidadeProduto * p.precoProduto) AS valor_total_pedido
                    FROM item_pedido i
                    JOIN produto p ON i.idProduto = p.idProduto
                    WHERE i.idPedido = :orderId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteOrderItem(int $orderItemId){
            $connection = (new connection)->getConnection();

            $sql = "DELETE FROM item_pedido WHERE idItemPedido = :orderItemId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':orderItemId', $orderItemId);
            
            return $stmt->execute();
        }

        public function verifyOrderItem(orderItemModel $orderItemId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM item_pedido WHERE idPedido = :orderId AND idProduto = :productId";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderId', $orderItemId->orderId);
            $stmt->bindValue(':productId', $orderItemId->productId);
            $stmt->execute();

            return  $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function AddProductQuantity(orderItemModel $orderItemId){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE item_pedido
                    SET quantidadeProduto = quantidadeProduto + :productQuantity
                    WHERE idPedido = :orderId AND idProduto = :productId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderId', $orderItemId->orderId);
            $stmt->bindValue(':productId', $orderItemId->productId);
            $stmt->bindValue(':productQuantity', $orderItemId->productQuantity);
            
            return $stmt->execute();
        }
    }
?>