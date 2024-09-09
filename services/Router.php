<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/API-usuarios' => [
                        'controller' => 'UserController',
                        'function' => 'getUsers'
                    ],
                    '/API-produtos' => [
                        'controller' => 'ProductController',
                        'function' => 'getProducts'
                    ],
                    '/API-pedidos' => [
                        'controller' => 'OrderController',
                        'function' => 'getOrders'
                    ],
                    '/API-status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatuses'
                    ],
                    '/API-tipos-usuario' => [
                        'controller' => 'UserTypeController',
                        'function' => 'getUserTypes'
                    ],
                    '/' => [ #redireciona para a tela principal
                        'controller' => 'telasController',
                        'function' => 'redirectToPrincipal'
                    ],
                    '/editar-usuario' => [
                        'controller' => 'telasController',
                        'function' => 'editarUsuario'
                    ],
                    '/editar-produto' => [
                        'controller' => 'telasController',
                        'function' => 'editarProduto'
                    ],
                    '/cadastrar-usuario' => [
                        'controller' => 'telasController',
                        'function' => 'cadastrarUsuario'
                    ],
                    '/cadastrar-produto' => [
                        'controller' => 'telasController',
                        'function' => 'cadastrarProduto'
                    ],
                    '/principal' => [
                        'controller' => 'telasController',
                        'function' => 'principal'
                    ],
                    '/usuarios' => [
                        'controller' => 'telasController',
                        'function' => 'usuarios'
                    ],
                    '/produtos' => [
                        'controller' => 'telasController',
                        'function' => 'produtos'
                    ],
                    '/pedidos-usuario' => [
                        'controller' => 'telasController',
                        'function' => 'pedidosUsuario'
                    ]
                ],
                'POST' => [
                    '/API-buscar-tipo-usuario' => [
                        'controller' => 'UserTypeController',
                        'function' => 'getUserTypeById'
                    ],
                    '/API-cadastrar-usuario' => [
                        'controller' => 'UserController',
                        'function' => 'createUser'
                    ],
                    '/API-cadastrar-produto' => [
                        'controller' => 'ProductController',
                        'function' => 'createProduct'
                    ],
                    '/API-cadastrar-pedido' => [
                        'controller' => 'OrderController',
                        'function' => 'createOrder'
                    ],
                    '/API-cadastrar-item-pedido' => [
                        'controller' => 'OrderItemController',
                        'function' => 'createOrderItem'
                    ],
                    '/API-usuario' => [
                        'controller' => 'UserController',
                        'function' => 'getUserById'
                    ],
                    '/API-produto' => [
                        'controller' => 'ProductController',
                        'function' => 'getProductById'
                    ],
                    '/API-pedido' => [
                        'controller' => 'OrderController',
                        'function' => 'getOrderById'
                    ],
                    '/API-pedidos-pessoa' => [
                        'controller' => 'OrderController',
                        'function' => 'getOrdersByUserId'
                    ],
                    '/API-itens-pedido' => [
                        'controller' => 'OrderItemController',
                        'function' => 'getOrderItemsById'
                    ],
                    '/API-valor-total-pedido' => [
                        'controller' => 'OrderItemController',
                        'function' => 'getOrderPriceByOrderId'
                    ],
                    '/API-status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatusById'
                    ]  
                ],
                'PUT' => [
                    '/API-editar-usuario' => [
                        'controller' => 'UserController',
                        'function' => 'updateUser'
                    ],
                    '/API-editar-produto' => [
                        'controller' => 'ProductController',
                        'function' => 'updateProduct'
                    ],
                    '/API-editar-pedido' => [
                        'controller' => 'OrderController',
                        'function' => 'updateOrder'
                    ],
                    '/API-editar-item-pedido' => [
                        'controller' => 'OrderItemController',
                        'function' => 'updateOrderItem'
                    ],
                    '/API-editar-status-pedido' => [
                        'controller' => 'orderController',
                        'function' => 'updateOrderStatusById'
                    ]
                ],
                'DELETE' => [
                    '/API-excluir-usuario' => [
                        'controller' => 'UserController',
                        'function' => 'deleteUser'
                    ],
                    '/API-excluir-produto' => [
                        'controller' => 'ProductController',
                        'function' => 'deleteProduct'
                    ],
                    '/API-excluir-pedido' => [
                        'controller' => 'OrderController',
                        'function' => 'deleteOrder'
                    ],
                    '/API-excluir-item-pedido' => [
                        'controller' => 'OrderItemController',
                        'function' => 'deleteOrderItem'
                    ]
                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            // Remover parâmetros de consulta da URL
            $route = explode('?', $route)[0];
        
            $routeExists = !empty($this->routes[$method][$route]);
        
            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!' . $route,
                    'result' => null
                ]);
            }
        
            $routeInfo = $this->routes[$method][$route];
        
            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];
        
            require_once __DIR__ . '/../controllers/' . $controller . '.php';
        
            return (new $controller)->$function();
        }
        
    }
?>