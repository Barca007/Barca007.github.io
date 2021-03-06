<?php
class DiviMetric {

  /**
   * Add first time option.
   */
  static function addFirstMetricOptions() {
    // Add option when user first time get divi.
    if (!get_option( 'divi_metric_first_use' )) {
      add_option( 'divi_metric_first_use', time() );
    }

    // Add option to show divi metric.
    if( !get_option( 'divi_metric' )){
      add_option( 'divi_metric', '1' );
    }
  }


  /**
   * Check week after first get.
   */
  static function checkMetricOption() {
    $return = false;
    if (get_option( 'divi_metric' ) == '1') $return = true;
    return $return;
  }


  /**
   * Check week after first get.
   */
  static function checkWeekPast() {
    $divi_week_in_time  = 604800;
    $first_use          = get_option('divi_metric_first_use');
    $diff_between       = time() - $first_use;

    $return = false;
    if ($diff_between > $divi_week_in_time) {
      $return = true;
    }
    return $return;
  }


  /**
   * Check month after vote.
   */
  static function checkMonthPast() {
    $month_in_time      = 2678400;
    $last_vote_time     = get_option('divi_metric_voted');
    $diff_between_time  = time() - $last_vote_time;

    $return = false;
    if( $diff_between_time > $month_in_time ) {
      update_option( 'divi_metric', '1' );
      $return = true;
    }
    return $return;
  }
}