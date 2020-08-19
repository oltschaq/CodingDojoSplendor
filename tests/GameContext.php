<?php


namespace Tests;


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
        throw new PendingException();
    }

    /**
     * @When I end turn
     */
    public function iEndTurn()
    {
        throw new PendingException();
    }

    /**
     * @Then I should have in my gem sack onyx, ruby, sapphire gem tokens
     */
    public function iShouldHaveInMyGemSackOnyxRubySapphireGemTokens()
    {
        throw new PendingException();
    }
    /**
     * @When I take diamond, emerald, ruby gem tokens
     */
    public function iTakeDiamondEmeraldRubyGemTokens()
    {
        throw new PendingException();
    }


    /**
     * @Then I should have in my gem sack diamond, emerald, ruby gem tokens
     */
    public function iShouldHaveInMyGemSackDiamondEmeraldRubyGemTokens()
    {

    }

    /**
     * @Then in token piles should be :arg1 onyx, :arg2 ruby, :arg3 sapphire, :arg4 diamond, :arg5 emerald gem tokens and :arg6 gold tokens
     */
    public function inTokenPilesShouldBeOnyxRubySapphireDiamondEmeraldGemTokensAndGoldTokens(
        int $numberOfOnyxTokens,
        $arg2,
        $arg3,
        $arg4,
        $arg5,
        $arg6
    )
    {
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::ONYX),$numberOfOnyxTokens);
    }

}