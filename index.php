<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concepts de base - Exercice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
class Etudiant {
    public $nom;
    public $notes;

    public function __construct($nom, $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotes() {
        foreach ($this->notes as $note) {
            $colorClass = $note < 10 ? "red" : ($note > 10 ? "green" : "orange");
            echo "<span class='note $colorClass'>$note</span>"; 
        }
    }

    public function calculerMoyenne() {
        return array_sum($this->notes) / count($this->notes);
    }

    public function estAdmis() {
        return $this->calculerMoyenne() >= 10 ? "Admis" : "Non Admis";
    }
}

$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];

foreach ($etudiants as $etudiant) {
    echo "<div class='student'>"; 
    echo "<h2>{$etudiant->nom}</h2>";
    echo "<div class='notes-container'>"; 
    $etudiant->afficherNotes();
    echo "</div>";
    $moyenne = $etudiant->calculerMoyenne();
    echo "<div class='blue'>Votre moyenne est " . number_format($moyenne, 2) . "</div>";
    echo "</div>";
}
?>

</body>
</html>