<?php
/**
 * MAKEweb
 *
 * PHP Version 5
 *
 * @category    MAKEweb
 * @package     Makeweb_TinyMce
 * @copyright   2007 brainbits GmbH (http://www.brainbits.net)
 * @version     SVN: $Id: Exception.php 2943 2007-04-18 09:00:40Z swentz $
 */

/**
 * Editor Field
 *
 * @category    MAKEweb
 * @package     Makeweb_TinyMce
 * @author      Stephan Wentz <sw@brainbits.net>
 * @copyright   2007 brainbits GmbH (http://www.brainbits.net)
 */
class Makeweb_TinyMce_Field_Editor extends Makeweb_Fields_Field_Textarea
{
    const TYPE = 'editor';
    public $icon = 'm-fields-field_editor-icon';
}