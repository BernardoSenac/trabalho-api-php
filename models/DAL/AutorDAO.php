<?php
    require_once 'Conexao.php';

    class AutorDAO {
        public function getAutores() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM autor;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createAutor(autorModel $autor) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO autor VALUES(null, :nome);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nome', $autor->nomeAutor);
            
            return $stmt->execute();
        }

        public function updateAutor(AutorModel $autor){
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE autor SET nomeAutor = :nomeAutor WHERE idAutor = :idAutor;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':nomeAutor', $autor->nomeAutor);
            $stmt->bindValue(':idAutor', $autor->idAutor);
    
            return $stmt->execute();
        }

        public function deleteAutor(AutorModel $autor){
            $conexao = (new Conexao())->getConexao();
    
            $sql = "DELETE FROM autor WHERE idAutor = :idAutor;";
    
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idAutor', $autor->idAutor);
        
            return $stmt->execute();
        }

        public function getAutorById(AutorModel $autor) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM autor WHERE idAutor = :idAutor;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idAutor', $autor->idAutor);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>