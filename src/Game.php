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

    /**
     * @var Player
     */
    private Player $playerMakingMove;


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

        $this->playerMakingMove = $this->players()[0];
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

    public function takeTwoTokens(string $color): void
    {
        $player = $this->turnCurrent();

        if ($this->tokens[$color] < 4) {
            throw new \Exception("There has to be at least 4 tokens of this color left to take 2 of them");
        } elseif ($this->tokens[$color] == 0) {
            throw new \Exception("There are no tokens of this color left");
        } else {
            $this->tokens[$color] -= 2;
            $player->addTwoTokens($color);
        }

        $this->turnEnd();
    }

    public function takeThreeTokens(string $color1, string $color2, string $color3): void
    {
        $player = $this->turnCurrent();

        if ($color1 == $color2 || $color1 == $color3 || $color2 == $color3) {
            throw new \Exception("Each color has to be different to take 3 gems");
        } else {
            $colors = [$color1, $color2, $color3];
        }

        foreach ($colors as $color) {
            if ($this->tokens[$color] == 0) {
                throw new \Exception(sprintf("There are no tokens of %s color left", $color));
            } else {
                $this->tokens[$color] -= 1;
            }
        }

        $player->addThreeTokens($color1, $color2, $color3);

        $this->turnEnd();
    }

    public function turnCurrent(): Player
    {
        return $this->playerMakingMove;
    }

    public function turnEnd(): void
    {
        $key = array_search($this->playerMakingMove, $this->players);

        $key += 1;

        if (array_key_exists($key, $this->players)) {
            $this->playerMakingMove = $this->players[$key];
        } else {
            $this->playerMakingMove = $this->players[0];
        }
    }
}