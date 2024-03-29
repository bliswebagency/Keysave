<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keysave_acc {

	var $name		= 'Keysave: Ctrl+o hot key for Publish / Edit';
	var $id			= 'keysave';
	var $version		= '1.0.1';
	var $description	= 'Because both Mac and Windows have a CTRL key';
	var $sections		= array();
	
	/**
	 * Constructor
	 */
	function Keysave_acc()
	{
		$this->EE =& get_instance();
	}
	/**
	 * Set Sections
	 *
	 * Set content for the accessory
	 *
	 * @access	public
	 * @return	void
	 */
	function set_sections()
	{
		
		$this->EE->load->library('javascript');

		$str = <<<END
		
		 $("#keysave.accessory").remove();
         $("#accessoryTabs").find("a.ctrlstpl").parent("li").remove();
		
		var isCtrl = false;
		$(document).keyup(function (e) { if(e.which == 17 || e.which == 224) isCtrl=false; }).keydown(function (e) {

			if(e.which == 17 || e.which == 224) isCtrl=true;

			if(e.which == 79 && isCtrl == true) {
				$('#submit_button').trigger('click');
				return false;
			}
		});
END;
		$this->EE->javascript->output($str);
		
		if($this->EE->input->get('D') == 'cp' AND $this->EE->input->get('C') == 'addons_accessories')
        {
           $this->EE->db->where('class', 'Keysave_acc');
           $this->EE->db->update('accessories', array('controllers' => 'content'));
        }
		
	}
}
// END CLASS