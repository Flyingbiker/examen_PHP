<?php

require ('autoload.php');

use Components\Http\Exceptions\MethodNotAllowedHttpException;
use Components\Http\Exceptions\NotFoundHttpException;
use Components\Http\Request;
use Controllers\ClientController;
use Controllers\TravelController;
use Controllers\ViewController;

$request = new Request();
$controller = $request->_get('controller');
$action = $request->_get('action');

try {
    switch ($controller) {
        case 'views':
            $viewController = new ViewController();
            switch ($action) {
                case 'accueil' :
                    $viewController->displayAccueil();
                    break;

                case 'allClient' : 
                    $viewController->displayAllClients();
                    break;
            }
            break;
        case 'clients':
            $clientController = new ClientController();
            switch ($action) {
                case 'addBdd' : 
                    if ($request->getMethod() === 'POST') {
                        $client = $clientController->addClientBDD($request);
                        header('Location: index.php?controller=views&action=allClient');

                    } elseif ($request->getMethod() === 'GET') {
                        throw new MethodNotAllowedHttpException();
                    }                    
                    break;
                    
                case 'addForm' :
                    $clientController->addClientForm();
                    
                    break;

                case 'view' :
                    if ($request->hasGetParam('id')){
                        $clientController->clientView($request->_get('id'));
                    } else {
                        throw new NotFoundHttpException('Il manque l\'id dans la requête');
                    }

                    break;
            }
            // if ($request->hasGetParam('id')){
            //     $userController->getPostsByUser($request->_get('id'));
            // } else {
            //     $userController->getAllUsers();
            // }
            break;
        
        case 'travels':
            $travelController = new TravelController();

            switch ($action) {
                case 'addForm' :
                    $travelController->addTravelForm($request);

                    break;
                case 'addBdd' :
                    if ($request->getMethod() === 'POST') {
                        $idClient = $request->_get('idClient');
                        $travel = $travelController->addTravelBdd($request, $idClient);
                        
                        $clientController = new ClientController();
                        // $client = $clientController->clientView($idClient);

                        $client = $clientController->getClientById($idClient);
                        
                        $resultAPI = $clientController->emailConfirm($client);

                        header('Location: index.php?controller=clients&action=view&id='.$idClient);

                    } elseif ($request->getMethod() === 'GET') {
                        throw new MethodNotAllowedHttpException();
                    }          
            }

            break;
    }

} catch (NotFoundHttpException $e){
    echo $e->getMessage();    
} catch(MethodNotAllowedHttpException $e){
    echo $e->getMessage();    
} catch (\Exception $e){
    echo $e->getMessage();    
}