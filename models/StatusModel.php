<?php
    require_once 'DAL/StatusDAO.php';

    class StatusModel{
        public ?int $statusId;
        public ?string $statusDescription;

        public function __construct(
            ?int $statusId = null, 
            ?string $statusDescription = null, 
        )
        {
            $this->statusId = $statusId;
            $this->statusDescription = $statusDescription;
        }

        public function getStatuses(){
            $statusDAO = new StatusDAO();

            $statuses = $statusDAO->getStatuses();

            foreach ($statuses as $key => $status){
                    $statuses[$key] = new StatusModel(
                    $status['idStatus'],
                    $status['descricaoStatus']
                );
            }

            return $statuses;
        }

        public function getStatusById(int $statusId){
            $statusDAO = new StatusDAO();

            $status = $statusDAO->getStatusById($statusId);

            return new StatusModel(
                $status['idStatus'], 
                $status['descricaoStatus']
            );
        }
    }
?>
