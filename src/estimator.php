<?php

function covid19ImpactEstimator($data)
{
  $periodType   = $data['periodType'];
  $timeToElapse = $data['timeToElapse'];

  // challenge one
  $currentlyInfected      = $data['reportedCases'] * 10;
  $s_currentlyInfected    = $data['reportedCases'] * 50; 

  if($periodType == "month"){
    $timeToElapse *= 30;
  }elseif($periodType == "week"){
    $timeToElapse *=7;
  }

  $day = (int) ($timeToElapse / 3);

  $infectionsByRequestedTime   = $currentlyInfected   * pow(2,$day);
  $s_infectionsByRequestedTime = $s_currentlyInfected * pow(2,$day);

   // challenge two
   $severeCasesByRequestedTime    = ( (15/100) * $infectionsByRequestedTime );
   $s_severeCasesByRequestedTime  = ( (15/100) * $s_infectionsByRequestedTime );

  return $data;
}

function challenge_one($reportedCases,$day){

}