<?php
require("Character.php");
require("Hero.php");
require("orc.php");

$newHero = new Hero(500, 0, "Excalibur", 100, "égide", 600);
$newOrc = new Orc(600, 0);
$whoAttak = 1;

while (($newHero->getHealth() > 0) && ($newOrc->getHealth() > 0)) {
    if (($whoAttak % 2) != 0) {
        $newOrc->attack();
        $damageOrc = $newHero->attacked($newOrc->getDamage());
        if ($newHero->getHealth() <= 0) {
            $newHero->setHealth(0);
        }
        $arrayCombat[] = array("degatOrc" => $newOrc->getDamage(), "vieHero" => $newHero->getHealth(), "rageHero" => $newHero->getRage(), "shieldValue" => $newHero->getShieldValue());
    } else {
        $damageHero = $newOrc->attacked(($newHero->getWeaponDamage() + $newHero->getRage()));
        if ($newOrc->getHealth() <= 0) {
            $newOrc->setHealth(0);
        }
        $arrayCombat[] = array("degatHero" => $damageHero, "vieOrc" => $newOrc->getHealth());
    }
    $whoAttak++;
}
?>

<!doctype html>
<html lang="fr">

<head>
    <title>Warcraft</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="gameOver" id="gameOver"></div>
        <div class="orc">
            
            <div class="imgOrc" id="imgOrc">
             <span id="epic"></span>
            </div>
            <div class="degOrc" id="degOrc">
            </div>
        </div>
        <div class="degat">
            <p id="degat">Figth</p>
        </div>
        <div class="hero">
            
            <div class="imgHero" id="imgHero">
            </div>
            <div class="degHero" id="degHero">
            </div>
        </div>
        <div class="blueBare">
            <div class="vieOrc">
                <progress id="vieOrc" max="100" value="100"></progress>
                <span id="hpOrc">600</span><span>/600 HP</span>
            </div>
            <div class="vieHero">
                <p><span id="hpHero">500</span><span>/500 HP</span><progress id="vieHero" max="100" value="100"></progress></p>
                <p><span id="textRageHero">0 </span><span>Rage</span><progress id="rageHero" max="100" value="0"></progress></p>
                
            </div>
            <div class="buttonLancement">
                <a href="index.php">lancer un nouveau combat</a>
                <button onclick="Fight();">Lancer le combat</button>
            </div>
        </div>

    </div>

    <script>
        var arrayCombat = <?php echo json_encode($arrayCombat); ?>;
        var longeur = arrayCombat.length;

        function pause(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function Fight() {
            for (let i = 0; i < longeur; i++) {


                if ((i % 2) != 0) {
                    
                    document.getElementById("imgOrc").style = "transform: translate(-50px);";
                    document.getElementById("vieOrc").value = ((arrayCombat[i]["vieOrc"]) / 600) * 100;
                    document.getElementById("hpOrc").innerHTML = arrayCombat[i]["vieOrc"];
                    document.getElementById("degat").innerHTML = arrayCombat[i]["degatHero"] + " Degats";
                    document.getElementById("degOrc").style = "visibility : visible";
                    document.getElementById("imgHero").style = "transform: translate(-50px);";
                    document.getElementById("degHero").style = "visibility : hidden";
                    console.log(arrayCombat[i]);
                    if (arrayCombat[i]["vieOrc"] == 0) {
                        document.getElementById("degat").innerHTML = "YOU WIN";
                        document.getElementById("degOrc").style = "visibility : hidden";
                        document.getElementById("imgOrc").style = "background-image:url('coffre.png')";
                        document.getElementById("imgOrc").addEventListener("click",event => {document.getElementById("imgOrc").style = "background-image:url('anou.png'),url('winner.gif');background-position: left;background-repeat: no-repeat;";document.getElementById("epic").innerHTML="EPIC LOOT";},false);
                        document.getElementById("epic").innerHTML="LOOTER???";
                    }
                } else {
                    document.getElementById("degOrc").style = "visibility : hidden";
                    document.getElementById("degHero").style = "visibility : visible";
                    document.getElementById("hpHero").innerHTML = arrayCombat[i]["vieHero"];
                    document.getElementById("textRageHero").innerHTML = arrayCombat[i]["rageHero"] + " ";
                    document.getElementById("imgOrc").style = "transform: translate(50px);";
                    document.getElementById("imgHero").style = "transform: translate(100px);";
                    
                    document.getElementById("vieHero").value = ((arrayCombat[i]["vieHero"]) / 500) * 100;
                    document.getElementById("rageHero").value = ((arrayCombat[i]["rageHero"]) / 200) * 100;
                    document.getElementById("degat").innerHTML = arrayCombat[i]["degatOrc"] - arrayCombat[i]["shieldValue"] + " Degats";
                    console.log(arrayCombat[i]);
                    if (arrayCombat[i]["vieHero"] == 0) {
                        document.getElementById("degat").innerHTML = "";
                        document.getElementById("degHero").style = "visibility : hidden";
                        document.getElementById("gameOver").style = "background-image: url('gameOver.gif');background-position: center;background-repeat: no-repeat;";
                        
                        document.getElementById("imgOrc").style = "visibility : hidden;"
                        document.getElementById("imgHero").style = "visibility : hidden;"
                    }
                }
                await pause(500);
            }
        }

    </script>
</body>

</html>