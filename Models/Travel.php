<?php

namespace Models;


class Travel implements \JsonSerializable
{
    private $id;
    private $departure;
    private $arrival;
    private $date;
    private $clientId;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'departure' => $this->departure,
            'arrival' => $this->arrival,
            'date' => $this->date,
            'clientId' => $this->clientId
        ];
    }

    /**
     * Fonction implémentée pour l'interface JsonSerializable
     * Cette fonction détermine COMMENT représenter l'objet en JSON
     * Elle sera automatiquement appelée par la fonction json_encode
     * si la classe implémente l'interface JsonSerializable.
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the value of departure
     */ 
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set the value of departure
     *
     * @return  self
     */ 
    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get the value of arrival
     */ 
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set the value of arrival
     *
     * @return  self
     */ 
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate(string $date)
    {
        $this->date = new \DateTime($date);

        return $this;
    }

    /**
     * Get the value of clientId
     */ 
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set the value of clientId
     *
     * @return  self
     */ 
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }
}