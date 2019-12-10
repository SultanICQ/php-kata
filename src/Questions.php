<?php

class Questions
{
    var $popQuestions;

    /**
     * @return array
     */
    public function getPopQuestions(): array
    {
        return $this->popQuestions;
    }

    /**
     * @return array
     */
    public function getScienceQuestions(): array
    {
        return $this->scienceQuestions;
    }

    /**
     * @return array
     */
    public function getSportsQuestions(): array
    {
        return $this->sportsQuestions;
    }

    /**
     * @return array
     */
    public function getRockQuestions(): array
    {
        return $this->rockQuestions;
    }
    var $scienceQuestions;
    var $sportsQuestions;
    var $rockQuestions;

    public function __construct()
    {
        $this->popQuestions = array();
        $this->scienceQuestions = array();
        $this->sportsQuestions = array();
        $this->rockQuestions = array();

        for ($i = 0; $i < 50; $i++) {
            array_push($this->popQuestions, "Pop Question " . $i);
            array_push($this->scienceQuestions, ("Science Question " . $i));
            array_push($this->sportsQuestions, ("Sports Question " . $i));
            array_push($this->rockQuestions, $this->createRockQuestion($i));
        }
    }

    function createRockQuestion($index)
    {
        return "Rock Question " . $index;
    }



}