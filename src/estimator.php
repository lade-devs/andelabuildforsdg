<?php

function covid19ImpactEstimator($data_value)
{



  $periodType               = $data_value['periodType'];
  $timeToElapse             = $data_value['timeToElapse'];
  $totalHospitalBeds        = $data_value['totalHospitalBeds'];
  $avgDailyIncomeInUSD      = $data_value["region"]["avgDailyIncomeInUSD"];
  $avgDailyIncomePopulation = $data_value["region"]["avgDailyIncomePopulation"];




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




   // challenge two
   $severeCasesByRequestedTime    = (int) ( (15/100) * $infectionsByRequestedTime );
   $s_severeCasesByRequestedTime  = (int) ( (15/100) * $s_infectionsByRequestedTime );


   $impact['severeCasesByRequestedTime']       = $severeCasesByRequestedTime;
   $severImpact['severeCasesByRequestedTime']  = $s_severeCasesByRequestedTime;




    $available_bed =  ( (35/100) * $totalHospitalBeds );

    $hospitalBedsByRequestedTime   =  ($available_bed - $severeCasesByRequestedTime);
    $s_hospitalBedsByRequestedTime =  ($available_bed - $s_severeCasesByRequestedTime);

    $impact['hospitalBedsByRequestedTime']      = ($hospitalBedsByRequestedTime);
    $severImpact['hospitalBedsByRequestedTime'] = ($s_hospitalBedsByRequestedTime);


   // challenge three
    $casesForICUByRequestedTime   = floor( (5/100) * $infectionsByRequestedTime );
    $s_casesForICUByRequestedTime = floor( (5/100) * $s_infectionsByRequestedTime );

    $impact['casesForICUByRequestedTime']      = $casesForICUByRequestedTime;
    $severImpact['casesForICUByRequestedTime'] = $s_casesForICUByRequestedTime;


    $casesForVentilatorsByRequestedTime   = floor( (2/100) * $infectionsByRequestedTime );
    $s_casesForVentilatorsByRequestedTime = floor( (2/100) * $s_infectionsByRequestedTime );


    $dollarsInFlight   = floor( ($infectionsByRequestedTime * $avgDailyIncomePopulation * $avgDailyIncomeInUSD) / $timeToElapse );
    $s_dollarsInFlight = floor( ($s_infectionsByRequestedTime * $avgDailyIncomePopulation * $avgDailyIncomeInUSD) / $timeToElapse );


    $impact = [
        "currentlyInfected"                  => $currentlyInfected,
        "infectionsByRequestedTime"          => (int)$infectionsByRequestedTime,
        "severeCasesByRequestedTime"         => (int)$severeCasesByRequestedTime,
        "hospitalBedsByRequestedTime"        => (int)$hospitalBedsByRequestedTime,
        "casesForICUByRequestedTime"         => (int)$casesForICUByRequestedTime,
        "casesForVentilatorsByRequestedTime" => (int)$casesForVentilatorsByRequestedTime,
        "dollarsInFlight"                    => (int)$dollarsInFlight
    ];

    $severeImpact= [
        "currentlyInfected"                  => $s_currentlyInfected,
        "infectionsByRequestedTime"          => (int)$s_infectionsByRequestedTime,
        "severeCasesByRequestedTime"         => (int)$s_severeCasesByRequestedTime,
        "hospitalBedsByRequestedTime"        => (int)$s_hospitalBedsByRequestedTime,
        "casesForICUByRequestedTime"         => (int)$s_casesForICUByRequestedTime,
        "casesForVentilatorsByRequestedTime" => (int)$s_casesForVentilatorsByRequestedTime,
        "dollarsInFlight"                    => (int)$s_dollarsInFlight
    ];

  return array(
      "data"         =>$data_value,
      "impact"       => $impact,
      "severeImpact" => $severeImpact
  );
}
