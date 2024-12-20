<?php

  $first_names = ["Youcef",
                  "Lina",
                  "Branimir",
                  "Kenith",
                  "Roland",
                  "Sarkis",
                  "Tim",
                  "Iris",
                  "Jennifer",
                  "Sabrina"];

  $last_names = ["Kiplagat",
                 "Abdelnour",
                 "Narasimhan",
                 "Fields",
                 "Papaliolios",
                 "Longmire",
                 "Greer",
                 "Mclaughlin",
                 "Zuniga",
                 "Rasmussen"];

  $letters = ["A", "B", "C", "D", "E", "F", "G", "H",
              "I", "J", "K", "L", "M", "N", "O", "P",
              "Q", "R", "S", "T", "U", "V", "W", "X",
              "Y", "Z"];

  $data = array();
  $data["first_name"] = $first_names[rand(0,9)];
  $data["last_name"] = $last_names[rand(0,9)];
  $data["health_card_number"] = rand(0,9) .
                         rand(0,9) .
                         rand(0,9) .
                         rand(0,9) .
                         "-" .
                         rand(0,9) .
                         rand(0,9) .
                         rand(0,9) .
                         "-" .
                         rand(0,9) .
                         rand(0,9) .
                         rand(0,9) .
                         " " .
                         $letters[rand(0,25)] .
                         $letters[rand(0,25)];

  $month = rand(1,12);
  if ($month <= 9) $month = "0" . $month;

  $day = rand(1,28);
  if ($day <= 9) $day = "0" . $day;

  $data["dob"] = rand(1922,2021) .
                      "-" .
                      $month .
                      "-" .
                      $day;


  echo json_encode( $data );

?>