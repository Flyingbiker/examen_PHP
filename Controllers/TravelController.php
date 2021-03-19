<?php

namespace Controllers;

use Components\Database\DataAccessLayer;
use Components\Http\Exceptions\NotFoundHttpException;
use Components\Http\Request;
use Models\Travel;

class TravelController {

    public function addTravelForm(Request $request)
    {
        $title = 'Ajouter un voyage';
        $metaContent = 'Lorem Ipsum Meta Ajouter voyage';

        $data = new DataAccessLayer();
        $client = $data->selectUserById($request->_get('idClient'));


        $idClient = $request->_get('idClient');
        ob_start();

        require 'Views/addTravelForm.php' ;
        $pageContent = ob_get_clean();
        require 'Views/Template.php';

    }

    public function addTravelBdd(Request $request, int $idClient) : Travel
    {
        $data = new DataAccessLayer();
        $travel = new Travel();
        $travel->setDeparture($request->_post('departure'));
        $travel->setArrival($request->_post('arrival'));
        $travel->setDate($request->_post('date'));
        $travel->setClientId($idClient);
        
        $result = $data->insertTravel($travel); 


        if ($result === null) {
            throw new NotFoundHttpException();
        } 

        return $travel;

    }
  

}