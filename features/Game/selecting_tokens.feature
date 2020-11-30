Feature: Taking tokens from token piles
    In order to be able to purchase development cards
    As a Merchant
    I want to gather tokens

    Background:
        Given I set up a game for players "jesse@pinkman.com" and "walter@white.com"

    Scenario: Taking two gem tokens of the same color
        When current turn is for "jesse@pinkman.com"
        And player takes two gem tokens of "onyx" color
        Then the token pile has such amounts of tokens "2", "4", "4", "4", "4", "5"
        And player "jesse@pinkman.com" has "2" tokens of "onyx" color

    Scenario: Trying to take two gem tokens of the same color when there is less than four of them left
        When current turn is for "jesse@pinkman.com"
        And player takes two gem tokens of "onyx" color
        And current turn is for "walter@white.com"
        And player tries to take two gem tokens of "onyx" color
        Then the tokens can not be taken because there are less than four of them left

    Scenario: Trying to take two tokens of gold color
        When current turn is for "jesse@pinkman.com"
        And player tries to take two gem tokens of "gold" color
        Then the tokens can not be taken because the color must be different than gold

    Scenario: Taking three gem tokens
        When current turn is for "jesse@pinkman.com"
        And player takes three gem tokens of colors "onyx", "ruby" and "sapphire"
        Then the token pile has such amounts of tokens "3", "3", "3", "4", "4", "5"
        And player "jesse@pinkman.com" has "1" tokens of "onyx" color
        And player "jesse@pinkman.com" has "1" tokens of "ruby" color
        And player "jesse@pinkman.com" has "1" tokens of "sapphire" color

    Scenario Outline: Trying to take three gem tokens when the colors are not different
        When current turn is for "jesse@pinkman.com"
        When player tries to take three gem tokens of colors "<color1>", "<color2>" and "<color3>"
        Then the tokens can not be taken because each color has to be different

        Examples:
            | color1  | color2  | color3  |
            | diamond | onyx    | onyx    |
            | onyx    | diamond | onyx    |
            | onyx    | onyx    | diamond |
            | onyx    | onyx    | onyx    |

    Scenario: Trying to take three tokens including gold color
        When current turn is for "jesse@pinkman.com"
        When player tries to take three gem tokens of colors "gold", "diamond" and "sapphire"
        Then the tokens can not be taken because the color must be different than gold

    Scenario: Trying to take gem tokens when there are no tokens left
        When current turn is for "jesse@pinkman.com"
        And player takes three gem tokens of colors "onyx", "ruby" and "sapphire"
        And current turn is for "walter@white.com"
        And player takes three gem tokens of colors "onyx", "ruby" and "sapphire"
        And current turn is for "jesse@pinkman.com"
        And player takes three gem tokens of colors "onyx", "ruby" and "sapphire"
        And current turn is for "walter@white.com"
        And player takes three gem tokens of colors "onyx", "ruby" and "sapphire"
        And current turn is for "jesse@pinkman.com"
        And player tries to take three gem tokens of colors "onyx", "diamond" and "emerald"
        Then the tokens can not be taken because there are no tokens of "onyx" color left
