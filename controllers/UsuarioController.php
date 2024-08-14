<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idTipoUsuario']))
                return $this->mostrarErro('Você deve informar o idTipoUsuario!');

            if(empty($dados['nomeUsuario']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if(empty($dados['emailUsuario']))
                return $this->mostrarErro('Você deve informar o emailUsuario!');

            if(empty($dados['senhaUsuario']))
                return $this->mostrarErro('Você deve informar o Usuario!');

            $usuario = new UsuarioModel(
                null,
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->createUsuario();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            if(empty($dados['idTipoUsuario']))
                return $this->mostrarErro('Você deve informar o idTipoUsuario!');

            if(empty($dados['nomeUsuario']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if(empty($dados['emailUsuario']))
                return $this->mostrarErro('Você deve informar o emailUsuario!');

            if(empty($dados['senhaUsuario']))
                return $this->mostrarErro('Você deve informar o Usuario!');

            $usuario = new UsuarioModel(
                $dados['idUsuario'],
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->updateUsuario();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            $usuario = new UsuarioModel($dados['idUsuario']);

            $usuario->deleteUsuario();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getUsuarioById() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            $usuarioModel = new UsuarioModel();
            $usuario = new UsuarioModel($dados['idUsuario']);

            $response = $usuarioModel->getUsuarioById($usuario);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }
        
        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>