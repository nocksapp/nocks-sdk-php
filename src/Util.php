<?php


namespace Nocks\SDK;


class Util {

	/**
	 * https://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
	 *
	 * @param $input
	 *
	 * @return string
	 */
	public static function camelCaseToSnakeCase($input) {
		return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
	}

	/**
	 * https://stackoverflow.com/questions/10507789/camelcase-to-dash-two-capitals-next-to-each-other
	 *
	 * @param $input
	 *
	 * @return string
	 */
	public static function pascalCaseToDash($input) {
		return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', lcfirst($input)));
	}

	/**
	 * https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
	 *
	 * @param $haystack
	 * @param $needle
	 *
	 * @return bool
	 */
	public static function startsWith($haystack, $needle) {
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	/**
	 * https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
	 *
	 * @param $haystack
	 * @param $needle
	 *
	 * @return bool
	 */
	public static function endsWith($haystack, $needle) {
		$length = strlen($needle);
		return $length === 0 || (substr($haystack, -$length) === $needle);
	}

	/**
	 * https://coderwall.com/p/cpxxxw/php-get-class-name-without-namespace
	 *
	 * @param $fullClassName
	 *
	 * @return mixed
	 */
	public static function getClassWithoutNamespace($fullClassName) {
		$path = explode('\\', $fullClassName);
		return array_pop($path);
	}
}