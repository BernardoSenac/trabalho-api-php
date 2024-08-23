<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios(){
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createUsuario(UsuarioModel $usuario){
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO usuario VALUES(null, :idTipoUsuario, :nomeUsuario, :emailUsuario, :senhaUsuario);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idTipoUsuario', $usuario->idTipoUsuario);
            $stmt->bindValue(':nomeUsuario', $usuario->nomeUsuario);
            $stmt->bindValue(':emailUsuario', $usuario->emailUsuario);
            $stmt->bindValue(':senhaUsuario', $usuario->senhaUsuario);
            
            return $stmt->execute();
        }

        public function updateUsuario(UsuarioModel $usuario){
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE usuario SET idTipoUsuario = :idTipoUsuario, nomeUsuario = :nomeUsuario, emailUsuario = :emailUsuario, senhaUsuario = :senhaUsuario WHERE idUsuario = :idUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idTipoUsuario', $usuario->idTipoUsuario);
            $stmt->bindValue(':nomeUsuario', $usuario->nomeUsuario);
            $stmt->bindValue(':emailUsuario', $usuario->emailUsuario);
            $stmt->bindValue(':senhaUsuario', $usuario->senhaUsuario);
            $stmt->bindValue(':idUsuario', $usuario->idUsuario);

            return $stmt->execute();
        }

        public function deleteUsuario(UsuarioModel $usuario){
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM usuario WHERE idUsuario = :idUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idUsuario', $usuario->idUsuario);
            
            return $stmt->execute();
        }

        public function getUsuarioById(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE idUsuario = :idUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idUsuario', $usuario->idUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsuarioByEmail($email) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE emailUsuario = :email;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsuarioByEmailAndSenha($email, $senha) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE emailUsuario = :email AND senhaUsuario = :senha;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>