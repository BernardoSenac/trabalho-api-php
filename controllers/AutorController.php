<?php
    require_once './models/AutorModel.php';

    class AutorController {
        public function getAutores() {
            $autorModel = new AutorModel();

            $response = $autorModel->getAutores();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }
    
        public function createAutor() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['nomeAutor']))
                return $this->mostrarErro('Você deve informar o nome do autor!');

            $autor = new AutorModel(
                null, 
                $dados['nomeAutor']
            );

            $response = $autor->createAutor();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateAutor() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idAutor']))
                return $this->mostrarErro('Você deve informar o idAutor!');

            if(empty($dados['nomeAutor']))
                return $this->mostrarErro('Você deve informar o nomeAutor!');

            $autor = new AutorModel(
                $dados['idAutor'],
                $dados['nomeAutor']
            );

            $response = $autor->updateAutor();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteAutor(){
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idAutor']))
                return $this->mostrarErro('Você deve informar o idAutor!');

            $autor = new AutorModel($dados['idAutor']);

            $response = $autor->deleteAutor();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        
        public function getAutorById() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idAutor']))
                return $this->mostrarErro('Você deve informar o idAutor!');

            $autorModel = new AutorModel();
            $autor = new NoticiaModel($dados['idAutor']);

            $response = $autorModel->getAutorById($autor);

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