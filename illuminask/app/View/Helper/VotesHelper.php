<?php
  App::uses('AppHelper', 'View/Helper');
  class VotesHelper extends AppHelper {
    public function calculate($votes){
			$i = 0;
			foreach($votes as $vote){
				if($vote['liked'] == 1) $i++;
				else $i--;
			}
			return $i;
    }
  }
