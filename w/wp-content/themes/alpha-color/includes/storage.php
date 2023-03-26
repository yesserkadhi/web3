<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage ALPHA_COLOR
 * @since ALPHA_COLOR 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('alpha_color_storage_get')) {
	function alpha_color_storage_get($var_name, $default='') {
		global $ALPHA_COLOR_STORAGE;
		return isset($ALPHA_COLOR_STORAGE[$var_name]) ? $ALPHA_COLOR_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('alpha_color_storage_set')) {
	function alpha_color_storage_set($var_name, $value) {
		global $ALPHA_COLOR_STORAGE;
		$ALPHA_COLOR_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('alpha_color_storage_empty')) {
	function alpha_color_storage_empty($var_name, $key='', $key2='') {
		global $ALPHA_COLOR_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($ALPHA_COLOR_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($ALPHA_COLOR_STORAGE[$var_name][$key]);
		else
			return empty($ALPHA_COLOR_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('alpha_color_storage_isset')) {
	function alpha_color_storage_isset($var_name, $key='', $key2='') {
		global $ALPHA_COLOR_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($ALPHA_COLOR_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($ALPHA_COLOR_STORAGE[$var_name][$key]);
		else
			return isset($ALPHA_COLOR_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('alpha_color_storage_inc')) {
	function alpha_color_storage_inc($var_name, $value=1) {
		global $ALPHA_COLOR_STORAGE;
		if (empty($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = 0;
		$ALPHA_COLOR_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('alpha_color_storage_concat')) {
	function alpha_color_storage_concat($var_name, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (empty($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = '';
		$ALPHA_COLOR_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('alpha_color_storage_get_array')) {
	function alpha_color_storage_get_array($var_name, $key, $key2='', $default='') {
		global $ALPHA_COLOR_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($ALPHA_COLOR_STORAGE[$var_name][$key]) ? $ALPHA_COLOR_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($ALPHA_COLOR_STORAGE[$var_name][$key][$key2]) ? $ALPHA_COLOR_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('alpha_color_storage_set_array')) {
	function alpha_color_storage_set_array($var_name, $key, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if ($key==='')
			$ALPHA_COLOR_STORAGE[$var_name][] = $value;
		else
			$ALPHA_COLOR_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('alpha_color_storage_set_array2')) {
	function alpha_color_storage_set_array2($var_name, $key, $key2, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if (!isset($ALPHA_COLOR_STORAGE[$var_name][$key])) $ALPHA_COLOR_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$ALPHA_COLOR_STORAGE[$var_name][$key][] = $value;
		else
			$ALPHA_COLOR_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('alpha_color_storage_merge_array')) {
	function alpha_color_storage_merge_array($var_name, $key, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if ($key==='')
			$ALPHA_COLOR_STORAGE[$var_name] = array_merge($ALPHA_COLOR_STORAGE[$var_name], $value);
		else
			$ALPHA_COLOR_STORAGE[$var_name][$key] = array_merge($ALPHA_COLOR_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('alpha_color_storage_set_array_after')) {
	function alpha_color_storage_set_array_after($var_name, $after, $key, $value='') {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if (is_array($key))
			alpha_color_array_insert_after($ALPHA_COLOR_STORAGE[$var_name], $after, $key);
		else
			alpha_color_array_insert_after($ALPHA_COLOR_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('alpha_color_storage_set_array_before')) {
	function alpha_color_storage_set_array_before($var_name, $before, $key, $value='') {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if (is_array($key))
			alpha_color_array_insert_before($ALPHA_COLOR_STORAGE[$var_name], $before, $key);
		else
			alpha_color_array_insert_before($ALPHA_COLOR_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('alpha_color_storage_push_array')) {
	function alpha_color_storage_push_array($var_name, $key, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($ALPHA_COLOR_STORAGE[$var_name], $value);
		else {
			if (!isset($ALPHA_COLOR_STORAGE[$var_name][$key])) $ALPHA_COLOR_STORAGE[$var_name][$key] = array();
			array_push($ALPHA_COLOR_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('alpha_color_storage_pop_array')) {
	function alpha_color_storage_pop_array($var_name, $key='', $defa='') {
		global $ALPHA_COLOR_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($ALPHA_COLOR_STORAGE[$var_name]) && is_array($ALPHA_COLOR_STORAGE[$var_name]) && count($ALPHA_COLOR_STORAGE[$var_name]) > 0) 
				$rez = array_pop($ALPHA_COLOR_STORAGE[$var_name]);
		} else {
			if (isset($ALPHA_COLOR_STORAGE[$var_name][$key]) && is_array($ALPHA_COLOR_STORAGE[$var_name][$key]) && count($ALPHA_COLOR_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($ALPHA_COLOR_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('alpha_color_storage_inc_array')) {
	function alpha_color_storage_inc_array($var_name, $key, $value=1) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if (empty($ALPHA_COLOR_STORAGE[$var_name][$key])) $ALPHA_COLOR_STORAGE[$var_name][$key] = 0;
		$ALPHA_COLOR_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('alpha_color_storage_concat_array')) {
	function alpha_color_storage_concat_array($var_name, $key, $value) {
		global $ALPHA_COLOR_STORAGE;
		if (!isset($ALPHA_COLOR_STORAGE[$var_name])) $ALPHA_COLOR_STORAGE[$var_name] = array();
		if (empty($ALPHA_COLOR_STORAGE[$var_name][$key])) $ALPHA_COLOR_STORAGE[$var_name][$key] = '';
		$ALPHA_COLOR_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('alpha_color_storage_call_obj_method')) {
	function alpha_color_storage_call_obj_method($var_name, $method, $param=null) {
		global $ALPHA_COLOR_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($ALPHA_COLOR_STORAGE[$var_name]) ? $ALPHA_COLOR_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($ALPHA_COLOR_STORAGE[$var_name]) ? $ALPHA_COLOR_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('alpha_color_storage_get_obj_property')) {
	function alpha_color_storage_get_obj_property($var_name, $prop, $default='') {
		global $ALPHA_COLOR_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($ALPHA_COLOR_STORAGE[$var_name]->$prop) ? $ALPHA_COLOR_STORAGE[$var_name]->$prop : $default;
	}
}
?>