<?php
function echoln($string)
{
    echo $string . "\n";
}

class Game
{
    var $players;
    var $places;
    var $purses;
    var $inPenaltyBox;

    var $questions;

    var $popQuestions;
    var $scienceQuestions;
    var $sportsQuestions;
    var $rockQuestions;

    var $currentPlayer = 0;
    var $isGettingOutOfPenaltyBox;

    function __construct(Questions $questions)
    {
        $this->questions = $questions;

        $this->players = array();
        $this->places = array(0);
        $this->purses = array(0);
        $this->inPenaltyBox = array(0);
    }

    function createRockQuestion($index)
    {
        return "Rock Question " . $index;
    }

    function isPlayable()
    {
        return ($this->howManyPlayers() >= 2);
    }

    function add($playerName)
    {
        array_push($this->players, $playerName);
        $this->places[$this->howManyPlayers()] = 0;
        $this->purses[$this->howManyPlayers()] = 0;
        $this->inPenaltyBox[$this->howManyPlayers()] = false;

        echoln($playerName . " was added");
        echoln("They are player number " . count($this->players));
        return true;
    }

    function howManyPlayers()
    {
        return count($this->players);
    }

    function roll($roll)
    {
        echoln($this->players[$this->currentPlayer] . " is the current player");
        echoln("They have rolled a " . $roll);

        if ( $this->playerCanAdvance($roll) ) {
            $this->advancePlayer($roll);
        }

    }

    function askQuestion()
    {
        $position =$this->places[$this->currentPlayer];
        if ($this->currentCategory($position) == "Pop")
            echoln($this->questions->getAndRemovePopQuestions());
        if ($this->currentCategory($position) == "Science")
            echoln($this->questions->getAndRemoveScienceQuestions());
        if ($this->currentCategory($position) == "Sports")
            echoln($this->questions->getAndRemoveSportsQuestions());
        if ($this->currentCategory($position) == "Rock")
            echoln($this->questions->getAndRemoveRockQuestions());
    }


    function currentCategory($position)
    {
        if ($position%4 == 0) return "Pop";

        if ($position%4 == 1) return "Science";

        if ($position%4 == 2) return "Sports";

        if ($position%4 == 3) return "Rock";

        throw new Exception();
    }

    function wasCorrectlyAnswered()
    {
        if ($this->inPenaltyBox[$this->currentPlayer]) {
            if ($this->isGettingOutOfPenaltyBox) {
                echoln("Answer was correct!!!!");
                $this->purses[$this->currentPlayer]++;
                echoln($this->players[$this->currentPlayer]
                    . " now has "
                    . $this->purses[$this->currentPlayer]
                    . " Gold Coins.");

                $winner = $this->didPlayerWin();
                $this->currentPlayer++;
                if ($this->currentPlayer == count($this->players)) $this->currentPlayer = 0;

                return $winner;
            } else {
                $this->currentPlayer++;
                if ($this->currentPlayer == count($this->players)) $this->currentPlayer = 0;
                return true;
            }


        } else {

            echoln("Answer was corrent!!!!");
            $this->purses[$this->currentPlayer]++;
            echoln($this->players[$this->currentPlayer]
                . " now has "
                . $this->purses[$this->currentPlayer]
                . " Gold Coins.");

            $winner = $this->didPlayerWin();
            $this->currentPlayer++;
            if ($this->currentPlayer == count($this->players)) $this->currentPlayer = 0;

            return $winner;
        }
    }

    function wrongAnswer()
    {
        echoln("Question was incorrectly answered");
        echoln($this->players[$this->currentPlayer] . " was sent to the penalty box");
        $this->inPenaltyBox[$this->currentPlayer] = true;

        $this->currentPlayer++;
        if ($this->currentPlayer == count($this->players)) $this->currentPlayer = 0;
        return true;
    }


    function didPlayerWin()
    {
        return !($this->purses[$this->currentPlayer] == 6);
    }

    /**
     * @param $roll
     */
    public function advancePlayer($roll): void
    {
        $this->places[$this->currentPlayer] = $this->places[$this->currentPlayer] + $roll;
        if ($this->places[$this->currentPlayer] > 11) $this->places[$this->currentPlayer] = $this->places[$this->currentPlayer] - 12;
        echoln($this->players[$this->currentPlayer]
            . "'s new location is "
            . $this->places[$this->currentPlayer]);
        echoln("The category is " . $this->currentCategory($this->places[$this->currentPlayer]));
        $this->askQuestion();
    }

    /**
     * @param $roll
     * @return bool
     */
    public function playerCanAdvance($roll): bool
    {
        if (!$this->inPenaltyBox[$this->currentPlayer]) {
            return true;
        }

        if ($this->canLeavePenaltyBox($roll)) {
            $this->isGettingOutOfPenaltyBox = true;
            echoln($this->players[$this->currentPlayer] . " is getting out of the penalty box");
            return true;
        }

        echoln($this->players[$this->currentPlayer] . " is not getting out of the penalty box");
        $this->isGettingOutOfPenaltyBox = false;
        return false;
    }

    /**
     * @param $roll
     * @return bool
     */
    public function canLeavePenaltyBox($roll): bool
    {
        return $roll % 2 != 0;
    }
}
