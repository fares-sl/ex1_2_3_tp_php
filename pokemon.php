<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Pokémon</title>
    <link rel="stylesheet" href="pok.css">
</head>
<body>

<h1>⚔️ Combat Pokémon ! ⚔️</h1>

<?php
class AttackPokemon {
    public $attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack;

    public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }

    public function getAttackPower() {
        $attack = rand($this->attackMinimal, $this->attackMaximal);
        return (rand(1, 100) <= $this->probabilitySpecialAttack) ? $attack * $this->specialAttack : $attack;
    }
}

class Pokemon {
    protected $name, $url, $hp, $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getUrl() {
        return $this->url;
    }
    
    public function setUrl($url) {
        $this->url = $url;
    }
    
    public function getHp() {
        return $this->hp;
    }
    
    public function setHp($hp) {
        $this->hp = $hp;
    }
    
    public function getAttackPokemon() {
        return $this->attackPokemon;
    }
    
    public function setAttackPokemon(AttackPokemon $attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }
    

    public function isDead() { return $this->hp <= 0; }

    public function attack(Pokemon $opponent) {
        $damage = $this->attackPokemon->getAttackPower();
        echo "<div class='log'><b>{$this->name}</b> attaque <b>{$opponent->name}</b> et inflige <b>{$damage} dégâts</b> !</div>";
        $opponent->hp -= $damage;
    }

    public function display() {
        echo "<div class='pokemon'><img src='{$this->url}'><br>";
        echo "<b>{$this->name}</b><br>HP: <b>{$this->hp}</b></div>";
    }
}

class PokemonFeu extends Pokemon {
    public function attack(Pokemon $opponent) {
        $damage = $this->attackPokemon->getAttackPower();
        if ($opponent instanceof PokemonPlante) $damage *= 2;
        elseif ($opponent instanceof PokemonEau) $damage *= 0.5;
        echo "<div class='log'><b>{$this->name} (Feu)</b> attaque <b>{$opponent->name}</b> et inflige <b>{$damage} dégâts</b> !</div>";
        $opponent->hp -= $damage;
    }
}

class PokemonEau extends Pokemon {
    public function attack(Pokemon $opponent) {
        $damage = $this->attackPokemon->getAttackPower();
        if ($opponent instanceof PokemonFeu) $damage *= 2;
        elseif ($opponent instanceof PokemonPlante) $damage *= 0.5;
        echo "<div class='log'><b>{$this->name} (Eau)</b> attaque <b>{$opponent->name}</b> et inflige <b>{$damage} dégâts</b> !</div>";
        $opponent->hp -= $damage;
    }
}

class PokemonPlante extends Pokemon {
    public function attack(Pokemon $opponent) {
        $damage = $this->attackPokemon->getAttackPower();
        if ($opponent instanceof PokemonEau) $damage *= 2;
        elseif ($opponent instanceof PokemonFeu) $damage *= 0.5;
        echo "<div class='log'><b>{$this->name} (Plante)</b> attaque <b>{$opponent->name}</b> et inflige <b>{$damage} dégâts</b> !</div>";
        $opponent->hp -= $damage;
    }
}

$attack1 = new AttackPokemon(5, 15, 2, 30);
$attack2 = new AttackPokemon(7, 0, 1.5, 40);

$salameche = new PokemonPlante("mariem", "🦒", 50, $attack1);
$carapuce = new PokemonEau("aziz", "🐯", 50, $attack2);

echo "<div class='container'>";
$salameche->display();
$carapuce->display();
echo "</div>";

echo "<h2>⚔️ Début du Combat !</h2>";

while (!$salameche->isDead() && !$carapuce->isDead()) {
    $salameche->attack($carapuce);
    if (!$carapuce->isDead()) {
        $carapuce->attack($salameche);
    }
}

if ($salameche->isDead()) {
    echo "<h2 class='winner'>🏆{$carapuce->getName()} a gagné le combat !</h2>";
} else {
    echo "<h2 class='winner'>🏆{$salameche->getName()} a gagné le combat !</h2>";
}
?>

</body>
</html>
