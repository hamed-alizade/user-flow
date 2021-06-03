<?php

namespace App\Flows\States;

class SickSelectProcess extends State
{
    public $name = 'sickSelectProcess';
    public $type = 'process';


    public function sickSelectProcess()
    {
        if (self::$arguments['sick_id'] != 1)
        {
            self::$arguments['test'] = 'test';
            $this->checkpoint = $this->getUserPreviousCheckpoint();
        }
    }
}
