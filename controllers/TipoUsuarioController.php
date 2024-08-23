<?php
    require_once './models/TipoUsuarioModel.php';

    class TipoUsuarioController {
        public function getTiposUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            $tipoUsuarioModel = new TipoUsuarioModel();

            $response = $tipoUsuarioModel->getTiposUsuario();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getTipoUsuarioById() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idTipoUsuario']))
                return $this->mostrarErro('Você deve informar o idTipoUsuario!');

            $tipoUsuarioModel = new TipoUsuarioModel();
            $tipoUsuario = new TipoUsuarioModel($dados['idTipoUsuario']);

            $response = $tipoUsuarioModel->getTipoUsuarioById($tipoUsuario);

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