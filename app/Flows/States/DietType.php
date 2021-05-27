<?php

namespace App\Flows\States;

class DietType extends State
{
    public $name = 'diet/type';
    public $type = 'inout';
    public $checkpoint = 'REG';
    public $allowedCheckpoints = ['REG'];

}
