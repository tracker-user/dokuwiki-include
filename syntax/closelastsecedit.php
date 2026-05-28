<?php
/**
 * Include plugin (close last section edit)
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Michael Hamann <michael@content-space.de>
 */
if (!defined('DOKU_INC')) die();

class syntax_plugin_include_closelastsecedit extends DokuWiki_Syntax_Plugin {

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
     * Finishes the last open section edit
     *
     * @param string        $mode
     * @param Doku_Renderer $renderer
     * @param array         $data
     * @return bool
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if ($mode == 'xhtml') {
            /** @var Doku_Renderer_xhtml $renderer */
            list($endpos) = $data;
            $renderer->finishSectionEdit($endpos);
            return true;
        }
        return false;
    }
}
// vim:ts=4:sw=4:et:
