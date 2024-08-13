<?php
    require_once 'Conexao.php';

    class NoticiaDAO {
        public function getNoticias() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM noticia;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createNoticia(NoticiaModel $noticia) {
            $conexao = (new Conexao())->getConexao();
            
            $sql = "INSERT INTO noticia VALUES(:id, :idAutor, :titulo, :conteudo, :imagem);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':idAutor', $noticia->idAutor);
            $stmt->bindValue(':titulo', $noticia->tituloNoticia);
            $stmt->bindValue(':conteudo', $noticia->conteudoNoticia);
            $stmt->bindValue(':imagem', $noticia->imagemNoticia);

            return $stmt->execute();
        }

        public function updateNoticia(NoticiaModel $noticia){
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE noticia SET idAutor = :idAutor, tituloNoticia = :tituloNoticia, conteudoNoticia = :conteudoNoticia, imagemNoticia = :imagemNoticia WHERE idNoticia = :idNoticia;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idAutor', $noticia->idAutor);
            $stmt->bindValue(':tituloNoticia', $noticia->tituloNoticia);
            $stmt->bindValue(':conteudoNoticia', $noticia->conteudoNoticia);
            $stmt->bindValue(':imagemNoticia', $noticia->imagemNoticia);
            $stmt->bindValue(':idNoticia', $noticia->idNoticia);
    
            return $stmt->execute();
        }
        
        public function deleteNoticia(NoticiaModel $noticia){
            $conexao = (new Conexao())->getConexao();
    
            $sql = "DELETE FROM noticia WHERE idNoticia = :idNoticia;";
    
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idNoticia', $noticia->idNoticia);
        
            return $stmt->execute();
        }
    }
?>