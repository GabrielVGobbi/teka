<?php 

class homeController extends Controller {

	public function index($parametro = null) {
		echo "Teka Site";
		echo ($parametro) ? $parametro : null;
	}

}
