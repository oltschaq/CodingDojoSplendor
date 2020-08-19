<?php


namespace Tests;


use http\Encoding\Stream;

class TokenPile
{
    const ONYX = 'onyx';
    const EMERALD = 'emerald';
    const DIAMOND = 'diamond';
    const SAPPHIRE = 'sapphire';
    const RUBY = 'ruby';
    const GOLD = 'gold';

    /**
     * @var array
     */
    private $tokens;

    public function __construct()
    {
        $this->tokens = [
            self::ONYX => 7,
            self::EMERALD => 7,
            self::DIAMOND => 7,
            self::SAPPHIRE => 7,
            self::RUBY => 7,
            self::GOLD => 5,
        ];
    }

    public function amountOfTokens(string $color): int
    {
        return $this->tokens[$color] ?? 0;
    }
}