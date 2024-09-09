<?php
    require_once './models/OrderModel.php';

    class OrderController{
        public function getOrders(){
            $orderModel = new OrderModel();

            $orders = $orderModel->getOrders();

            return json_encode([
                'error' => null,
                'result' => $orders
            ]);
        }

        public function createOrder() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');

            if(empty($data['idStatus']))
                return $this->error('Você deve informar o ID do status do pedido!');
            
            $orderModel = new OrderModel();

            $orderData = new OrderModel(
                null,
                $data['idUsuario'], 
                $data['idStatus'],
            );

            $order = $orderModel->createOrder($orderData);

            return json_encode([
                'error' => null,
                'result' => $order
            ]);
        }

        public function getOrderById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            $orderModel = new OrderModel();

            $order = $orderModel->getOrderById($data['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $order
            ]);
        }

        public function getOrdersByUserId() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');

            $orderModel = new OrderModel();

            $orders = $orderModel->getOrdersByUserId($data['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $orders
            ]);
        }

        public function updateOrder() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');
            
            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');

            if(empty($data['idStatus']))
                return $this->error('Você deve informar o ID do status do pedido!');
            
            $orderModel = new OrderModel();

            $orderData = new OrderModel(
                $data['idPedido'],
                $data['idUsuario'], 
                $data['idStatus']
            );

            $order = $orderModel->updateOrder($orderData);

            return json_encode([
                'error' => null,
                'result' => $order
            ]);
        }

        public function deleteOrder() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do pedido!');

            $orderModel = new OrderModel();

            $order = $orderModel->deleteOrder($data['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $order
            ]);
        }

        public function updateOrderStatusById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idPedido']))
                return $this->error('Você deve informar o ID do item pedido!');

            if(empty($data['idStatus']))
                return $this->error('Você deve informar o ID do status!');

            $orderModel = new OrderModel();

            $orderData = new OrderModel(
                $data['idPedido'],
                null,
                $data['idStatus']
            );

            $order = $orderModel->updateOrderStatusById($orderData);

            return json_encode([
                'error' => null,
                'result' => $order
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