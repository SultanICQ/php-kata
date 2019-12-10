<?php

class Questions
{
    var $popQuestions;
    var $scienceQuestions;
    var $sportsQuestions;
    var $rockQuestions;

    public function getAndRemovePopQuestions()
    {
        return array_shift($this->popQuestions);
    }

    public function getAndRemoveScienceQuestions()
    {
        return array_shift($this->scienceQuestions);
    }

    public function getAndRemoveSportsQuestions()
    {
        return array_shift($this->sportsQuestions);
    }

    public function getAndRemoveRockQuestions()
    {
        return array_shift($this->rockQuestions);
    }

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