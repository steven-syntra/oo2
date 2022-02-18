<?php

class ShipLoader
{
    private $pdo;

    /**
     * @return PDO
     */
    private function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }

    /**
     * @return Ship[]
     */
    public function getShips(): array
    {
        $ships = array();
        $shipsData = $this->queryForShips();

        foreach ($shipsData as $shipData)
        {
            $ships[] = $this->createShipFromData($shipData);
        }

        return $ships;
    }

    private function queryForShips(): array
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM ship');
        $statement->execute();
        $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $shipsArray;
    }

    public function findOneById($id): ?Ship
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$shipArray) return null;

        $ship = $this->createShipFromData($shipArray);
        return $ship;
    }

    private function createShipFromData(array $shipData): Ship
    {
        $ship = new Ship($shipData['name']);
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);
        $ship->setStrength($shipData['strength']);
        return $ship;
    }
}