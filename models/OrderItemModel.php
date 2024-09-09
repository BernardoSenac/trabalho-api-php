<?php
    require_once 'DAL/OrderItemDAO.php';

    class OrderItemModel{
        public ?int $orderItemId;
        public ?int $orderId;
        public ?int $productId;
        public ?int $productQuantity;

        public function __construct(
            ?int $orderItemId = null, 
            ?int $orderId = null, 
            ?int $productId = null,
            ?int $productQuantity = null
        )
        {
            $this->orderItemId = $orderItemId;
            $this->orderId = $orderId;
            $this->productId = $productId;
            $this->productQuantity = $productQuantity;
        }

        public function createOrderItem(OrderItemModel $orderItemData){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->createOrderItem($orderItemData);
        }

        public function getOrderItemsById(int $orderId){
            $orderItemDAO = new OrderItemDAO();

            $orderItems = $orderItemDAO->getOrderItemsById($orderId);

            foreach ($orderItems as $key => $orderItem){
                $orderItems[$key] = new OrderItemModel(
                $orderItem['idItemPedido'], 
                $orderItem['idPedido'],
                $orderItem['idProduto'],
                $orderItem['quantidadeProduto']
            );
        }

        return $orderItems;
        }

        public function updateOrderItem(OrderItemModel $orderItemData){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->updateOrderItem($orderItemData);
        }

        public function getOrderPriceByOrderId(int $orderId){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->getOrderPriceByOrderId($orderId);
        }

        public function deleteOrderItem(int $orderItemId){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->deleteOrderItem($orderItemId);
        }

        public function verifyOrderItem(){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->verifyOrderItem($this);
        }

        public function AddProductQuantity(){
            $orderItemDAO = new OrderItemDAO();

            return $orderItemDAO->AddProductQuantity($this);
        }
    }
?>
