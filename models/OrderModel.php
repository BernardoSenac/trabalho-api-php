<?php
    require_once 'DAL/OrderDAO.php';

    class OrderModel{
        public ?int $orderId;
        public ?int $userId;
        public ?int $statusId;

        public function __construct(
            ?int $orderId = null, 
            ?int $userId = null, 
            ?int $statusId = null, 
        )
        {
            $this->orderId = $orderId;
            $this->userId = $userId;
            $this->statusId = $statusId;
        }

        public function getOrders(){
            $orderDAO = new OrderDAO();

            $orders = $orderDAO->getOrders();

            foreach ($orders as $key => $order){
                    $orders[$key] = new OrderModel(
                    $order['idPedido'], 
                    $order['idUsuario'],
                    $order['idStatus']
                );
            }

            return $orders;
        }

        public function createOrder(OrderModel $orderData){
            $orderDAO = new OrderDAO();

            return $orderDAO->createOrder($orderData);
        }

        public function getOrderById(int $orderId){
            $orderDAO = new OrderDAO();

            $order = $orderDAO->getOrderById($orderId);

            return new OrderModel(
                $order['idPedido'], 
                $order['idUsuario'],
                $order['idStatus']
            );
        }

        public function getOrdersByUserId(int $userId){
            $orderDAO = new OrderDAO();

            $orders = $orderDAO->getOrdersByUserId($userId);

            foreach($orders as $key => $order){
                $orders[$key] = new OrderModel(
                    $order['idPedido'], 
                    $order['idUsuario'],
                    $order['idStatus']
                );
            }

            return $orders;
        }

        public function updateOrder(OrderModel $orderData){
            $orderDAO = new OrderDAO();

            return $orderDAO->updateOrder($orderData);
        }

        public function deleteOrder(int $orderId){
            $orderDAO = new OrderDAO();

            return $orderDAO->deleteOrder($orderId);
        }

        public function updateOrderStatusById(OrderModel $orderData){
            $orderDAO = new OrderDAO();

            return $orderDAO->updateOrderStatusById($orderData);
        }
    }
?>
