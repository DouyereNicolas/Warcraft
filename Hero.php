<?php

declare(strict_types=1);


class Hero extends Character
{
     /** @var string */
     private $weapon;
     /** @var float */
     private $weaponDamage;
     /** @var string */
     private $shield;
     /** @var float */
     private $shieldValue;

     public function __construct(float $newHealth,float $newRage,string $newWeapon, float $newWeaponDamage, string $newShield, float $newShieldValue)
    {
        Character::__construct($newHealth,$newRage);
        //parent::__construct($newHealth,$newRage);
        $this->weapon = $newWeapon;
        //$this->setWeapon($newWeapon);
        $this->weaponDamage = $newWeaponDamage;
        $this->shield = $newShield;
        $this->shieldValue = $newShieldValue;
        /*echo "votre héro a ".Character::getHealth()." Hp et il a acuellement ".Character::getRage()." point de rage"
        ." son épée s'apelle : ".$this->weapon." et elle a ".$this->weaponDamage." dégats, il a également un bouclier qui s'apelle ".
        $this->shield." et qui a pour valeur d'armure ".$this->shieldValue;*/
    }

     /**
     * 
     * retourne le nom de l'arme
     */
    public function getWeapon()
    {
        return $this->weapon;
    }
    /**
     * 
     * retourne les degats de l'arme
     */
    public function getWeaponDamage()
    {
        return $this->weaponDamage;
    }
    /**
     * 
     * retourne le nom du bouclier
     */
    public function getShield()
    {
        return $this->shield;
    }
    /**
     * 
     * retourne le taux d'armure du bouclier
     */
    public function getShieldValue()
    {
        return $this->shieldValue;
    }

    /**
     * 
     * remplace l'arme
     */
    public function setWeapon($param)
    {
        $this->weapon = $param;
    }
    /**
     * 
     * remplace les degats de l'arme
     */
    public function setWeaponDamage($param)
    {
        $this->weaponDamage = $param;
    }
    /**
     * 
     * remplace le bouclier
     */
    public function setShield($param)
    {
        $this->shield = $param;
    }
    /**
     * 
     * remplace l'armure du bouclier
     */
    public function setShieldValue($param)
    {
        $this->shieldValue = $param;
    }

    public function attacked($damage){
        $health = Character::getHealth();
        $totalDamage = $damage - $this->shieldValue;
        if($damage > $this->shieldValue){
            $health = $health - $totalDamage ;
            Character::setHealth($health);
            Character::upRage();
            return $totalDamage;
        }else{
            return 0;
        }
    }
}
?>