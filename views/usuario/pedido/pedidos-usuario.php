<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/javascript/script.js"></script>
    <title>Pedidos</title>
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
        <h1>Pedidos</h1>
        <?php require_once './public/html/menu.html';?>
        <a href="criar-pedido">Criar Pedido</a>
    </header>
    <div id="result"></div> 

    <script>
        $(document).ready(function() {      
                $.ajax({
                    url: 'http://localhost:80/API-pedidos-pessoa', // URL correta
                    method: 'POST', // Método HTTP da requisição
                    data: JSON.stringify({
                        "idUsuario": <?=$_GET['id']?>
                    }), 
                    dataType: 'json', // Tipo de dados esperado na resposta
                    success: function(response) {
                        // Verifica se há um erro na resposta
                        if (response.error === null) {
                            let resultHtml = '<h2>Pedidos:</h2>';
                            // Itera sobre cada usuário e exibe as informações
                            $.each(response.result, function(index, order) {
                                resultHtml += `
                                    <div>
                                        <p><strong>ID do Pedido:</strong> ${order.orderId}</p>
                                        <p><strong>ID do Usuário:</strong>${order.userId}</p>
                                        <p><strong>Status:</strong> ${order.statusId}</p>
                                        <a href="items-pedido?id=${order.orderId}">Ver Items do Pedido</a>
                                        <br>
                                        <br>
                                        <button onclick="return alterarStatus(${order.orderId});">Ver Produtos</button>
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
