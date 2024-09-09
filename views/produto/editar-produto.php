<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Editar Usuário</title>
</head>
<?php
    require_once './models/ProductModel.php';

    $productModel = new ProductModel();

    $product = $productModel->getProductById($_GET['id']);
?>
<body>
    <header>
        <h1>Editar Informações do Produto</h1>
    </header>
    <form id="updateProductForm">
        <label for="description">Descrição</label>
        <br>
        <input type="text" value="<?=$product->productDescription?>" name="description" id="description" maxlength="100" required>
        <br>
        <label for="price">Preço</label>
        <br>
        <input type="number" value="<?=$product->productPrice?>" name="price" id="price" step="0.01" min="0" placeholder="0.00" onblur="formatPrice(this)" required>
        <br>
        <br>
        <input type="hidden" name="productId" id="productId" value="<?=$product->productId?>">
        <input type="submit" value="Editar">
    </form>
</body>
</html>
