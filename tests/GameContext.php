<?php


namespace Tests;


use App\Sack;
use App\TokenPile;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class GameContext implements Context
{
    /**
     * @var TokenPile
     */
    private $tokenPile;

    /**
     * @Given the game has been set up for :arg1, :arg2, :arg3 and :arg4 merchants
     */
    public function theGameHasBeenSetUpForAndMerchants($arg1, $arg2, $arg3, $arg4)
    {
        $this->tokenPile = new TokenPile();
    }

    /**
     * @Given current turn is for the :arg1 merchant
     */
    public function currentTurnIsForTheMerchant($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I take onyx, ruby, sapphire gem tokens
     */
    public function iTakeOnyxRubySapphireGemTokens()
    {
        //throw new PendingException();
    }

    /**
     * @When I end turn
     */
    public function iEndTurn()
    {
        //throw new PendingException();
    }

    /**
     * @When I take diamond, emerald, ruby gem tokens
     */
    public function iTakeDiamondEmeraldRubyGemTokens()
    {
        //throw new PendingException();
    }

    /**
     * @Then I should have in my gem sack :gems gem tokens
     */
    public function iShouldHaveInMyGemSackGemTokens(string $gems)
    {
        $gemColors = explode(',', $gems);
        $sack = new Sack();

        foreach ($gemColors as $gemColor) {
            Assert::eq(1, $sack->amountOfTokens($gemColor));
        }

    }

    /**
     * @Then I should have in my gem sack diamond, emerald, ruby gem tokens
     */
    public function iShouldHaveInMyGemSackDiamondEmeraldRubyGemTokens()
    {

    }


    /**
     * @Then in token piles should be :numberOfOnyxTokens onyx, :numberOfRubyTokens ruby, :numberOfSapphireTokens sapphire, :numberOfDiamondTokens diamond, :numberOfEmeraldTokens emerald gem tokens and :numberOfGoldTokens gold tokens
     */
    public function inTokenPilesShouldBeOnyxRubySapphireDiamondEmeraldGemTokensAndGoldTokens(
        int $numberOfOnyxTokens,
        int $numberOfRubyTokens,
        int $numberOfSapphireTokens,
        int $numberOfDiamondTokens,
        int $numberOfEmeraldTokens,
        int $numberOfGoldTokens
    )
    {
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::ONYX),$numberOfOnyxTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::EMERALD), $numberOfRubyTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::DIAMOND), $numberOfSapphireTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::SAPPHIRE), $numberOfDiamondTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::RUBY), $numberOfEmeraldTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::GOLD), $numberOfGoldTokens);
    }

}