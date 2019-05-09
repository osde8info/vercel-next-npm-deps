<?php

class Npm
{

	private function getdeps($pack,$ver) {
		$vers = preg_split('/\\</', $ver);
		$ver = str_replace(array('^','~','<','>','=',' '),'',$vers[0]);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://registry.npmjs.org/$pack/$ver");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		try {
			$res = curl_exec($ch);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		curl_close($ch);

		$deps = json_decode($res,true);

		return array_key_exists('dependencies',$deps) ? $deps['dependencies'] : NULL;
	}

	public function npmdeps($pack,$ver,&$tree) {
		$deps = self::getdeps($pack,$ver);
		if (!is_null($deps) && count($deps)) {
			foreach( $deps as $pack=>$ver) {
				$tree[$pack]['ver'] = $ver;
				$tree[$pack]['deps'] = [];
				self::npmdeps($pack,$ver,$tree[$pack]['deps']);
			}
		}
	}
}
