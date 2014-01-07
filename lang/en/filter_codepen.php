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

$string['filtername'] = 'CodePen';
$string['settingformats'] = 'Apply to formats';
$string['settingformats_desc'] = 'The filter will be applied only if the original text was inserted in one of the selected formats.';
$string['settingheading'] = 'Information';
$string['settingheading_info'] = '<p>This is a text filter to embed a CodePen from <a href="http://codepen.io">codepen.io</a> into a text area in Moodle.  Simply enable the plugin and paste the direct URL to a pen in your content (or heading if enabled). A standard URL looks like this: <pre>http://codepen.io/username/pen/[Pen ID]</pre> For example: <pre>http://codepen.io/thedannywahl/pen/Gbdaj</pre></p><h4>Notes</h4><ul><li>CodePen does not have an API so we cannot manipulate the appearance of embeds on a per-Pen basis, so settings here are global.</li><li>If a user does not have javascript enabled a text fallback is provided with a link to the Pen.</li><li>Links to pens are escaped if you do not want to embed. E.g.:<br/><code>&lt;a href="http://codepen.io/thedannywahl/pen/Gbdaj"&gt;http://codepen.io/thedannywahl/pen/Gbdaj&lt;/a&gt;</code></li><li>Make sure that if you have the "URLtolink" filter enabled that the CodePen filter is listed first because links are escaped</li><li>Do not use https, www. or cdpn.io short-link, these are not valid pen URLs.  Visiting them in a browser always redirects to the full Pen URL (as exampled above)</li><li>This filter only works with the /pen/ URL.  It will not embed from other views like /full/ /live/ etc...</li></ul>';
$string['settingheight'] = 'Pen height';
$string['settingheight_desc'] = 'Set the height of all embedded Pens.';
$string['credits'] = '';
$string['credits_desc'] = '';