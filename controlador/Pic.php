<?php
	class Pic {
		static public function progPic($pic) {
			return crypt($pic, '$2a$07$s4N0mo1jJnaYh28GsdV8Ml9fZ$');
		}
	}