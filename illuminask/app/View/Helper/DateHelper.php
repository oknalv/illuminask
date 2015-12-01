<?php
  App::uses('AppHelper', 'View/Helper');
  class DateHelper extends AppHelper {
		public function ago($date){
			$units = "";
			$value = "";
			$interval = (new DateTime())->diff(new DateTime($date));
			if($interval->y > 0){
				$value = $interval->format("%y");
				if($interval->y == 1)
					$units = "%s year";
				else
					$units = "%s years";
			}
			else if($interval->m > 0){
				$value = $interval->format("%m");
				if($interval->m == 1)
					$units = "%s month";
				else
					$units = "%s months";
			}
			else if($interval->d > 0){
				$value = $interval->format("%d");
				if($interval->d == 1)
					$units = "%s day";
				else
					$units = "%s days";
			}
			else if($interval->h > 0){
				$value = $interval->format("%h");
				if($interval->h == 1)
					$units = "%s hour";
				else
					$units = "%s hours";
			}
			else if($interval->i > 0){
				$value = $interval->format("%i");
				if($interval->i == 1)
					$units = "%s minute";
				else
					$units = "%s minutes";
			}
			else{
				$value = $interval->format("%s");
				if($interval->s == 1)
					$units = "%s second";
				else
					$units = "%s seconds";
			}
			return array("value" => $value, "units" => $units);
		}
  }
