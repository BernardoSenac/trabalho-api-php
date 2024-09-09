<?php
    require_once './models/UserModel.php';

    class UserController{
        public function getUsers() {
            $userModel = new UserModel();

            $users = $userModel->getUsers();

            return json_encode([
                'error' => null,
                'result' => $users
            ]);
        }


        public function createUser() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idTipoUsuario']))
                return $this->error('Você deve informar o ID do tipo usuário!');

            if(empty($data['nomeUsuario']))
                return $this->error('Você deve informar o nome do usuário!');
            
            if(empty($data['cpfUsuario']))
                return $this->error('Você deve informar o CPF do usuário!');

            if(empty($data['senhaUsuario']))
                return $this->error('Você deve informar a senha do usuário!');

            if ((new userModel)->verifyCPF($data['idUsuario'], $data['cpfUsuario']))
                return $this->error('O CPF fornecido já foi cadastrado anteriormente!');
            
            $userModel = new UserModel();

            $userData = new UserModel(
                null,
                $data['idTipoUsuario'], 
                $data['nomeUsuario'], 
                $data['cpfUsuario'], 
                md5($data['senhaUsuario'])
            );

            $user = $userModel->createUser($userData);

            return json_encode([
                'error' => null,
                'result' => $user
            ]);
        }

        public function getUserById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');

            $userModel = new UserModel();

            $user = $userModel->getUserById($data['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $user
            ]);
        }

        public function updateUser() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');
            
            if(empty($data['idTipoUsuario']))
                return $this->error('Você deve informar o ID do tipo usuário!');

            if(empty($data['nomeUsuario']))
                return $this->error('Você deve informar o nome do usuário!');
            
            if(empty($data['cpfUsuario']))
                return $this->error('Você deve informar o CPF do usuário!');

            if(empty($data['senhaUsuario']))
                return $this->error('Você deve informar a senha do usuário!');

            if ((new userModel)->verifyCPF($data['idUsuario'], $data['cpfUsuario']))
                return $this->error('O CPF fornecido já foi cadastrado anteriormente!');

            $userData = new UserModel(
                $data['idUsuario'],
                $data['idTipoUsuario'], 
                $data['nomeUsuario'], 
                $data['cpfUsuario'], 
                md5($data['senhaUsuario'])
            );

            $user = $userData->updateUser();

            return json_encode([
                'error' => null,
                'result' => $user
            ]);
        }

        public function deleteUser() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idUsuario']))
                return $this->error('Você deve informar o ID do usuário!');

            $userModel = new UserModel();

            $user = $userModel->deleteUser($data['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $user
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