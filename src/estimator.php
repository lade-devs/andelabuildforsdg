<?php

function covid19ImpactEstimator($data)
{
    $array = array(
        'impact' => ''
    );
//  $periodType          = $data['periodType'];
//  $timeToElapse        = $data['timeToElapse'];
//  $totalHospitalBeds   = $data['totalHospitalBeds'];
//  $region              = $data['region'];
//  $avgDailyIncomeInUSD = $region['avgDailyIncomeInUSD'];




  // challenge one
//  $currentlyInfected      = $data['reportedCases'] * 10;
//  $s_currentlyInfected    = $data['reportedCases'] * 50;
//
//
//  if($periodType == "months"){
//    $timeToElapse *= 30;
//  }elseif($periodType == "weeks"){
//    $timeToElapse *=7;
//  }
//
//  $day = (int) ($timeToElapse / 3);
//
//  $infectionsByRequestedTime   = (int) ( $currentlyInfected   * pow(2,$day) );
//  $s_infectionsByRequestedTime = (int) ( $s_currentlyInfected * pow(2,$day) );
//
//  $impact = [
//      'currentlyInfected'         => $currentlyInfected,
//      'infectionsByRequestedTime' => $infectionsByRequestedTime
//  ];
//
//  $data =[
//      'data'   => $data,
//      'impact' => $impact,
//      'severeImpact' =>
//  ];


   // challenge two
//   $severeCasesByRequestedTime    = (int) ( (15/100) * $infectionsByRequestedTime );
//   $s_severeCasesByRequestedTime  = (int) ( (15/100) * $s_infectionsByRequestedTime );
//
//   $availableBeds                 = (int) ( (95/100) * $totalHospitalBeds );
//   $availableBeds                 = (int) ( (35/100) * $availableBeds );
//   $hospitalBedsByRequestedTime   = $availableBeds - $severeCasesByRequestedTime;
//   $s_hospitalBedsByRequestedTime = $availableBeds - $s_severeCasesByRequestedTime;
//
//   // challenge three
//    $casesForICUByRequestedTime   = (int) ( (5/100) * $infectionsByRequestedTime );
//    $s_casesForICUByRequestedTime = (int) ( (5/100) * $s_infectionsByRequestedTime );
//
//    $casesForVentilatorsByRequestedTime   = (int) ( (2/100) * $infectionsByRequestedTime );
//    $s_casesForVentilatorsByRequestedTime = (int) ( (2/100) * $s_infectionsByRequestedTime );
//
//    $dollarsInFlight   = (int) ( ($infectionsByRequestedTime * 0.65 * $avgDailyIncomeInUSD) / $timeToElapse );
//    $s_dollarsInFlight = (int) ( ($s_infectionsByRequestedTime * 0.65 * $avgDailyIncomeInUSD) / $timeToElapse );
//
//    // storing the estimation output
//    $impact[] = [
//        $currentlyInfected,
//        $infectionsByRequestedTime,
//        $severeCasesByRequestedTime,
//        $hospitalBedsByRequestedTime,
//        $casesForICUByRequestedTime,
//        $casesForVentilatorsByRequestedTime,
//        $dollarsInFlight
//    ];
//
//    $severeImpact[] =[
//        $s_currentlyInfected,
//        $s_infectionsByRequestedTime,
//        $s_severeCasesByRequestedTime,
//        $s_hospitalBedsByRequestedTime,
//        $s_casesForICUByRequestedTime,
//        $s_casesForVentilatorsByRequestedTime,
//        $s_dollarsInFlight
//    ];
//
//    // Final output
//    $data[] = [
//        $data,
//        $impact,
//        $severeImpact
//        ];

  return $data;
}
