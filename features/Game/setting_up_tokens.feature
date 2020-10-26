Feature: Setting up tokens
    After the game is set up - the tokens are set up
    As a Game
    I want the tokens to setup automatically

    Scenario Outline: Setting up tokens in a game
        When the game is set up with <number> players
        Then the tokens are set up in such amounts <onyx>, <ruby>, <sapphire>, <diamond>, <emerald>, <gold>

        Examples:
            | number | onyx | ruby | sapphire | diamond | emerald | gold |
            | 4      | 7    | 7    | 7        | 7       | 7       | 5    |
            | 3      | 5    | 5    | 5        | 5       | 5       | 5    |
            | 2      | 4    | 4    | 4        | 4       | 4       | 5    |
