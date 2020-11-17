<?php

declare(strict_types=1);

namespace App;

final class Game
{
    /**
     * @var string[]
     */
    private array $players = [];

    /**
     * @var string[]
     */
    private array $tokens = [
        'onyx' => 7,
        'ruby' => 7,
        'sapphire' => 7,
        'diamond' => 7,
        'emerald' => 7,
        'gold' => 5
    ];

    public function __construct(Player ...$players)
    {
        $this->players = $players;
        $numberOfPlayers = count($players);

        if ($numberOfPlayers < 2) {
            throw new \Exception("Not enough players");
        } elseif ($numberOfPlayers > 4) {
            throw new \Exception("Too many players");
        }

        if ($numberOfPlayers === 3) {
            $this->tokens = [
                'onyx' => 5,
                'ruby' => 5,
                'sapphire' => 5,
                'diamond' => 5,
                'emerald' => 5,
                'gold' => 5
            ];
        } elseif ($numberOfPlayers === 2) {
            $this->tokens = [
                'onyx' => 4,
                'ruby' => 4,
                'sapphire' => 4,
                'diamond' => 4,
                'emerald' => 4,
                'gold' => 5
            ];
        }
    }

    /**
     * @return string[]
     */
    public function players(): array
    {
        return $this->players;
    }

    /**
     * @return string[]
     */
    public function tokens(): array
    {
        return $this->tokens;
    }

    public function player(string $name): Player
    {
        foreach ($this->players as $player) {
            if ($name == $player->name()) {
                return $player;
            }
        }
    }

    public function subtractTwoTokens(string $color): void
    {
        if ($this->tokens[$color] < 4) {
            throw new \Exception("There has to be at least 4 tokens of this color left to take 2 of them");
        } else {
            $this->tokens[$color] -= 2;
        }
    }
}