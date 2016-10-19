<?php
	$title = $this->input->post('title');
	$content = $this->input->post('content');
	$this->merge_school_model->public_hearing_insert($title,$content);

	redirect('admin/public_hearing', 'location', 301);
?>