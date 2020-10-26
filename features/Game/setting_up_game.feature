Feature: Setting up a game
    In order to be able to play this marvelous game with friends
    As a Host
    I want to setup a game for players

    Scenario: Setting up a game
        When I set up a game for players "jesse@pinkman.com", "walter@white.com", "mike@ehrmantraut.com" and "skyler@white.com"
        Then the game is set up for players "jesse@pinkman.com", "walter@white.com", "mike@ehrmantraut.com" and "skyler@white.com"

    Scenario Outline: Setting up a game for a proper number of players
        When I set up a game for <number> players
        Then the game is set up for <number> players

        Examples:
            | number |
            | 2      |
            | 3      |
            | 4      |

    Scenario Outline: Trying to set up a game for number of players out of rules
        When I try to set up a game for <number> players
        Then the game can not be set up because there are <reason> players

        Examples:
            | number | reason       |
            | 1      | "not enough" |
            | 5      | "too many"   |