<?php

namespace App\Http\Controllers\Adapter;

use App\Http\Controllers\Controller;
use App\Services\AdapterPlaystation\PlaystationJoystick;
use App\Services\AdapterPlaystation\XboxJoystick;
use App\Services\AdapterPlaystation\XboxToPlayStationAdapter;
use Illuminate\Http\Request;


class PlaystationController extends Controller
{
    public function gamePlay(Request $request)
    {
        // $attack = $request->attack;

        // $playstationJoystick = new PlayStationJoystick();
        // return $playstationJoystick->pressCircle();

        // Step - 2
        $xboxJoystick = new XboxJoystick();
        $adapter = new XboxToPlayStationAdapter($xboxJoystick);

        // $adapter->pressSquare();
        return $adapter->pressCircle();


    }
}
