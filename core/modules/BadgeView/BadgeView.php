<?php
class BadgeView extends CodonModule {
	public $title = 'Badge View';
	
	public function __construct() {
		$this->ext = '.png'; // Globally set extension
	}
	
	public function index() {
		if($this->post->action) {
			switch($this->post->action) {
				case 'save_badge':
				$this->save_badge();
				break;	
			}
		}
		$all_img_names = $this->grab_badges();
		
		$this->set('allnames', $all_img_names);
		$this->show('badgeview/badgeview_index');
	}
	
	public function grab_badges() {
		/*
		*
		* For Version Update, utilize PilotData::getBackgroundImages();
		*
		*/
		$directory = 'lib/signatures/background/';
		// Make sure all files are the following extension. Could change to check, maybe later.
		
		$files = glob($directory.'*'.$this->ext); // Will return false if there is an error
		if($files !== false) { $filecount = count($files); } else { $filecount = 0; } // Set the number of files
		$num = 1; // Set the starting number count
		$all_img_names = array(); // Set the array of values
		
		// Do the magic
		while($num <= $filecount && $num > 0) {
			$all_img_names[$num] = $directory.$num.$this->ext;
			$num++;
		}
		
		// Return the array of image names
		return $all_img_names;
	}
	
	protected function save_badge() {
		$pilot = Auth::$pilot;
		$bgimg = DB::escape($this->post->bgimage);
		$params = array(
			'bgimage' => $bgimg
		);
		
		PilotData::updateProfile($pilot->pilotid, $params);	
		
		$this->set('message', 'Background Set to Badge No. '.basename($bgimg, $this->ext));
		$this->show('core_success');
	}
}