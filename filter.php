<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * plugin details
 *
 * @package		filter
 * @subpackage	codepen
 * @copyright	2014 Danny Wahl www.iyWare.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class filter_codepen extends moodle_text_filter {

    /**
     * @var array global configuration for this filter
     *
     * This might be eventually moved into parent class if we found it
     * useful for other filters, too.
     */
    protected static $globalconfig;

    /**
     * Apply the filter to the text
     *
     * @see filter_manager::apply_filter_chain()
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = array()) {
        if (!isset($options['originalformat'])) {
            // if the format is not specified, we are probably called by {@see format_string()}
            // in that case, it would be dangerous to replace URL with the link because it could
            // be stripped. therefore, we do nothing
            return $text;
        }
        if (in_array($options['originalformat'], explode(',', $this->get_global_config('formats')))) {
            $this->convert_urls_into_codepens($text);
        }
        return $text;
    }

    ////////////////////////////////////////////////////////////////////////////
    // internal implementation starts here
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Returns the global filter setting
     *
     * If the $name is provided, returns single value. Otherwise returns all
     * global settings in object. Returns null if the named setting is not
     * found.
     *
     * @param mixed $name optional config variable name, defaults to null for all
     * @return string|object|null
     */
    protected function get_global_config($name=null) {
        $this->load_global_config();
        if (is_null($name)) {
            return self::$globalconfig;

        } elseif (array_key_exists($name, self::$globalconfig)) {
            return self::$globalconfig->{$name};

        } else {
            return null;
        }
    }

    /**
     * Makes sure that the global config is loaded in $this->globalconfig
     *
     * @return void
     */
    protected function load_global_config() {
        if (is_null(self::$globalconfig)) {
            self::$globalconfig = get_config('filter_codepen');
        }
    }

    /**
     * Given some text this function converts any URLs it finds into embedded codepens.
     *
     * @param string $text Passed in by reference. The string to be searched for urls.
     */
    
    /**
     * Replace emoticons found in the text with their images
     *
     * @param string $text to modify
     * @return void
     */
    protected function convert_urls_into_codepens(&$text) {
        //I've added img tags to this list of tags to ignore.
        //See MDL-21168 for more info. A better way to ignore tags whether or not
        //they are escaped partially or completely would be desirable. For example:
        //<a href="blah">
        //&lt;a href="blah"&gt;
        //&lt;a href="blah">
        $filterignoretagsopen  = array('<a\s[^>]+?>');
        $filterignoretagsclose = array('</a>');
        filter_save_ignore_tags($text,$filterignoretagsopen,$filterignoretagsclose,$ignoretags);

        static $unicoderegexp;
        if (!isset($unicoderegexp)) {
            $unicoderegexp = @preg_match('/\pL/u', 'a'); // This will fail silently, returning false,
        }
        
		$regex = '((http://)?)(codepen.io\/)([a-zA-Z0-9]+)(\/pen\/)([a-zA-Z0-9]+)';

        if ($unicoderegexp) {
            $regex = '#' . $regex . '#ui';
        } else {
            $regex = '#' . preg_replace(array('\pLl', '\PL'), 'a-z', $regex) . '#i';
        }

       	$text = preg_replace($regex, '<p data-height="268" data-theme-id="0" data-slug-hash="$6" data-user="$4" data-default-tab="result" class="codepen">See the pen <a href="$0">$0</a> by (<a href="http://$3$4">@$4</a>) on <a href="http://$3">CodePen</a></p>
<script async src="//codepen.io/assets/embed/ei.js"></script>', $text);

		if (!empty($ignoretags)) {
            $ignoretags = array_reverse($ignoretags); /// Reversed so "progressive" str_replace() will solve some nesting problems.
            $text = str_replace(array_keys($ignoretags),$ignoretags,$text);
        }

    }
}