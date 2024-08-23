<?php
    require_once 'Conexao.php';

    class TipoUsuarioDAO {
        public function getTipoUsuarioById(TipoUsuarioModel $tipoUsuario){
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM tipo_usuario WHERE idTipoUsuario = :idTipoUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idTipoUsuario', $tipoUsuario->idTipoUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getTiposUsuario(){
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM tipo_usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>