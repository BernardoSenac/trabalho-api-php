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
    require_once './models/UserModel.php';
    require_once './models/userTypeModel.php';

    $userModel = new UserModel();
    $userTypeModel = new UserTypeModel();

    $user = $userModel->getUserById($_GET['id']);
    $tiposUsuario = $userTypeModel->getUserTypes();
?>
<body>
    <header>
        <h1>Editar Informações do Usuário</h1>
    </header>
    <form id="updateUserForm">
        <label for="name">Nome</label>
        <br>
        <input type="text" value="<?=$user->userName?>" name="name" id="name" maxlength="100" required>
        <br>
        <label for="CPF">CPF</label>
        <br>
        <input type="text" value="<?=$user->userCpf?>" name="CPF" id="CPF" maxlength="11" minlength="11" required>
        <br>
        <label for="password">Alterar Senha</label>
        <br>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="userType">Tipo de Usuário</label>
        <br>
        <select name="userTypeId" id="userTypeId" required>
            <option value="0">Selecione:</option>
            <?php foreach($tiposUsuario as $tipoUsuario): ?>
                <option value="<?=$tipoUsuario->userTypeId?>"><?=$tipoUsuario->userTypeDescription?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>
        <input type="hidden" name="userId" id="userId" value="<?=$user->userId?>">
        <input type="submit" value="Editar">
    </form>
</body>
</html>
