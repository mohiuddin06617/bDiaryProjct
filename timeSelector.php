<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/26/2016
 * Time: 4:58 PM
 */

$t=new timeSel();
echo $t->timeSelecting();

class timeSel
    {
        function timeSelecting()
        {
            date_default_timezone_set("Asia/Dhaka");
           $hours=date("G");
           $minute=date('i');
            $tf=new timeSel();
           $mealTime= $tf->mealTimeSelecting($hours,$minute);
            return $mealTime;
        }
     function mealTimeSelecting($h,$m){
            $hours=$h;
            $minute=$m;
         $time="";
         if($hours>=8 && $hours<=14){
             $time="Lunch";
             return "Lunch";
         }
         else if(($hours==20 || $hours==21 || $hours==22 || $hours==23|| $hours>=0) && $hours<=8){
             $time="Breakfast";
             return "Breakfast";
         }
         else if($hours>=15 && $hours<=21){
             $time="Dinner";
             return "Dinner";
         }


     }

    }

?>