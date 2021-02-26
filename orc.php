<?php

declare(strict_types=1);


class Orc extends Character
{
     /** @var int */
     private $damage;

     public function __construct(float $newHealth,float $newRage)
     {
         Character::__construct($newHealth,$newRage);
         //echo "Un nouvel Orc apparait il a ".Character::getHealth()." points de vie, il a actuellement ".Character::getRage()." point de rage";
     }
     public function setDamage($param){
        $this->damage = $param;
     }

     public function getDamage(){
         return $this->damage;
     }
     

    public function attack(){
        $this->damage = (random_int(600,850)) ;
    }

    public function attacked($damage){
        $health = Character::getHealth();
        $health = $health - $damage;
        Character::setHealth($health);
        return $damage;
    }

}
