<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/javascript/script.js"></script>
    <title>Produtos</title>
    <!-- Incluindo jQuery a partir da CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Produtos</h1>
        <?php require_once './public/html/menu.html';?>
        <a href="cadastrar-produto">Cadastrar Produto</a>
    </header>
    <div id="result"></div> 

    <script>
        $(document).ready(function() {
                $.ajax({
                    url: 'http://localhost:80/API-produtos', // URL correta
                    method: 'GET', // Método HTTP da requisição
                    dataType: 'json', // Tipo de dados esperado na resposta
                    success: function(response) {
                        // Verifica se há um erro na resposta
                        if (response.error === null) {
                            let resultHtml = '<h2>Produtos:</h2>';
                            // Itera sobre cada usuário e exibe as informações
                            $.each(response.result, function(index, product) {
                                resultHtml += `
                                    <div>
                                        <p><strong>ID:</strong> ${product.productId}</p>
                                        <p><strong>Descrição:</strong> ${product.productDescription}</p>
                                        <p><strong>Preço:</strong> ${product.productPrice}</p>

                                        <a href="editar-produto?id=${product.productId}">Editar Produto</a>
                                        <button onclick="return excluirProduto(${product.productId});">Excluir Produto</button>
                                    </div>
                                    <hr>
                                `;
                            });
                            $('#result').html(resultHtml);
                        } else {
                            // Exibe uma mensagem de erro se o campo "error" não for null
                            $('#result').html('<p>Ocorreu um erro ao carregar os dados.</p>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Exibe detalhes do erro no console e na página
                        console.log('Detalhes do erro:', {
                            status: jqXHR.status,
                            statusText: jqXHR.statusText,
                            responseText: jqXHR.responseText,
                            textStatus: textStatus,
                            errorThrown: errorThrown
                        });

                        $('#result').html(`
                            <p><strong>Status da requisição:</strong> ${textStatus}</p>
                            <p><strong>Erro lançado:</strong> ${errorThrown}</p>
                            <p><strong>Detalhes do erro:</strong> ${jqXHR.responseText}</p>
                        `);
                    }
                });
            });
    </script>
</body>
</html>
