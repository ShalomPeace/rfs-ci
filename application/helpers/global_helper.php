<?php 

function c($string) 
{
	return htmlentities($string, ENT_QUOTES, 'utf-8');
}

function csrf_field($display = true) 
{
	$ci =& get_instance();

	$csrf = array(
	        'name' => $ci->security->get_csrf_token_name(),
	        'hash' => $ci->security->get_csrf_hash(),
	);

	$tag = '<input type="hidden" name="' . $csrf['name'] . '" value="' . $csrf['hash'] . '">';

	if ( ! $display) return $tag;

	echo $tag;
}

function flash($key, $display = true) 
{
	$data = get_instance()->session->getFlash($key);

	if ( ! $display) return $data;

	echo $data;
} 

function errors($name, $display = true) 
{
	$ci =& get_instance();

	$error = ($ci->error->has($name)) ? $ci->error->get($name) : '';

	if ( ! $display) return $error;

	echo $error;
}

function route($uri, array $params = array(), $asQuery = false) 
{
	$uri = rtrim($uri, '/') . '/';

	if (count($params)) {
		if ( ! $asQuery) {
			$uri .= implode('/', $params);
		} else {
			$count = 1;

			foreach ($params as $name => $value) {
				$uri .= ($count === 1) ? '?' : '';
				$uri .= "{$name}={$value}";
				$uri .= ($count < count($params)) ? '&' : '';

				$count++;
			}
		}
	}

	return base_url($uri);
}

function messages($item, $params = '') 
{
	$ci =& get_instance();

	$ci->load->library('messages'); 

	return $ci->messages->get($item, $params);
}

function array_except(array $items, $exclude) 
{
	foreach ($items as $key => $value) {
		if (is_array($exclude)) {
			if (in_array($key, $exclude)) {
				unset($items[$key]);
			}
		} else {
			if ($key === $exclude) {
				unset($items[$key]);
			}
		}
	}

	return $items;
}

function diedump($value, $die = true, $beautify = false) 
{
	if ( ! $beautify) {
		var_dump($value);
	} else {
		echo '<pre>', var_dump($value), '</pre>';
	}

	if ($die) die();
}

function printdie($value, $die = true, $beautify = false) 
{
	if ( ! $beautify) {
		print_r($value);
	} else {
		echo '<pre>', print_r($value), '</pre>';
	}

	if ($die) die();
}

function auth()
{
	$ci =& get_instance();

	return $ci->auth;
}