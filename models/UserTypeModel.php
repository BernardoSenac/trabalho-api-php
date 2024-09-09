<?php
    require_once 'DAL/UserTypeDAO.php';

    class UserTypeModel{
        public ?int $userTypeId;
        public ?string $userTypeDescription;

        public function __construct(
            ?int $userTypeId = null, 
            ?string $userTypeDescription = null
        )
        {
            $this->userTypeId = $userTypeId;
            $this->userTypeDescription = $userTypeDescription;
        }

        public function getUserTypes(){
            $userTypeDAO = new UserTypeDAO();

            $userTypes = $userTypeDAO->getUserTypes();

            foreach ($userTypes as $key => $userType){
                    $userTypes[$key] = new UserTypeModel(
                    $userType['idTipoUsuario'], 
                    $userType['descricaoTipoUsuario']
                );
            }

            return $userTypes;
        }

        public function getUserTypeById(int $userTypeId){
            $userTypeDAO = new UserTypeDAO();

            $userType = $userTypeDAO->getUserTypeById($userTypeId);

            return new UserTypeModel(
                $userType['idTipoUsuario'], 
                $userType['descricaoTipoUsuario'],
            );

        }
    }
?>