<?php
namespace test;

class Restaurant
{
    public $name, $days, $times;

    //search for time in range
    function timeIn($test_time){
        foreach($this->times as $value) {
            $splitted_times = explode('-', $value);
            $from = strtotime($splitted_times[0]);
            $to = strtotime($splitted_times[1]);
            $test_time = strtotime($test_time);
            if ($test_time <= $to && $test_time >= $from) {//compare dates
                return $this->name;
            }
        }
    return false;
    }

    //search for day in range
    function dayIn($day){
        //give each day a number to compare
        $daysOfWeek = [
            0 => 'Mon',
            1 => 'Tue',
            2 => 'Wed',
            3 => 'Thu',
            4 => 'Fri',
            5 => 'Sat',
            6 => 'Sun',
        ];
        //get arrange of the search object day
        $key = array_search (trim($day), $daysOfWeek);

        //format days
        foreach ($this->days as $value) {
            //explode days according to the stored data format
            $exploded_days = explode(',', $value);

            foreach ($exploded_days as $item) {
                if (trim($item) == trim($day)) {
                    return true;
                }
                //get range
                $splitted2 = explode('-', $item);

                if (count($splitted2) > 1) {
                    $from = array_search(trim($splitted2[0]), $daysOfWeek);
                    $to = array_search(trim($splitted2[1]), $daysOfWeek);
                    if ($key >= $from && $key <= $to) {//test if search object day is in the restaurant info range
                        return true;
                    }
                }
            }
        }
    return false;

    }


}