<?php
    require_once './models/ProductModel.php';

    class ProductController{
        public function getProducts(){
            $productModel = new ProductModel();

            $products = $productModel->getProducts();

            return json_encode([
                'error' => null,
                'result' => $products
            ]);
        }

        public function createProduct() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['descricaoProduto']))
                return $this->error('Você deve informar a descrição do produto!');

            if(empty($data['precoProduto']))
                return $this->error('Você deve informar o preço do produto!');

            if ((new ProductModel)->verifyProductDescription($data['descricaoProduto']))
                return $this->error('Esse produto já foi cadastrado anteriormente!');
            
            $productModel = new ProductModel();

            $productData = new ProductModel(
                null,
                $data['descricaoProduto'], 
                $data['precoProduto'],
            );

            $product = $productModel->createProduct($productData);

            return json_encode([
                'error' => null,
                'result' => $product
            ]);
        }

        public function getProductById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idProduto']))
                return $this->error('Você deve informar o ID do produto!');

            $productModel = new ProductModel();

            $product = $productModel->getProductById($data['idProduto']);

            return json_encode([
                'error' => null,
                'result' => $product
            ]);
        }

        public function updateProduct() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idProduto']))
                return $this->error('Você deve informar o ID do produto!');
            
            if(empty($data['descricaoProduto']))
                return $this->error('Você deve informar a descrição do produto!');

            if(empty($data['precoProduto']))
                return $this->error('Você deve informar o preço do produto!');
            
            if ((new ProductModel)->verifyProductDescription($data['descricaoProduto']))
                return $this->error('Esse produto já foi cadastrado anteriormente!');
            
            $productModel = new ProductModel();

            $productData = new ProductModel(
                $data['idProduto'],
                $data['descricaoProduto'], 
                $data['precoProduto']
            );

            $product = $productModel->updateProduct($productData);

            return json_encode([
                'error' => null,
                'result' => $product
            ]);
        }

        public function deleteProduct() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idProduto']))
                return $this->error('Você deve informar o ID do produto!');

            $productModel = new ProductModel();

            $product = $productModel->deleteProduct($data['idProduto']);

            return json_encode([
                'error' => null,
                'result' => $product
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