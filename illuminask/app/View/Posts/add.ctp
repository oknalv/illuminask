<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input('content', array('rows' => '3'));
	echo $this->Form->hidden('user_id',array('value'=>'1'));
	echo $this->Form->end('Save Post');
?>