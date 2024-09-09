<?php
    require_once './models/OrderItemModel.php';

    class OrderItemController{
        public function createOrderItem() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            if(empty($data['idProduto']))
                return $this->error('Você deve informar o ID do produto!');

            if(empty($data['quantidadeProduto']))
                return $this->error('Você deve informar a quantidade do produto!');

            $orderItemModel = new OrderItemModel();

            $orderItemData = new OrderItemModel(
                null,
                $data['idPedido'], 
                $data['idProduto'],
                $data['quantidadeProduto']
            );
            
            if(($orderItemData->verifyOrderItem())){
                $orderItem = $orderItemData->AddProductQuantity();
            }
            else{
                $orderItem = $orderItemModel->createOrderItem($orderItemData);
            }
                
            return json_encode([
                'error' => null,
                'result' => $orderItem
            ]);
        }

        public function updateOrderItem() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idItemPedido']))
                return $this->error('Você deve informar o ID do item pedido!');

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            if(empty($data['idProduto']))
                return $this->error('Você deve informar o ID do produto!');

            if(empty($data['quantidadeProduto']))
                return $this->error('Você deve informar a quantidade do produto!');

            $orderItemModel = new OrderItemModel();

            $orderItemData = new OrderItemModel(
                $data['idItemPedido'],
                $data['idPedido'],
                $data['idProduto'],
                $data['quantidadeProduto']
            );

            $orderItem = $orderItemModel->updateOrderItem($orderItemData);

            return json_encode([
                'error' => null,
                'result' => $orderItem
            ]);
        }

        public function getOrderPriceByOrderId() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            $orderItemModel = new OrderItemModel();

            $price = $orderItemModel->getOrderPriceByOrderId($data['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $price
            ]);
        }
        
        public function deleteOrderItem() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idItemPedido']))
                return $this->error('Você deve informar o ID do item pedido!');

            $orderItemModel = new OrderItemModel();

            $orderItem = $orderItemModel->deleteOrderItem($data['idItemPedido']);

            return json_encode([
                'error' => null,
                'result' => $orderItem
            ]);
        }

        public function getOrderItemsById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            $orderItemModel = new OrderItemModel();

            $orderItems = $orderItemModel->getOrderItemsById($data['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $orderItems
            ]);
        }

        private function error(string $message) {
            return json_encode([
                'error' => $message,
                'result' => null
            ]);
        }
    }
?>