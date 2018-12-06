<?php
namespace Grav\Plugin;

use Grav\Common\Data;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;
/* https://github.com/acla/bibtex2html */
require_once 'vendor/bibtex2html.php';

class BibLaTeXPlugin extends Plugin
{
    /**
     * Register events with Grav
     * 
     * @return void
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }
    
    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }
        $config = (array) $this->config->get('plugins')['biblatex'];
        if ($config['enabled']) {
            $this->enable(
                [
                    'onPageContentProcessed' => ['onPageContentProcessed', -1]
                ]
            );
        } else {
            return;
        }
    }
    
    /**
     * Manipulate page content
     * 
     * @return void
     */
    public function onPageContentProcessed()
    {
        $page = $this->grav['page'];
        if (isset($page->header()->bibtex) && file_exists($bibFile)) {
            $config = (array) $this->config->get('plugins')['biblatex'];
            $bibFile = $page->path() . DIRECTORY_SEPARATOR . $page->header()->bibtex;
            $content = $page->content();
            $content .= '<div class="biblatex">';
            $file = file_get_contents($bibFile);
            $displayTypes = $config['displayTypes'];
            $groupType = $config['groupType'];
            $groupYear = $config['groupYear'];
            $highlightName = $config['highlightName'];
            $numbersDesc = $config['numbersDesc'];
            $sorting = $config['sorting'];
            $authorLimit = $config['authorLimit'];
            $bibtex_content = bibfile2html($bibFile, $displayTypes, $groupType, $groupYear, '', $highlightName, $numbersDesc, $sorting, $authorLimit, '');
            $content .= $bibtex_content;
            $content .= '</div>';
            $page->setRawContent($content);
        }
    }
}
