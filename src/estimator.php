<?php

function covid19ImpactEstimator($data_value)
{

 $data = array();

  $periodType               = $data_value['periodType'];
  $timeToElapse             = $data_value['timeToElapse'];
  $totalHospitalBeds        = $data_value['totalHospitalBeds'];
  $region                   = $data_value['region'];
  $avgDailyIncomeInUSD      = $region['avgDailyIncomeInUSD'];
  $avgDailyIncomePopulation = $region['avgDailyIncomePopulation'];




  // challenge one
  $currentlyInfected      = $data_value['reportedCases'] * 10;
  $s_currentlyInfected    = $data_value['reportedCases'] * 50;




  if($periodType == "months"){
    $timeToElapse *= 30;
  }elseif($periodType == "weeks"){
    $timeToElapse *=7;
  }

  $day = (int) ($timeToElapse / 3);

  $infectionsByRequestedTime   = (int) ( $currentlyInfected   * pow(2,$day) );
  $s_infectionsByRequestedTime = (int) ( $s_currentlyInfected * pow(2,$day) );


  $impact = array(
        'currentlyInfected'         => $currentlyInfected,
        'infectionsByRequestedTime' => $infectionsByRequestedTime
  );
  $severImpact = array(
      'currentlyInfected'         => $s_currentlyInfected,
      'infectionsByRequestedTime' => $s_infectionsByRequestedTime
  );

    $data['impact']       = $impact;
    $data['severeImpact'] = $severImpact;


   // challenge two
   $severeCasesByRequestedTime    = (int) ( (15/100) * $infectionsByRequestedTime );
   $s_severeCasesByRequestedTime  = (int) ( (15/100) * $s_infectionsByRequestedTime );


   $impact['severeCasesByRequestedTime']       = $severeCasesByRequestedTime;
   $severImpact['severeCasesByRequestedTime']  = $s_severeCasesByRequestedTime;

   $data['impact']       = $impact;
   $data['severeImpact'] = $severImpact;



    $available_bed = (int) ( (35/100) * $totalHospitalBeds );

    $hospitalBedsByRequestedTime   = (int) ($available_bed - $severeCasesByRequestedTime);
    $s_hospitalBedsByRequestedTime = (int) ($available_bed - $s_severeCasesByRequestedTime);

    $impact['hospitalBedsByRequestedTime']      = intval($hospitalBedsByRequestedTime);
    $severImpact['hospitalBedsByRequestedTime'] = intval($s_hospitalBedsByRequestedTime);

    $data['impact']       = intval($impact);
    $data['severeImpact'] = intval($severImpact);

   // challenge three
    $casesForICUByRequestedTime   = (int) ( (5/100) * $infectionsByRequestedTime );
    $s_casesForICUByRequestedTime = (int) ( (5/100) * $s_infectionsByRequestedTime );

    $impact['casesForICUByRequestedTime']      = $casesForICUByRequestedTime;
    $severImpact['casesForICUByRequestedTime'] = $s_casesForICUByRequestedTime;

    $data['impact']       = $impact;
    $data['severeImpact'] = $severImpact;

    $casesForVentilatorsByRequestedTime   = (int) ( (2/100) * $infectionsByRequestedTime );
    $s_casesForVentilatorsByRequestedTime = (int) ( (2/100) * $s_infectionsByRequestedTime );

    $impact['casesForVentilatorsByRequestedTime']      = $casesForVentilatorsByRequestedTime;
    $severImpact['casesForVentilatorsByRequestedTime'] = $s_casesForVentilatorsByRequestedTime;

    $data['impact']       = $impact;
    $data['severeImpact'] = $severImpact;

    $dollarsInFlight   = (int) ( ($infectionsByRequestedTime * $avgDailyIncomePopulation * $avgDailyIncomeInUSD) / $timeToElapse );
    $s_dollarsInFlight = (int) ( ($s_infectionsByRequestedTime * $avgDailyIncomePopulation * $avgDailyIncomeInUSD) / $timeToElapse );

    $impact['dollarsInFlight']      = $dollarsInFlight;
    $severImpact['dollarsInFlight'] = $s_dollarsInFlight;

    $data['impact']       = $impact;
    $data['severeImpact'] = $severImpact;

  return $data;
}
