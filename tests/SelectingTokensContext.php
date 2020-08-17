<?php

declare(strict_types=1);

namespace Tests;

use App\Game;
use App\Merchant;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

final class SelectingTokensContext implements Context
{
    /**
     * @Transform :merchant1
     * @Transform :merchant2
     * @Transform :merchant3
     * @Transform :merchant4
     */
    public function castStringToMerchant(string $email): Merchant
    {
        return new Merchant($email);
    }

    /**
     * @Given the game has been set up for :merchant1, :merchant2, :merchant3 and :merchant4 merchants
     */
    public function theGameHasBeenSetUpForAndMerchants(Merchant $merchant1, Merchant $merchant2, Merchant $merchant3, Merchant $merchant4): void
    {
        new Game($merchant1, $merchant2, $merchant3, $merchant4);
    }

    /**
     * @Given token piles have been set up for them
     */
    public function tokenPilesHaveBeenSetUpForThem(): void
    {
        
    }
}