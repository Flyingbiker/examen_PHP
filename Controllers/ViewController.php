<?php

namespace Controllers;

use Components\Database\DataAccessLayer;

class ViewController {

    public function displayAccueil()
    {
        $title = 'Accueil';
        $metaContent = 'Lorem Ipsum Meta Accueil';

        ob_start();

        require 'Views/accueil.php';

        $pageContent = ob_get_clean();
        require 'Views/Template.php';
    }

    public function displayAllClients()
    {
        $title = 'Accueil';
        $metaContent = 'Lorem Ipsum Meta Accueil';

        $data = new DataAccessLayer();
        $clientsArray = $data->selectAllClients();


        ob_start();

        require 'Views/allClients.php';

        $pageContent = ob_get_clean();
        require 'Views/Template.php';
    }

}