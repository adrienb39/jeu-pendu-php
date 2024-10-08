<?php

namespace App;

class JeuPendu
{
    private MotADeviner $motADeviner;
    private int $tentativesRestantes;
    private array $lettresProposees;

    public function __construct() {
        $this->motADeviner = new MotADeviner();
        $this->tentativesRestantes = 7;
        $this->lettresProposees = [];
    }

    public function jouer(): void {
        while ($this->tentativesRestantes > 0) {
            $this->afficherMotCache();
            $lettre = $this->demanderLettre();
            $this->traiterLettre($lettre);
            if ($this->motADeviner->isComplete()) {
                echo "Bravo, vous avez deviné le mot : " . $this->motADeviner->getMot() . "\n";
                return;
            }
        }
        echo "Désolé, vous n'avez pas trouvé le mot qui était : " . $this->motADeviner->getMot() . "\n";
    }

    public function afficherMotCache(): void {
        echo implode(" ", $this->motADeviner->getMotCache()) . "\n";
        echo "Tentatives restantes : " . $this->tentativesRestantes . "\n";
        echo "Lettres déjà proposées : " . implode(", ", $this->lettresProposees) . "\n";
    }

    public function demanderLettre(): string {
        while (true) {
            $lettre = readline("Entrez une lettre : ");
            if (strlen($lettre) === 1 && preg_match("/^[a-zA-ZàâäéêëîïôûùçÀÂÄÉÊËÎÏÔÛÙÇ]$/", $lettre) && !in_array($lettre, $this->lettresProposees)) {
                $this->lettresProposees[] = $lettre;
                return strtoupper($lettre);
            }
        }
    }

    public function traiterLettre(string $lettre): void {
        if (str_contains($this->motADeviner->getMot(), $lettre)) {
            $this->motADeviner->updateMotCache($lettre);
        } else {
            $this->tentativesRestantes--;
        }
    }
}