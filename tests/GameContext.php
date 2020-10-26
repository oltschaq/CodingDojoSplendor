<?php

declare(strict_types=1);

namespace Tests;

use App\Game;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Webmozart\Assert\Assert;

class GameContext implements Context
{
    private Game $game;

    private ?string $message = null;

    private function randomName(): string
    {
        $n=10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    private function generatePlayers(int $number): array
    {
        $players = [];

        for ($x = 1; $x <= $number; $x++) {
            $playerName = $this->randomName();
            $players[] = $playerName;
        }

        return $players;
    }

    /**
     * @When I set up a game for players :player1, :player2, :player3 and :player4
     */
    public function iSetUpTheGameForFollowingPlayers(string $player1, string $player2, string $player3, string $player4): void
    {
        $this->game = new Game($player1, $player2, $player3, $player4);
    }

    /**
     * @Then the game is set up for players :player1, :player2, :player3 and :player4
     */
    public function theGameIsSetUpForFollowingPlayers(string $player1, string $player2, string $player3, string $player4): void
    {
        $expectedPlayers = [$player1, $player2, $player3, $player4];
        Assert::eq($this->game->players(), $expectedPlayers);
    }

    /**
     * @When I set up a game for :number players
     */
    public function iSetUpAGameForPlayers(int $number): void
    {
        $players = $this->generatePlayers($number);
        $this->game = new Game(...$players);
    }

    /**
     * @Then the game is set up for :number players
     */
    public function theGameIsSetUpForPlayers(int $number): void
    {
        Assert::eq(count($this->game->players()), $number);
    }

    /**
     * @When I try to set up a game for :number players
     */
    public function iTryToSetUpAGameForPlayers(int $number): void
    {
        $players = $this->generatePlayers($number);

        try {
            $this->game = new Game(...$players);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    /**
     * @Then the game can not be set up because there are :reason players
     */
    public function theGameCanNotBeSetUpBecauseOfReason($reason): void
    {
        if ($reason === "not enough") {
            Assert::eq($this->message, "Not enough players");
        } elseif ($reason === "too many") {
            Assert::eq($this->message, "Too many players");
        }
    }

    /**
     * @When the game is set up with :number players
     */
    public function theGameIsSetUpWithPlayers(int $number): void
    {
        $players = $this->generatePlayers($number);
        $this->game = new Game(...$players);
    }

    /**
     * @Then the tokens are set up in such amounts :onyx, :ruby, :sapphire, :diamond, :emerald, :gold
     */
    public function theTokensAreSetUpInSuchAmounts($onyx, $ruby, $sapphire, $diamond, $emerald, $gold)
    {
        Assert::eq($this->game->tokens()['onyx'], $onyx);
        Assert::eq($this->game->tokens()['ruby'], $ruby);
        Assert::eq($this->game->tokens()['sapphire'], $sapphire);
        Assert::eq($this->game->tokens()['diamond'], $diamond);
        Assert::eq($this->game->tokens()['emerald'], $emerald);
        Assert::eq($this->game->tokens()['gold'], $gold);
    }

    /**
     * @Given current turn is for the :player merchant
     */
    public function currentTurnIsForTheMerchant($player)
    {
        $players = $this->game->players();
        var_dump($players);
    }
}