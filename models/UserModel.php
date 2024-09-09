<?php
    require_once 'DAL/UserDAO.php';

    class UserModel{
        public ?int $userId;
        public ?int $userTypeId;
        public ?string $userName;
        public ?string $userCpf;
        public ?string $userPassword;

        public function __construct(
            ?int $userId = null, 
            ?int $userTypeId = null, 
            ?string $userName = null, 
            ?string $userCpf = null,
            ?string $userPassword = null
        )
        {
            $this->userId = $userId;
            $this->userTypeId = $userTypeId;
            $this->userName = $userName;
            $this->userCpf = $userCpf;
            $this->userPassword = $userPassword;
        }

        public function getUsers(){
            $userDAO = new UserDAO();

            $users = $userDAO->getUsers();

            foreach ($users as $key => $user){
                    $users[$key] = new UserModel(
                    $user['idUsuario'], 
                    $user['idTipoUsuario'],
                    $user['nomeUsuario'],
                    $user['cpfUsuario'],
                    $user['senhaUsuario']
                );
            }

            return $users;
        }

        public function verifyCPF(?int $userId, string $userCPF){
            $userDAO = new UserDAO();

            return $userDAO->verifyCPF($userId, $userCPF);
        }

        public function createUser(UserModel $userData){
            $userDAO = new UserDAO();

            return $userDAO->createUser($userData);
        }

        public function getUserById(int $userId){
            $userDAO = new UserDAO();

            $user = $userDAO->getUserById($userId);

            return new UserModel(
                $user['idUsuario'], 
                $user['idTipoUsuario'],
                $user['nomeUsuario'],
                $user['cpfUsuario'],
                $user['senhaUsuario']
            );

        }

        public function updateUser(){
            $userDAO = new UserDAO();

            return $userDAO->updateUser($this);
        }

        public function deleteUser(int $userId){
            $userDAO = new UserDAO();

            return $userDAO->deleteUser($userId);
        }
    }
?>