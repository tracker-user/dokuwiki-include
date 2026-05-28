<?php
/**
 * Include plugin (readmore component)
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Michael Hamann <michael@content-space.de>
 */
if (!defined('DOKU_INC')) die();

class syntax_plugin_include_readmore extends DokuWiki_Syntax_Plugin {

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
     * Renders a "read more" link
     *
     * @param string        $mode
     * @param Doku_Renderer $renderer
     * @param array         $data
     * @return bool
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        list($page) = $data;

        if ($mode == 'xhtml') {
            $renderer->doc .= DOKU_LF.'<p class="include_readmore">'.DOKU_LF;
        } else {
            $renderer->p_open();
        }

        $renderer->internallink($page, $this->getLang('readmore'));

        if ($mode == 'xhtml') {
            $renderer->doc .= DOKU_LF.'</p>'.DOKU_LF;
        } else {
            $renderer->p_close();
        }

        return true;
    }
}
// vim:ts=4:sw=4:et:
