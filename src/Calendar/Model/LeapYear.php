<?php

namespace Calendar\Model;

class LeapYear {

  public function is_leap_year($year = NULL) {
    if (NULL === $year) {
      $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
  }
}
