<?php

namespace App\Services\AdapterPlaystation;

class XboxToPlayStationAdapter implements PlayStationInterface
{
    public function __construct(protected XboxJoystick $xbox)
    {

    }

    public function pressSquare()
    {
        return $this->xbox->pressX();
    }

    public function pressCircle() {
        return $this->xbox->pressB();
    }
}
