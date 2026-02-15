<?php

class Utils {
	/******  Random String  ******/
	static function randomString($len = 12) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = '';
		for ($i = 0; $i < $len; $i++) {
			$str .= $chars[random_int(0, strlen($chars) - 1)];
		}
		return $str;
	}

	/******  Base64 Functions  ******/
	static function base64_url_encode($input) {
		return strtr(base64_encode($input), '+/', '-_');
	}

	static function base64_url_decode($input) {
		return base64_decode(strtr($input, '-_', '+/'));
	}

	static function base64_url_encode_safe($input) {
		return str_replace("=", "", strtr(base64_encode($input), '+/', '-_'));
	}

	static function base64_url_decode_safe($input) {
		$str = str_pad($input, strlen($input) + (4 - strlen($input) % 4) % 4, '=', STR_PAD_RIGHT);
		return base64_decode(strtr($str, '-_', '+/'));
	}

	/******  XML ******/
	static function getTagContent($data, $tag){
		$posTagStart = strrpos($data, "<" . $tag . ">");
		$sizeTagStart = strlen("<" . $tag . ">");
		$posTagEnd = strrpos($data, "</" . $tag . ">");
		return substr($data, $posTagStart + $sizeTagStart, $posTagEnd - ($posTagStart + $sizeTagStart));
	}

	static function arrayToXmlString(array $data, string $rootElement = 'root'): string {
		$xml = "<{$rootElement}>\n";

		$buildXml = function($data, $indent = "  ") use (&$buildXml) {
			$xmlPart = "";
			foreach ($data as $key => $value) {
				// Validar nombre de etiqueta
				$elementName = preg_match('/^[a-zA-Z_][\w\-\.]*$/', $key) ? $key : 'item';

				// Convertir booleanos
				if (is_bool($value)) {
					$value = $value ? 'true' : 'false';
				}

				// Convertir null
				if (is_null($value)) {
					$xmlPart .= "null<{$elementName}/>\n";
				}
				// Si es array, recursivo
				elseif (is_array($value)) {
					$xmlPart .= "{$indent}<{$elementName}>\n";
					$xmlPart .= $buildXml($value, $indent . "  ");
					$xmlPart .= "{$indent}</{$elementName}>\n";
				}
				// Valor normal
				else {
					$xmlPart .= "{$indent}<{$elementName}>" . htmlspecialchars((string)$value, ENT_XML1, 'UTF-8') . "</{$elementName}>\n";
				}
			}
			return $xmlPart;
		};

		$xml .= $buildXml($data);
		$xml .= "</{$rootElement}>";
		return $xml;
	}


    /******  Current URL  ******/
	static function getCurrentUrl() {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }
}

?>