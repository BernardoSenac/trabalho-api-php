<?php
    require_once 'Connection.php';

    class ProductDAO{
        public function getProducts(){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM produto;";

            $stmt = $connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verifyProductDescription(string $productDescription){
            $connection = (new connection)->getConnection();

            $sql = "SELECT descricaoProduto FROM produto WHERE descricaoProduto = :productDescription;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':productDescription', $productDescription);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function createProduct(ProductModel $productData){
            $connection = (new connection)->getConnection();

            $sql = "INSERT INTO produto
            VALUES(
            :productId, 
            :productDescription, 
            :productPrice
            );";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':productId', $productData->productId);
            $stmt->bindValue(':productDescription', $productData->productDescription);
            $stmt->bindValue(':productPrice', $productData->productPrice);
            
            return $stmt->execute();
        }

        public function getProductById(int $productId){
            $connection = (new connection)->getConnection();

            $sql = "SELECT * FROM produto WHERE idProduto = :productId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateProduct(ProductModel $productData){
            $connection = (new connection)->getConnection();

            $sql = "UPDATE produto SET descricaoProduto = :productDescription, precoProduto = :productPrice WHERE idProduto = :productId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':productId', $productData->productId);
            $stmt->bindValue(':productDescription', $productData->productDescription);
            $stmt->bindValue(':productPrice', $productData->productPrice);
            
            return $stmt->execute();
        }

        public function deleteProduct(int $productId){
            $connection = (new connection)->getConnection();

            $sql = "DELETE FROM produto WHERE idProduto = :productId;";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            
            return $stmt->execute();
        }
    }
?>