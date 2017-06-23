<?php
class MyTimeHelper extends Helper{

var $helpers = array('Time');

/**
 * Alias for timeAgoInWords
 * @param string $date_string Datetime string or Unix timestamp
 * @param string $format Default format if timestamp is used in $date_string
 * @param  boolean $return Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Relative time string.
 * @see		timeAgoInWords
 */
	 function relativeTime($datetime_string, $format = 'j/n/Y', $return = false) {
		  $date=strtotime($datetime_string);

		  if (strtotime("now") > $date) {
				$ret = $this->timeAgoInWords($datetime_string, $format, false);
		  } else {
				$ret = $this->timeAgoInWords($datetime_string, $format, true);
		  }

		  return $this->output($ret, $return);
	 }

/**
 * Returns either a relative date or a formatted date depending
 * on the difference between the current time and given datetime.
 * $datetime should be in a <i>strtotime</i>-parsable format, like MySQL's datetime datatype.
 *
 * Relative dates look something like this:
 *	3 weeks, 4 days ago
 *	15 seconds ago
 * Formatted dates look like this:
 *	on 02/18/2004
 *
 * The returned string includes 'ago' or 'on' and assumes you'll properly add a word
 * like 'Posted ' before the function output.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param string $format Default format if timestamp is used in $date_string
 * @param string $backwards False if $date_string is in the past, true if in the future
 * @param  boolean $return Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Relative time string.
 */
	 function timeAgoInWords($datetime_string, $format = 'j/n/Y', $backwards = false, $return = false) {
		  $datetime  =$this->Time->fromString($datetime_string);

		  $in_seconds=$datetime;

		  if ($backwards) {
				$diff = $in_seconds - time();
		  } else {
				$diff = time() - $in_seconds;
		  }

		  $months=floor($diff / 2419200);
		  $diff -= $months * 2419200;
		  $weeks=floor($diff / 604800);
		  $diff -= $weeks * 604800;
		  $days=floor($diff / 86400);
		  $diff -= $days * 86400;
		  $hours=floor($diff / 3600);
		  $diff -= $hours * 3600;
		  $minutes=floor($diff / 60);
		  $diff -= $minutes * 60;
		  $seconds=$diff;
		  

		  $relative_date = '';
		  $old=false;

			  if ($months > 0) {
					// over a month old, just show date (mm/dd/yyyy format)
					$old=true;
					 // show relative date and add proper verbiage 
					$relative_date .= $months. ($months > 1 ? '  μήνες, ' : ' μήνα, ');
				}
				
				if ($weeks > 0) {
					 // weeks and days
					 $relative_date .= $weeks  . ($weeks > 1 ? ' εβδομάδες' : ' εβδομάδα');
					 $relative_date .=  $days > 0 ? ($relative_date ? ', ' : '') .   $days  . ($days > 1 ? ' ημέρες' : ' ημέρα') : '';
				} elseif($days > 0) {
					 // days and hours
					 $relative_date .= ($relative_date ? ', ' : '') . $days .  ($days > 1 ? ' ημέρες' : ' ημέρα');
					 $relative_date .=  $hours > 0 ?  ($relative_date ? ', ' : '') . $hours . ($hours > 1 ? ' ώρες' : ' ώρα') : '';
				} elseif($hours > 0) {
					 // hours and minutes
					 $relative_date .= ($relative_date ? ', ' : '') . $hours .  ($hours > 1 ? ' ώρες' : ' ώρα');
					 $relative_date .= $minutes > 0 ? ($relative_date ? ', ' : '') . $minutes . ($minutes > 1 ? ' λεπτά' : ' λεπτό') : '';
				} elseif($minutes > 0) {
					 // minutes only
					 $relative_date .=  $minutes .  ($minutes > 1 ? ' λεπτά' : ' λεπτό');
				} else {
					 // seconds only
					 $relative_date .=  $seconds . ($seconds != 1 ? ' δευτερόλεπτα' : ' δευτερόλεπτο');
				}
				
		  $begin_with = '';

		  if (!$backwards) {
				$begin_with = 'πριν από: ';
		  }else {
		  	    $begin_with = 'σε: ';
		  }
		  
		  
		  $ret=$begin_with.$relative_date;

		  return $this->output($ret, $return);
	 }


/**
 * Returns a dd/mm/yyyy formatted date string for given Datetime string.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param  boolean $return	Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Formatted date string
 */
	 function standardDate($date_string = null, $return = false) {
		  if ($date_string != null) {
		  		if ($date_string != '0000-00-00 00:00:00')
					$date = $this->Time->fromString($date_string);
				else
					$date = 'N/A';
		  } else {
				$date = time();
		  }
			
		  if (is_numeric($date ))
		  	$ret=date("j-n-Y", $date);
		  else if(is_string($date))
		  	$ret = $date;
		 
		  return $this->output($ret, $return);
	 }

/**
 * Returns a dd/mm/yyyy with time formatted date string for given Datetime string.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param  boolean $return	Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Formatted date string
 */
	 function standardDateTime($date_string = null, $return = false) {
		  if ($date_string != null) {
		  		if ($date_string != '0000-00-00 00:00:00')
					$date = $this->Time->fromString($date_string);
				else
					$date = 'N/A';

		  } else {
				$date = time();
		  }
		 if (is_numeric($date ))
				 $ret=date("j-n-Y, H:i", $date);
		 else if (is_string($date))
				$ret = $date;
		 
		  return $this->output($ret, $return);
	 }

/**
 * Returns the day string for given Datetime string.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param  boolean $return	Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Formatted date string
 */
	 function dateToDay($date_string = null, $return = false) {
		  if ($date_string != null) {
				$date = $this->Time->fromString($date_string);
		  } else {
				$date = time();
		  }

		  $ret=date('d', $date);
		  return $this->output($ret, $return);
	 }

/**
 * Returns the month string for given Datetime string.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param  boolean $return	Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Formatted date string
 */
	 function dateToMonth($date_string = null, $return = false) {
		  if ($date_string != null) {
				$date = $this->Time->fromString($date_string);
		  } else {
				$date = time();
		  }

		  $ret=date('m', $date);
		  return $this->output($ret, $return);
	 }
	 
	/**
 * Returns the year string for given Datetime string.
 *
 * @param string $date_string Datetime string or Unix timestamp
 * @param  boolean $return	Whether this method should return a value or output it. This overrides AUTO_OUTPUT.
 * @return string Formatted date string
 */
	 function dateToYear($date_string = null, $return = false) {
		  if ($date_string != null) {
				$date = $this->Time->fromString($date_string);
		  } else {
				$date = time();
		  }

		  $ret=date('Y', $date);
		  return $this->output($ret, $return);
	 }


}
?>