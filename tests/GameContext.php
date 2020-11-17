<?php

declare(strict_types=1);

namespace Tests;

use App\Game;
use App\Player;
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
            $players[] = new Player($playerName);
        }

        return $players;
    }

    /**
     * @When I set up a game for players :player1, :player2, :player3 and :player4
     */
    public function iSetUpTheGameForFollowingPlayers(string $player1, string $player2, string $player3, string $player4): void
    {
        $this->game = new Game(new Player($player1), new Player($player2), new Player($player3), new Player($player4));
    }

    /**
     * @Then the game is set up for players :player1, :player2, :player3 and :player4
     */
    public function theGameIsSetUpForFollowingPlayers(string $player1, string $player2, string $player3, string $player4): void
    {
        $expectedPlayers = [new Player($player1), new Player($player2), new Player($player3), new Player($player4)];
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
     * @Then the token pile has such amounts of tokens :onyx, :ruby, :sapphire, :diamond, :emerald, :gold
     */
    public function theTokenPileHasSuchAmountsOfTokens(int $onyx, int $ruby, int $sapphire, int $diamond, int $emerald, int $gold): void
    {
        Assert::eq($this->game->tokens()['onyx'], $onyx);
        Assert::eq($this->game->tokens()['ruby'], $ruby);
        Assert::eq($this->game->tokens()['sapphire'], $sapphire);
        Assert::eq($this->game->tokens()['diamond'], $diamond);
        Assert::eq($this->game->tokens()['emerald'], $emerald);
        Assert::eq($this->game->tokens()['gold'], $gold);
    }

    /**
     * @When player :name takes two gem tokens of :color color
     */
    public function playerTakesTwoGemTokensOfColor(string $name, string $color): void
    {
        $this->game->player($name)->takeTwoTokens($color, $this->game);
    }

    /**
     * @When player :name tries to take two gem tokens of :color color
     */
    public function playerTriesToTakeTwoGemTokensOfColor(string $name, string $color): void
    {
        try {
            $this->game->player($name)->takeTwoTokens($color, $this->game);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    /**
     * @Given player :name has :amount tokens of :color color
     */
    public function playerHasTokensOfColor($name, $amount, $color): void
    {
        $playersTokens = $this->game->player($name)->tokens();

        Assert::keyExists($playersTokens, $color);
        Assert::eq($playersTokens[$color], $amount);
    }

    /**
     * @Then the tokens can not be taken because there are less than four of them left
     */
    public function theTokensCanNotBeTakenBecauseThereAreLessThanFourOfThemLeft(): void
    {
        Assert::eq($this->message, "There has to be at least 4 tokens of this color left to take 2 of them");
    }
}