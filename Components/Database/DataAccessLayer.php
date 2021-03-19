<?php

namespace Components\Database;

use Models\Client;
use Models\Travel;

class DataAccessLayer
{
    private $host = 'localhost'; // localhost / 127.0.0.1
    private $db = 'examen_php';
    private $user = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $port = '3308';
    private $pdo;


    /**
     * DataAccessLayer constructor.
     * @throws DatabaseNotConnectedException
     */
    public function __construct()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s;port=%s",
            $this->host, $this->db, $this->charset, $this->port);

        try {
            // une exception peut être jetée
            $this->pdo = new \PDO($dsn, $this->user, $this->password);
        } catch (\PDOException $e) { // j'attrape l'exception de PDO
            // je jete une nouvelle exception personnalisée
            throw new DatabaseNotConnectedException("Erreur de connexion à la bdd");
        }

        // si exception, le code qui suit n'est pas exécuté
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    public function insertUser(Client $client) : Client
    {
        $query = $this->pdo->prepare('INSERT INTO clients(firstname, lastname, email, age) 
            VALUES (:firstname, :lastname, :email, :age)');
        $query->execute([
            'firstname' =>$client->getFirstName(),
            'lastname' =>$client->getLastName(),
            'email' =>$client->getEmail(),
            'age' =>$client->getAge(),
        ]);

        return $client;
    }

    public function selectAllClients() : ?array
    {
        $query = $this->pdo->prepare('SELECT * FROM clients');
        $query->execute();

        $clientsArray = [];
        while($row = $query->fetch()) {
            $client = new Client();
            $client->setId($row['id']);
            $client->setFirstName($row['firstname']);
            $client->setLastName($row['lastname']);
            $client->setEmail($row['email']);
            $client->setAge($row['age']);
            $clientsArray[] = $client;
        }

        return $clientsArray;
    }

    public function selectUserById(int $id) : ?Client
    {
        $query = $this->pdo->prepare('SELECT * FROM clients WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);

        $data = $query->fetchAll();
        if (count($data) === 0) {
            throw new DatabaseNotConnectedException('Le user n\'a pas été trouvé dans la BDD!');
        } else {
            $client = new Client();
            $client->setId($data[0]['id']);
            $client->setFirstName($data[0]['firstname']);
            $client->setLastName($data[0]['lastname']);
            $client->setEmail($data[0]['email']);
            $client->setAge($data[0]['age']);
            
            return $client;
        }
    }

    public function insertTravel(Travel $travel) :Travel
    {
        $query = $this->pdo->prepare('INSERT INTO travels(departure, arrival, date, client_id) 
            VALUES (:departure, :arrival, :date, :client_id)');
        $query->execute([
            'departure' =>$travel->getDeparture(),
            'arrival' =>$travel->getArrival(),
            'date' =>$travel->getDate()->format('Y-m-d H:i:s'),
            'client_id' =>$travel->getClientId(),
        ]);

        return $travel;
    }

    public function selectTravelsByClient(int $idClient) : array
    {
        $query = $this->pdo->prepare('SELECT * FROM travels AS t 
            INNER JOIN clients as c 
            ON c.id = t.client_id
            WHERE t.client_id = :id');
        $query->execute([
            'id' => $idClient
        ]);

        $travelsArray = [];
        while($row = $query->fetch()) {
            $travel = new Travel();
            $travel->setId($row['id']);
            $travel->setDeparture($row['departure']);
            $travel->setArrival($row['arrival']);
            $travel->setDate($row['date']);
            $travel->setClientId($row['client_id']);

            $travelsArray[] = $travel;
        }

        return $travelsArray;
    }
}