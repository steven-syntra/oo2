<?php

class BattleResult
{
    private $winningShip;
    private $losingShip;
    private $used_jedi_powers;

    public function __construct(Ship $winningShip = null, Ship $losingShip = null, bool $used_jedi_powers)
    {
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
        $this->used_jedi_powers = $used_jedi_powers;
    }

    public function getWinningShip(): ?Ship
    {
        return $this->winningShip;
    }

    public function getLosingShip(): ?Ship
    {
        return $this->losingShip;
    }

    public function WhereJediPowersUsed(): bool
    {
        return $this->used_jedi_powers;
    }

    public function IsThereAWinner(): bool
    {
        return $this->getWinningShip() !== null;
    }

}