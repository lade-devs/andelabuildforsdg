<?php

function covid19ImpactEstimator($data)
{
  // challenge one
  $currentlyInfected      = $data['reportedCases'] * 10;
  $s_currentlyInfected    = $data['reportedCases'] * 50; 

  $day = (int) ($input_day / 3);

  $infectionsByRequestedTime   = $currentlyInfected   * pow(2,$day);
  $s_infectionsByRequestedTime = $s_currentlyInfected * pow(2,$day);

   // challenge two
   $severeCasesByRequestedTime    = ( (15/100) * $infectionsByRequestedTime );
   $s_severeCasesByRequestedTime  = ( (15/100) * $s_infectionsByRequestedTime );

  return $data;
}

function challenge_one($reportedCases,$day){

}