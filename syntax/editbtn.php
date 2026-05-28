<?php
/**
 * Include plugin (editbtn component)
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Michael Klier <chi@chimeric.de>
 */
if (!defined('DOKU_INC')) die();

class syntax_plugin_include_editbtn extends DokuWiki_Syntax_Plugin {

    public function getType() {
        return 'formatting';
    }

    public function getSort() {
        return 50;
    }

    public function handle($match, $state, $pos, Doku_Handler $handler) {
        // this is a syntax plugin that doesn't offer any syntax, so there's nothing to handle by the parser
    }

    /**
     * Renders an include edit button
     *
     * @param string        $mode
     * @param Doku_Renderer $renderer
     * @param array         $data
     * @return bool
     * @author Michael Klier <chi@chimeric.de>
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        list($title, $hid) = $data;
        if ($mode == 'xhtml') {
            $renderer->startSectionEdit(0, ['target' => 'plugin_include_editbtn', 'name' => $title, 'hid' => $hid]);
            $renderer->finishSectionEdit();
            return true;
        }
        return false;
    }
}
// vim:ts=4:sw=4:et:
