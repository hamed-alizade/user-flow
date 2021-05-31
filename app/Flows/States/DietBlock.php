<?php

namespace App\Flows\States;

class DietBlock extends State
{
    public $name = 'diet/block';
    public $type = 'inout';
    public $checkpoint = 'DBLOCKED';
    public $allowedCheckpoints = ['REG', 'NORMAL'];

}
