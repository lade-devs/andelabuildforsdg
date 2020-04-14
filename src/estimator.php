<?php

function covid19ImpactEstimator($data_value)
{

 $data = array();

  $periodType          = $data_value['periodType'];
  $timeToElapse        = $data_value['timeToElapse'];
  $totalHospitalBeds   = $data_value['totalHospitalBeds'];
  $region              = $data_value['region'];
  $avgDailyIncomeInUSD = $region['avgDailyIncomeInUSD'];




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


   $used_bed = (int) (0.65 * 90);

   $availabe_bed = $totalHospitalBeds - $used_bed;

//    $hospitalBedsByRequestedTime   = $used_bed - $severeCasesByRequestedTime;
//    $s_hospitalBedsByRequestedTime = $used_bed - $s_severeCasesByRequestedTime;

    $impact['hospitalBedsByRequestedTime']      = $availabe_bed;
    $severImpact['hospitalBedsByRequestedTime'] = $availabe_bed;

    $data['impact']       = $impact;
    $data['severeImpact'] = $severImpact;
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
