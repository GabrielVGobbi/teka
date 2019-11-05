<?php 

class homeController extends Controller {

	public function index($parametro = null) {
		 
		 $this->loadView(false, array(), false);
	}

}
