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
    public static function getSubscribedEvents() {
        return [
            'onPageContentProcessed' => ['onPageContentProcessed', -1]
        ];
    }
    public function onPageContentProcessed(Event $event)
    {
        $page = $event['page'];
        $pluginsobject = (array) $this->config->get('plugins');
        $pageobject = $this->grav['page'];
		if (isset($pluginsobject['biblatex'])) {
            if ($pluginsobject['biblatex']['enabled']) {
				$bibtex_file = $pageobject->path() . '/' . $pageobject->header()->bibtex;
				if (file_exists($bibtex_file)) {
					$content = $page->content();
					$content .= '<div class="biblatex">';
					$file = file_get_contents($bibtex_file);
					$this->grav['debugger']->addMessage($file);
					$displayTypes = $pluginsobject['biblatex']['displayTypes'];
					$groupType = $pluginsobject['biblatex']['groupType'];
					$groupYear = $pluginsobject['biblatex']['groupYear'];
					$highlightName = $pluginsobject['biblatex']['highlightName'];
					$numbersDesc = $pluginsobject['biblatex']['numbersDesc'];
					$sorting = $pluginsobject['biblatex']['sorting'];
					$authorLimit = $pluginsobject['biblatex']['authorLimit'];
					$bibtex_content = bibfile2html($bibtex_file, $displayTypes, $groupType, $groupYear, '', $highlightName, $numbersDesc, $sorting, $authorLimit, '');
					$content .= $bibtex_content;
					$content .= '</div>';
				$page->setRawContent($content);
				}
            }
        }
    }
}