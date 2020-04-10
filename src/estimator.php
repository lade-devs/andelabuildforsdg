<?php

function covid19ImpactEstimator($data)
{
  $currentlyInfected      = $data['reportedCases'] * 10;
  $s_currentlyInfected    = $data['reportedCases'] * 50; 

  $day = $input_day / 3;

  $infectionsByRequestedTime   = $currentlyInfected   * pow(2,$day);
  $s_infectionsByRequestedTime = $s_currentlyInfected * pow(2,$day);

  return $data;
}