<?php

namespace App\Services;


use App\Models\SeatLayout;

class SeatLayoutService
{
    protected $seatLayout;

    public function __construct(SeatLayout $seatLayout)
    {
        $this->seatLayout = $seatLayout;
    }

    public function getSeatByBusId($busId = null)
    {
        return $this->seatLayout->where('bus_id', $busId)->first();
    }

    public function convertLayout($seatLayout)
    {
        $result = [];
        $result['last_row_seat'] = $seatLayout['last_row_seat'];
        $result['seat_type'] = $this->getSeatType($seatLayout['seat_type_id']);
        $layoutList = config('bus.layout_type');
        $totalSeat = $seatLayout['total_seat'] - $seatLayout['last_row_seat'];
        $layout = explode(' x ', $layoutList[$seatLayout['layout_id']]);
        $result['residual_seat'] = $totalSeat % ($layout[0] + $layout[1]);
        $result['left_seat'] = $layout[0];
        $result['right_seat'] = $layout[1];
        $result['left_total_seat'] = ($totalSeat - $result['residual_seat']) / ($layout[0] + $layout[1]) * $layout[0];
        $result['right_total_seat'] = ($totalSeat - $result['residual_seat']) / ($layout[0] + $layout[1]) * $layout[1];
        $result['sleeper_seat'] = $seatLayout['sleeper_seat'];
        return $result;
    }

    public function updateSeat($dataSeat)
    {
        $seat = $this->seatLayout->where('bus_id', $dataSeat['bus_id']);
        $seat->update($dataSeat);
        return true;
    }

    private function getSeatType($seatTypeId)
    {
        $result = '';
        switch ($seatTypeId) {
            case 0 :
                $result = 'seater';
                break;
            case 1 :
                $result = 'sleeper';
                break;
            case 2 :
                $result = 'seater';
                break;
        }
        return $result;
    }
}
