<?php
    class telasController{
        public function principal(){
            require_once 'views/principal.php';
            die();
        }

        public function usuarios(){
            require_once 'views/usuario/usuarios.php';
            die();
        }

        public function redirectToPrincipal(){
            require_once 'views/principal.php';
            die();
        }

        public function editarUsuario(){
            require_once 'views/usuario/editar-usuario.php';
            die();
        }

        public function editarProduto(){
            require_once 'views/produto/editar-produto.php';
            die();
        }

        public function cadastrarUsuario(){
            require_once 'views/usuario/cadastrar-usuario.php';
            die();
        }

        public function cadastrarProduto(){
            require_once 'views/produto/cadastrar-produto.php';
            die();
        }

        public function produtos(){
            require_once 'views/produto/produtos.php';
            die();
        }

        public function pedidosUsuario(){
            require_once 'views/usuario/pedido/pedidos-usuario.php';
            die();
        }
    }
?>