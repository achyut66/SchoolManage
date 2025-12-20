<?php

use App\Models\PalikaProfile;

if(!function_exists('getProfile')) {
  function getProfile(){
    $profile = PalikaProfile::first();
    return $profile;
  }
}

if(! function_exists('getCurrentUser()')) {
  function getCurrentUser() {
    $data  = ['userID' => Auth()->user()->id, 'shakhaID' => Auth()->user()->shakha_id];
    return $data;
  }
}

//get month names 
if(!function_exists('monthNames')) {
  function monthNames() {
    return array(
      '4' => 'श्रावण',
      '5' => 'भाद्र',
      '6' => 'आश्विन',
      '7' => 'कार्तिक',
      '8' => 'मार्ग',
      '9' => 'पौष',
      '10' => 'माघ',
      '11' => 'फाल्गुन',
      '12' => 'चैत्र',
      '1' => 'वैशाख',
      '2' => 'ज्येष्ठ',
      '3' => 'आषाढ',
    );
  }
}

if(!function_exists('explodeData')) {
  function explodeData($delimiter,$data) {
    return explode($delimiter, $data);
  }
}

if(!function_exists('pp')) {
  function pp($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
  }
}

// gpa function

if (!function_exists('calculateGpaFromPercentage')) {
  function calculateGpaFromPercentage($percentage)
  {
      if ($percentage >= 90 && $percentage <= 100) {
          return ['grade' => 'A+', 'gpa' => 4.00];
      } elseif ($percentage >= 80 && $percentage < 90) {
          return ['grade' => 'A', 'gpa' => 4.00];
      } elseif ($percentage >= 75 && $percentage < 80) {
          return ['grade' => 'A-', 'gpa' => 3.67];
      } elseif ($percentage >= 70 && $percentage < 75) {
          return ['grade' => 'B+', 'gpa' => 3.33];
      } elseif ($percentage >= 65 && $percentage < 70) {
          return ['grade' => 'B', 'gpa' => 3.00];
      } elseif ($percentage >= 60 && $percentage < 65) {
          return ['grade' => 'B-', 'gpa' => 2.67];
      } elseif ($percentage >= 55 && $percentage < 60) {
          return ['grade' => 'C+', 'gpa' => 2.33];
      } elseif ($percentage >= 50 && $percentage < 55) {
          return ['grade' => 'C', 'gpa' => 2.00];
      } elseif ($percentage >= 47 && $percentage < 50) {
          return ['grade' => 'C-', 'gpa' => 1.67];
      } elseif ($percentage >= 44 && $percentage < 47) {
          return ['grade' => 'D+', 'gpa' => 1.33];
      } elseif ($percentage >= 40 && $percentage < 44) {
          return ['grade' => 'D', 'gpa' => 1.00];
      } else {
          return ['grade' => 'Fail', 'gpa' => 0.00];
      }
  }
}