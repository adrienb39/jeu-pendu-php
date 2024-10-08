<?php

namespace App;

class MotADeviner
{
    private array $mots = [];
    private string $mot;
    private array $motCache = [];

    public function __construct() {
        $this->mots = ["développement", "informatique", "logiciel", "ordinateur"];
        $this->mot = strtoupper($this->mots[array_rand($this->mots)]);
        $this->motCache = array_fill(0, mb_strlen($this->mot), '_');
    }

    public function getMot(): string {
        return $this->mot;
    }

    public function getMotCache(): array {
        return $this->motCache;
    }

    public function updateMotCache(string $lettre): void {
        for ($i = 0; $i < mb_strlen($this->mot); $i++) {
            if (mb_substr($this->mot, $i, 1) === $lettre) {
                $this->motCache[$i] = $lettre;
            }
        }
    }

    public function isComplete(): bool {
        return !in_array('_', $this->motCache);
    }
}