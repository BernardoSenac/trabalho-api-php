document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('updateUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário

        const userId = document.getElementById('userId').value;
        const userTypeId = document.getElementById('userTypeId').value;
        const userName = document.getElementById('name').value;
        const CPF = document.getElementById('CPF').value;
        const userPassword = document.getElementById('password').value;

        // Verifica se todos os campos necessários foram preenchidos
        if (!userId || !userName || !CPF || !userTypeId || !userPassword) {
            alert('Preencha todos os campos corretamente!');
            return;
        }

        $.ajax({
            url: 'http://localhost:80/API-editar-usuario',
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({
                "idUsuario": userId,
                "idTipoUsuario": userTypeId,
                "nomeUsuario": userName,
                "cpfUsuario": CPF,
                "senhaUsuario": userPassword
            }),
            dataType: 'json',
            success: function(response) {
                console.log('Resposta:', response);
                window.location.href = 'http://localhost:80/usuarios';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Previne o envio padrão do formulário

    const userTypeId = document.getElementById('userTypeId').value;
    const userName = document.getElementById('name').value;
    const CPF = document.getElementById('CPF').value;
    const userPassword = document.getElementById('password').value;

    // Verifica se todos os campos necessários foram preenchidos
    if (!userName || !CPF || !userTypeId || !userPassword) {
        alert('Preencha todos os campos corretamente!');
        return;
    }

    $.ajax({
        url: 'http://localhost:80/API-cadastrar-usuario',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            "idUsuario": null,
            "idTipoUsuario": userTypeId,
            "nomeUsuario": userName,
            "cpfUsuario": CPF,
            "senhaUsuario": userPassword
        }),
        dataType: 'json',
        success: function(response) {
            console.log('Resposta:', response);
            window.location.href = 'http://localhost:80/usuarios';
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro:', {
                status: jqXHR.status,
                statusText: jqXHR.statusText,
                responseText: jqXHR.responseText,
                textStatus: textStatus,
                errorThrown: errorThrown
            });
        }
    });
});
});

function excluirUsuario(userId){

    console.log(userId)

    // Verifica se todos os campos necessários foram preenchidos
    if (!userId) {
        alert('Não foi possível localizar o usuário!');
        return;
    }

    $.ajax({
        url: 'http://localhost:80/API-excluir-usuario',
        method: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify({
            "idUsuario": userId
        }),
        dataType: 'json',
        success: function(response) {
            console.log('Resposta:', response);
            window.location.href = 'http://localhost:80/usuarios';
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro:', {
                status: jqXHR.status,
                statusText: jqXHR.statusText,
                responseText: jqXHR.responseText,
                textStatus: textStatus,
                errorThrown: errorThrown
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('updateProductForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário

        const productId = document.getElementById('productId').value;
        const productDescription = document.getElementById('description').value;
        const productPrice = document.getElementById('price').value;

        // Verifica se todos os campos necessários foram preenchidos
        if (!productId || !productDescription || !productPrice || productPrice < 0) {
            alert('Preencha todos os campos corretamente!');
            return;
        }

        $.ajax({
            url: 'http://localhost:80/API-editar-produto',
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({
                "idProduto": productId,
                "descricaoProduto": productDescription,
                "precoProduto": productPrice,
            }),
            dataType: 'json',
            success: function(response) {
                console.log('Resposta:', response);
                window.location.href = 'http://localhost:80/produtos';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('createProductForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário

        const productDescription = document.getElementById('description').value;
        const productPrice = document.getElementById('price').value;

        // Verifica se todos os campos necessários foram preenchidos
        if (!productDescription || !productPrice || productPrice < 0) {
            alert('Preencha todos os campos corretamente!');
            return;
        }

        $.ajax({
            url: 'http://localhost:80/API-cadastrar-produto',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                "idProduto": null,
                "descricaoProduto": productDescription,
                "precoProduto": productPrice,
            }),
            dataType: 'json',
            success: function(response) {
                console.log('Resposta:', response);
                window.location.href = 'http://localhost:80/produtos';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Erro:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });
            }
        });
    });
});

function excluirProduto(productId){

    // Verifica se todos os campos necessários foram preenchidos
    if (!productId) {
        alert('Não foi possível localizar o produto!');
        return;
    }

    $.ajax({
        url: 'http://localhost:80/API-excluir-produto',
        method: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify({
            "idProduto": productId
        }),
        dataType: 'json',
        success: function(response) {
            console.log('Resposta:', response);
            window.location.href = 'http://localhost:80/produtos';
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro:', {
                status: jqXHR.status,
                statusText: jqXHR.statusText,
                responseText: jqXHR.responseText,
                textStatus: textStatus,
                errorThrown: errorThrown
            });
        }
    });
}