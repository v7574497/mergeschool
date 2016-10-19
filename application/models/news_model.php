<?php
class News_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('merge_school');
	}

	public function get_news($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$this->db->order_by("slug desc");
			$query = $this->db->get('news');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('news', array('slug' => $slug));
		return $query->row_array();
	}

	public function set_news()
	{
		$this->load->helper('url');
		
		//$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		);
		
		return $this->db->insert('news', $data);
	}
}