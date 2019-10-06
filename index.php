<?php
namespace test;
include 'Restaurant.php';

function findOpenRestaurants($csvFilename, $searchDatetime)
{
    //read csv file
    $row = 1;
    $data = [];
    if (($handle = fopen($csvFilename, "r")) !== FALSE) {
        while (($values = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[$values[0]] = $values[1];
        }
        fclose($handle);

        //store name, days and times for every restaurant
        $restaurants = [];
        foreach ($data as $name => $openTimes) {
            $splittedTimes = explode("/", $openTimes);
            $restaurant = new Restaurant();
            $restaurant->name = $name;
            foreach ($splittedTimes as $splitted) {
                $days_times = preg_split('/(?=\d)/', $splitted, 2);//explode on numbers
                $restaurant->days[] = $days_times[0];
                $restaurant->times[] = $days_times[1];

            }
            $restaurants[] = $restaurant;

        }
        //search for date and time
        foreach ($restaurants as $rest) {
            if ($rest->dayIn($searchDatetime->days) && $rest->timeIn($searchDatetime->times)) {
                echo $rest->name . "<br>";
            }
        }
    }
    }//end function
    //test object
    $searchDatetime = new Restaurant();
    $searchDatetime->days = "Tue";
    $searchDatetime->times = "10 am";
    findOpenRestaurants("restaurants.csv", $searchDatetime);
