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
     * @var Sack[]
     */
    private $merchantSacks = [];

    /**
     * @var string|null
     */
    private $currentMerchantTurn;

    /**
     * @Given the game has been set up for :merchants merchants
     */
    public function theGameHasBeenSetUpForMerchants(string $merchants): void
    {
        $merchants = explode(',', $merchants);

        foreach ($merchants as $merchant) {
            $this->merchantSacks[$merchant] = new Sack();
        }
        $this->tokenPile = new TokenPile();
    }

    /**
     * @Given the game has been set up for :firstMerchant, :secondMerchant, :thirdMerchant and :fourthMerchant merchants
     */
    public function theGameHasBeenSetUpForAndMerchants($arg1, $arg2, $arg3, $arg4): void
    {
    }

    /**
     * @Given current turn is for the :merchant merchant
     */
    public function currentTurnIsForTheMerchant(string $merchant): void
    {
        $this->currentMerchantTurn = $merchant;
    }

    /**
     * @When I take :gems gem tokens
     */
    public function iTakeOnyxRubySapphireGemTokens(string $gems): void
    {
        $gemColors = explode(', ', $gems);
        foreach ($gemColors as $gemColor) {
            $this->tokenPile->take($gemColor, 1);
            $this->merchantSacks[$this->currentMerchantTurn]->give($gemColor, 1);
        }
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
        $gemColors = explode(', ', $gems);
        $colourCount = array_count_values($gemColors);

        foreach ($gemColors as $gemColor) {
            Assert::eq($colourCount[$gemColor], $this->merchantSacks[$this->currentMerchantTurn]->amountOfTokens($gemColor));
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
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::EMERALD), $numberOfEmeraldTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::DIAMOND), $numberOfDiamondTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::SAPPHIRE), $numberOfSapphireTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::RUBY), $numberOfRubyTokens);
        Assert::eq($this->tokenPile->amountOfTokens(TokenPile::GOLD), $numberOfGoldTokens);
    }
}