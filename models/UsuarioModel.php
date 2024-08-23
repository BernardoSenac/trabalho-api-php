<?php
    require_once 'DAL/UsuarioDAO.php';

    class UsuarioModel {
        public ?int $idUsuario;
        public ?int $idTipoUsuario;
        public ?string $nomeUsuario;
        public ?string $emailUsuario;
        public ?string $senhaUsuario;

        public function __construct(
            ?int $idUsuario = null, 
            ?int $idTipoUsuario = null,
            ?string $nomeUsuario = null,
            ?string $emailUsuario = null,
            ?string $senhaUsuario = null
        ) {
            $this->idUsuario = $idUsuario;
            $this->idTipoUsuario = $idTipoUsuario;
            $this->nomeUsuario = $nomeUsuario;
            $this->emailUsuario = $emailUsuario;
            $this->senhaUsuario = $senhaUsuario;
        }

        public function getUsuarios() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->getUsuarios($this);
        }

        public function createUsuario() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->createUsuario($this);

            foreach($usuarios as &$usuario){
                $usuario = new UsuarioModel(
                    $usuario['idUsuario'],
                    $usuario['idTipoUsuario'],
                    $usuario['nomeUsuario'],
                    $usuario['emailUsuario'],
                    $usuario['senhaUsuario']
                );
            }

            return $usuarios;
        }

        public function updateUsuario() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->updateUsuario($this);
        }

        public function deleteUsuario() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->deleteUsuario($this);
        }

        public function getUsuarioById(UsuarioModel $usuario) {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->getUsuarioById($usuario);
        }

        public function getUsuarioByEmail($email) {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->getUsuarioByEmail($email);
        }

        public function getUsuarioByEmailAndSenha($email, $senha){
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->getUsuarioByEmailAndSenha($email, $senha);
        }
    }
?>