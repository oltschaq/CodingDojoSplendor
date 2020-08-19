<?php


namespace App;


class Sack
{
    private $gems = [];

    public function amountOfTokens(string $color): int
    {
        return $this->gems[$color] ?? 0;
    }
}