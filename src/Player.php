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

    public function takeTwoTokens(string $color, Game $game): void
    {
        $game->subtractTwoTokens($color);

        $this->tokens[$color] += 2;
    }

    public function takeThreeTokens($color1, $color2, $color3, Game $game): void
    {
        $game->subtractThreeTokens($color1, $color2, $color3);

        $this->tokens[$color1] += 1;
        $this->tokens[$color2] += 1;
        $this->tokens[$color3] += 1;
    }
}