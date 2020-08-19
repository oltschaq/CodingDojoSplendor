<?php


namespace App;


class TestableTokenPile extends TokenPile
{
    public function setTokenAmount(string $color, int $amount): void
    {
        $this->tokens[$color] = $amount;
    }
}