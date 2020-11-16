<?php

declare(strict_types=1);

namespace App;

final class Player
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string[]
     */
    private array $tokens = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}