<?php

namespace App\Services\AdapterPlaystation;

class XboxJoystick
{
    public function pressX()
    {
        return 'Xbox: X button pressed (like Square)';
    }

    public function pressB()
    {
        return 'Xbox: B button pressed (like circle)';
    }
}
