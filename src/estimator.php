<?php

function covid19ImpactEstimator($data)
{
  $periodType   = $data['periodType'];
  $timeToElapse = $data['timeToElapse'];
  $totalHospitalBeds = $data['totalHospitalBeds'];

  // challenge one
  $currentlyInfected      = $data['reportedCases'] * 10;
  $s_currentlyInfected    = $data['reportedCases'] * 50; 

  if($periodType == "month"){
    $timeToElapse *= 30;
  }elseif($periodType == "week"){
    $timeToElapse *=7;
  }


  $day = (int) ($timeToElapse / 3);

  $infectionsByRequestedTime   = (int) ( $currentlyInfected   * pow(2,$day) );
  $s_infectionsByRequestedTime = (int) ( $s_currentlyInfected * pow(2,$day) );

   // challenge two
   $severeCasesByRequestedTime    = (int) ( (15/100) * $infectionsByRequestedTime );
   $s_severeCasesByRequestedTime  = (int) ( (15/100) * $s_infectionsByRequestedTime );

   $availableBeds                 = (int) ( (35/100) * $totalHospitalBeds );
   $hospitalBedsByRequestedTime   = $availableBeds - $severeCasesByRequestedTime;
   $s_hospitalBedsByRequestedTime = $availableBeds - $s_severeCasesByRequestedTime;

  return $data;
}

function challenge_one($reportedCases,$day){

}