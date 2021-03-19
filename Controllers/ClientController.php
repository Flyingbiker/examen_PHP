<?php

namespace Controllers;

use Components\Database\DataAccessLayer;
use Components\Http\Exceptions\NotFoundHttpException;
use Components\Http\Request as HttpRequest;
use Models\Client;

class ClientController {

    public function addClientForm()
    {
        $title = 'Ajouter un client';
        $metaContent = 'Lorem Ipsum Meta Ajouter client';

        ob_start();

        require 'Views/addClientForm.php' ;

        $pageContent = ob_get_clean();
        require 'Views/Template.php';
    }

    public function clientView(int $id ) : Client
    {

        $title = 'Ajouter un client';
        $metaContent = 'Lorem Ipsum Meta Ajouter client';

        $data = new DataAccessLayer();

        $client = $data->selectUserById($id);        
        $travelsArray = $data->selectTravelsByClient($id);

        if ($client !== null) {
            ob_start();
    
            require 'Views/clientView.php';
            $pageContent = ob_get_clean();
            require 'Views/Template.php';
    
            return $client;
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function getClientById(int $id) : Client
    {
        $data = new DataAccessLayer();

        $client = $data->selectUserById($id);
        return $client; 
    }

    public function addClientBDD(HttpRequest $request)
    {
        $data = new DataAccessLayer();
        $client = new Client();
        
        $client->setFirstName($request->_post()['firstName']);
        $client->setLastName($request->_post()['lastName']);
        $client->setEmail($request->_post()['email']);
        $client->setAge($request->_post()['age']);

        $data->insertUser($client); 

        return $client;

    }
    
    public function emailConfirm(Client $client)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://www.mocky.io/v2/5e863f68310000082981390c');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, 'Content-Type: application/json');

        $data = json_encode($client);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $result = curl_exec($curl);

        if ($result !== null){
            var_dump($result);
        } else {
            throw new NotFoundHttpException();
        }

        curl_close($curl);
    }

}