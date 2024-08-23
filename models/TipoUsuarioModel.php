<?php
    require_once 'DAL/TipoUsuarioDAO.php';

    class TipoUsuarioModel {
        public ?int $idTipoUsuario;
        public ?string $descricaoTipoUsuario;

        public function __construct(
            ?int $idTipoUsuario = null,
            ?string $descricaoTipoUsuario = null
        ) {
            $this->idTipoUsuario = $idTipoUsuario;
            $this->descricaoTipoUsuario = $descricaoTipoUsuario;
        }

        public function getTiposUsuario(){
            $tipoUsuarioDAO = new TipoUsuarioDAO();

            return $tipoUsuarioDAO->getTiposUsuario();
        }

        public function getTipoUsuarioById(TipoUsuarioModel $tipoUsuario) {
            $tipoUsuarioDAO = new TipoUsuarioDAO();

            return $tipoUsuarioDAO->getTipoUsuarioById($tipoUsuario);
        }
    }
?>