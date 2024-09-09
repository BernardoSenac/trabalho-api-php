<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/javascript/script.js"></script>
    <title>Usuários</title>
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
        <h1>Usuários</h1>
        <?php require_once './public/html/menu.html';?>
        <a href="cadastrar-usuario">Cadastrar Usuário</a>
    </header>
    <div id="result"></div> 

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:80/API-usuarios', // URL correta
                method: 'GET', // Método HTTP da requisição
                dataType: 'json', // Tipo de dados esperado na resposta
                success: function(response) {
                    console.log('Resposta da API de usuários:', response); // Mensagem de depuração

                    if (response.error === null) {
                        let resultHtml = '<h2>Usuários:</h2>';
                        let userRequests = []; // Array para armazenar as promessas

                        // Itera sobre cada usuário e faz uma requisição AJAX adicional
                        $.each(response.result, function(index, user) {
                            // Adiciona uma promessa para cada requisição AJAX
                            userRequests.push(
                                $.ajax({
                                    url: 'http://localhost:80/API-buscar-tipo-usuario',
                                    method: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        "idTipoUsuario": user.userTypeId
                                    }),
                                    dataType: 'json'
                                }).then(function(userTypeResponse) {
                                    // Monta o HTML para cada usuário
                                    return `
                                        <div>
                                            <p><strong>ID:</strong> ${user.userId}</p>
                                            <p><strong>Tipo de Usuário:</strong> ${userTypeResponse.result}</p>
                                            <p><strong>Nome:</strong> ${user.userName}</p>
                                            <p><strong>CPF:</strong> ${user.userCpf}</p>
                                            <a href="pedidos-usuario?id=${user.userId}">Ver Pedidos</a>
                                            <br>
                                            <a href="editar-usuario?id=${user.userId}">Editar Usuário</a>
                                            <br>
                                            <br>
                                            <button onclick="return excluirUsuario(${user.userId});">Excluir Usuário</button>
                                        </div>
                                        <hr>
                                    `;
                                }).fail(function(jqXHR, textStatus, errorThrown) {
                                    console.error('Erro ao buscar tipo de usuário:', {
                                        status: jqXHR.status,
                                        statusText: jqXHR.statusText,
                                        responseText: jqXHR.responseText,
                                        textStatus: textStatus,
                                        errorThrown: errorThrown
                                    });
                                    return `<div><p><strong>ID:</strong> ${user.userId}</p><p>Erro ao carregar tipo de usuário.</p></div><hr>`;
                                })
                            );
                        });

                        // Quando todas as promessas estiverem resolvidas
                        $.when.apply($, userRequests).done(function() {
                            let htmlResults = Array.from(arguments).map(arg => arg[0]).join('');
                            $('#result').html(resultHtml + htmlResults);
                        }).fail(function() {
                            $('#result').html('<p>Erro ao processar as requisições dos tipos de usuário.</p>');
                        });
                    } else {
                        $('#result').html('<p>Ocorreu um erro ao carregar os dados.</p>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Detalhes do erro na requisição de usuários:', {
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
