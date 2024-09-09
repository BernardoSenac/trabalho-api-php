<?php
    require_once './models/StatusModel.php';

    class StatusController{
        public function getStatuses() {
            $statusModel = new StatusModel();

            $statuses = $statusModel->getStatuses();

            return json_encode([
                'error' => null,
                'result' => $statuses
            ]);
        }

        public function getStatusById() {
            $data = json_decode(file_get_contents('php://input'), true);

            if(empty($data['idStatus']))
                return $this->error('Você deve informar o ID do status!');

            $statusModel = new StatusModel();

            $status = $statusModel->getStatusById($data['idStatus']);

            return json_encode([
                'error' => null,
                'result' => $status
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