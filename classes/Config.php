<?php
	class Config{
		/**
		 * Beállítás lekérdezés. Ezek a beállítások a 'config.php' fájlban vannak tárolva.
		 * @return mixed visszadja a beállított értéket.
		 * @param string $arg A beállítási kulcs.
		 * @param string $return Ha ez 'throw_error' (alapértelmezett) akkor dob egy exceptiont, ha nem találja az értéket.
		 * @throws Exception
		 */
		public static function get($arg, $return = 'throw_error') {
			$a = explode('/', $arg);
			$o = $GLOBALS;
			foreach ($a as $k) {
				if (!isset($o[$k])) {
					if ($return == 'throw_error') {
						throw new Exception("Error while getting config $arg", 1);
					}
					return $return;
				}
				$o = $o[$k];
			}
			return $o;
		}
	}