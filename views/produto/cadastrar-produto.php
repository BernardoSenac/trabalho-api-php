<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Cadastrar Produto</title>
</head>
<body>
    <header>
        <h1>Cadastrar Produto</h1>
    </header>
    <form id="createProductForm">
        <label for="description">Descrição</label>
        <br>
        <input type="text" name="description" id="description" maxlength="100" required>
        <br>
        <label for="price">Preço</label>
        <br>
        <input type="number" name="price" id="price" step="0.01" min="0" placeholder="0.00" onblur="formatPrice(this)" required>  
        <br>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
