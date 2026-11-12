<?php

namespace App\Services\AdapterPlaystation;

class PlaystationJoystick
{
    public function pressSquare()
    {
        return "PlayStation: Square button pressed";
    }

    public function pressCircle() {
        return "PlayStation: Circle button pressed";
    }
}
