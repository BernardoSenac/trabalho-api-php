<?php
    require_once 'Conexao.php';

    class TipoUsuarioDAO {
        public function getTipoUsuarioById(TipoUsuarioModel $tipoUsuario){
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM tipo_usuario WHERE idTipoUsuario = :idTipoUsuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':IdTipoUsuario', $tipoUsuario->idTipoUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>