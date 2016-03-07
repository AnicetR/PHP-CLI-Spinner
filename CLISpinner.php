<?php

/**
 * Created by PhpStorm.
 * User: Anicet
 * Date: 07/03/2016
 * Time: 17:38
 */

class CLISpinner
{

    private $spinners = "spinners.json";
    private $spinner, $message;

    /**
     * CLISpinner constructor.
     * @param $spinner string Spinner you wants to be shown
     * @param $message string optionnal Message you wants to be shown right to the spinner
     */
    public function __construct($spinner, $message = "")
    {
        $this->message = $message;
        if($this->getSpinners())
            if($this->setSpinner($spinner))
                $this->showSpinner();
    }

    /**
     * Get the spinners list
     * @return bool
     */
    private function getSpinners()
    {
        if($this->spinners = file_get_contents($this->spinners)){
            $this->spinners = json_decode($this->spinners);
            return true;
        }
        return false;
    }

    /**
     * Set the spinner
     * @param $spinner
     * @return bool
     */
    private function setSpinner($spinner){
        if($this->spinner = $this->spinners->$spinner){
            unset($this->spinners);
            return true;
        }
        return false;
    }

    /**
     * Show the spinner
     */
    private function showSpinner()
    {
        while(1){
            foreach($this->spinner->frames as $frame){
                echo chr(27) . "[0G";
                echo $frame." ".$this->message."\r";
                usleep($this->spinner->interval*1000);
            }
        };
    }
}