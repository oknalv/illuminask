<?php
	class PostVotesController extends AppController {
    public $components = array('Flash','Session');
		public $uses = array("Post","PostVote");

    public function upvote($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				if($this->PostVote->hasAny(
					array('PostVote.user_id' => $user)
					))
					$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
				$this->PostVote->save(array('user_id' => $user, 'post_id' => $postId, 'liked' => 1));
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }

    public function downvote($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				if($this->PostVote->hasAny(
					array('PostVote.user_id' => $user)
					))
					$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
				$this->PostVote->save(array('user_id' => $user, 'post_id' => $postId, 'liked' => 0)); //CAMBIAR SI CAMBIA COMO ALMACENAR VOTOS NEGATIVOS, PROBABLEMENTE NECESARIO
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }


    public function remove($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				if($this->PostVote->hasAny(
					array('PostVote.user_id' => $user)
					))
					$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }
  }
