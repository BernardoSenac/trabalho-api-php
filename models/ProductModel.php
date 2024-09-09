<?php
    require_once 'DAL/ProductDAO.php';

    class ProductModel{
        public ?int $productId;
        public ?string $productDescription;
        public ?float $productPrice;

        public function __construct(
            ?int $productId = null, 
            ?string $productDescription = null, 
            ?float $productPrice = null, 
        )
        {
            $this->productId = $productId;
            $this->productDescription = $productDescription;
            $this->productPrice = $productPrice;
        }

        public function getProducts(){
            $productDAO = new ProductDAO();

            $products = $productDAO->getProducts();

            foreach ($products as $key => $product){
                    $products[$key] = new ProductModel(
                    $product['idProduto'], 
                    $product['descricaoProduto'],
                    $product['precoProduto']
                );
            }

            return $products;
        }

        public function verifyProductDescription(string $productDescription){
            $ProductDAO = new ProductDAO();

            return $ProductDAO->verifyProductDescription($productDescription);
        }

        public function createProduct(ProductModel $productData){
            $productDAO = new ProductDAO();

            return $productDAO->createProduct($productData);
        }

        
        public function getProductById(int $productId){
            $productDAO = new ProductDAO();

            $product = $productDAO->getProductById($productId);

            return new ProductModel(
                $product['idProduto'], 
                $product['descricaoProduto'],
                $product['precoProduto']
            );
        }

        public function updateProduct(ProductModel $productData){
            $productDAO = new ProductDAO();

            return $productDAO->updateProduct($productData);
        }

        public function deleteProduct(int $productId){
            $productDAO = new ProductDAO();

            return $productDAO->deleteProduct($productId);
        }
    }
?>
