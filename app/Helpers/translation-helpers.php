<?php
use App\Translation;

if (!function_exists('t')) {
	function t(string $group, string $key, string $locale = 'en') {
		$t = Translation::where('text_group', $group)->where('text_key', $key)->first();
		if (empty($t)) {
			if (App::environment('local')) {
				throw new Exception('Translation data not found for locale:"' . $locale . '", text_group:"' . $group . '", text_key:"' . $key . '"');
			}
			return $group . '|' . $key;
		}
		return $t->text_content;
	}
}