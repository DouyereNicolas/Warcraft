<?php

declare(strict_types=1);


class Character
{

    /** @var float */
    private $health;

    /** @var float */
    private $rage;

    public function __construct(float $newHealth, float $newRage)
    {
       $this->health = $newHealth;
       //$this->setHealth($newHealth);
       $this->rage = $newRage;
    }

    /**
     * 
     * retourne la vie
     */
    public function getHealth()
    {
        return $this->health;
    }
    /**
     * 
     * retourne la rage
     */
    public function getRage()
    {
        return $this->rage;
    }

    /**
     * 
     * remplace la vie
     */
    public function setHealth($param)
    {
        $this->health = $param;
    }
    /**
     * 
     * remplace la rage
     */
    public function setRage($param)
    {
        $this->rage = $param;
    }

    public function upRage(){
        $this->rage += 30;
    }
}
?>