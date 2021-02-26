<?php
    session_start();
    require("Character.php");
    require("Hero.php");
    require("orc.php");

    if(!isset($_GET["whoFight"])){
        $newHero = new Hero(500, 0, "Excalibur", 100, "égide", 600);
        $newOrc = new Orc(500, 0);
        $_SESSION["hero"] = $newHero;
        $_SESSION["orc"] = $newOrc;
        var_dump($_SESSION["hero"]);
    }else{
        $whoFight = $_GET["whoFight"];
        if(($whoFight % 2) == 0){
            $damageHero = $newOrc->attacked(($newHero->getWeaponDamage() + $newHero->getRage()));
        }else{
            $newOrc->attack();
            $damageOrc = $newHero->attacked($newOrc->getDamage());
        }
    }