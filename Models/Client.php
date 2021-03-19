<?php

namespace Models;


class Client implements \JsonSerializable
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $age;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'age' => $this->age
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
     * @return string
     */
    public function getFirstName() :string
    {
        return $this->firstName;
    }

    /**
     * @param string $name
     */
    public function setFirstName(string $name): void
    {
        $this->firstName = $name;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @param string $name
     */
    public function setLastName(string $name): void
    {
        $this->lastName = $name;
    }



    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getAge() : int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}