<?php

declare(strict_types=1);

namespace App;

final class Player
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string[]
     */
    private array $tokens = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function tokens(): array
    {
        return $this->tokens;
    }

    public function addTwoTokens(string $color): void
    {
        $this->tokens[$color] += 2;
    }

    public function addThreeTokens(string $color1, string $color2, string $color3): void
    {
        $this->tokens[$color1] += 1;
        $this->tokens[$color2] += 1;
        $this->tokens[$color3] += 1;
    }
}