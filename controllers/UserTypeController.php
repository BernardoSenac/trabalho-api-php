<?php
    require_once './models/UserTypeModel.php';

    class UserTypeController{
        public function getUserTypes(){
            $userTypeModel = new UserTypeModel();

            $userTypes = $userTypeModel->getUserTypes();

            return json_encode([
                'error' => null,
                'result' => $userTypes
            ]);
        }

        public function getUserTypeById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idTipoUsuario']))
                return $this->error('Você deve informar o ID do tipo de usuário!');

            $userTypeModel = new UserTypeModel();

            $userType = $userTypeModel->getUserTypeById($data['idTipoUsuario']);

            return json_encode([
                'error' => null,
                'result' => $userType
            ]);
        }

        private function error(string $message) {
            return json_encode([
                'error' => $message,
                'result' => null
            ]);
        }
    }
?>