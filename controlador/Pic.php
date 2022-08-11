<?php
	class Pic {
		static public function progPic($pic) {
			return crypt($pic, '$2a$07$kO0a6qmH99ziPfv20iClofK72$');
		}
	}