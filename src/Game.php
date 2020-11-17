<?php

declare(strict_types=1);

namespace App;

final class Game
{
    public const ONYX = 'onyx';
    public const RUBY = 'ruby';
    public const SAPPHIRE = 'sapphire';
    public const DIAMOND = 'diamond';
    public const EMERALD = 'emerald';
    public const GOLD = 'gold';

    /**
     * @var string[]
     */
    private array $players = [];

    /**
     * @var string[]
     */
    private array $tokens = [
        self::ONYX => 7,
        self::RUBY => 7,
        self::SAPPHIRE => 7,
        self::DIAMOND => 7,
        self::EMERALD => 7,
        self::GOLD => 5
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
                self::ONYX => 5,
                self::RUBY => 5,
                self::SAPPHIRE => 5,
                self::DIAMOND => 5,
                self::EMERALD => 5,
                self::GOLD => 5
            ];
        } elseif ($numberOfPlayers === 2) {
            $this->tokens = [
                self::ONYX => 4,
                self::RUBY => 4,
                self::SAPPHIRE => 4,
                self::DIAMOND => 4,
                self::EMERALD => 4,
                self::GOLD => 5
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