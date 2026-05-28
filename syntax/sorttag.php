<?php
/**
 * Include plugin sort order tag
 * Idea and parts of the code copied from the indexmenu plugin.
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Samuele Tognini <samuele@netsons.org>
 * @author  Michael Hamann <michael@content-space.de>
 */
if (!defined('DOKU_INC')) die();

class syntax_plugin_include_sorttag extends DokuWiki_Syntax_Plugin {

    public function getType() {
        return 'substition';
    }

    public function getPType() {
        return 'block';
    }

    public function getSort() {
        return 139;
    }

    /**
     * Connect pattern to lexer
     *
     * @param string $mode
     */
    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('{{include_n>.+?}}', $mode, 'plugin_include_sorttag');
    }

    /**
     * Handle the match
     *
     * @param string       $match
     * @param int          $state
     * @param int          $pos
     * @param Doku_Handler $handler
     * @return array
     */
    public function handle($match, $state, $pos, Doku_Handler $handler) {
        $match = substr($match, 12, -2);
        return [$match];
    }

    /**
     * Render output
     *
     * @param string        $mode
     * @param Doku_Renderer $renderer
     * @param array         $data
     * @return bool
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if ($mode === 'metadata') {
            /** @var Doku_Renderer_metadata $renderer */
            $renderer->meta['include_n'] = $data[0];
        }
        return false;
    }
}
