<?php
	include_once 'AppModel.php';

	class Post extends AppModel{

		public $name = 'Post';
		public $belongsTo = 'User';
		public $hasMany = array('PostVote', 'Response', 'PostVisit');

		public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'content' => array(
            'rule' => 'notBlank'
        )
  	);

		public function afterFind($results, $primary = false){
			foreach ($results as $i => $result) {
				$results[$i]["Post"]["ago"] = $this->ago($result['Post']['date']);
				$results[$i]["Post"]["votes"] = $this->calculateVotes($result["PostVote"]);
				$results[$i]["Post"]["responses"] = count($result["Response"]);
				$results[$i]["Post"]["visits"] = count($result["PostVisit"]);
			}
			return $results;
		}

		private function calculateVotes($votes){
			$i = 0;
			foreach($votes as $vote){
				if($vote['liked'] == 1) $i++;
				else $i--;
			}
			return $i;
		}

		private function ago($date){
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
