<?php
/**
 * @author TheCelavi
 * @license http://www.runopencode.com/terms-and-conditions/free-for-all Free for all
 * @category Diem Front behaviors
 * @version 1.0.0
 */
class dmSyntaxHighlighterBehaviorView extends dmBehaviorBaseView
{
    protected $defaults;

    public function configure() {
        $this->addRequiredVar(array('syntax'));
        $this->defaults = sfConfig::get('dm_dmSyntaxHighlighterBehaviorPlugin_defaults');
    }

    protected function filterBehaviorVars(array $vars = array()) {
        $vars = parent::filterBehaviorVars($vars);
        $vars['brush'] = strtolower(implode(' ', $vars['syntax']));
        if (trim($vars['highlight']) != '') {
            $vars['highlight'] = sprintf('[%s]', $vars['highlight']);
        }
        return array_merge($this->defaults, $vars);
    }

    public function getJavascripts() {
        $vars = $this->getBehaviorVars();
        $brushes = array();
        foreach ($vars['syntax'] as $brush) {
            $brushes[] = 'dmSyntaxHighlighterBehaviorPlugin.' . $brush;
        }

        if ($vars['html_script']) {
            $brushes[] = 'dmSyntaxHighlighterBehaviorPlugin.Xml';
        }

        return array_merge(
            parent::getJavascripts(),
            array(
                'dmSyntaxHighlighterBehaviorPlugin.core',
            ),
            $brushes,
            array(
                'dmSyntaxHighlighterBehaviorPlugin.behavior'
            )
        );
    }

    public function getStylesheets() {
        $vars = $this->getBehaviorVars();
        return array_merge(
            parent::getStylesheets(),
            array(
                'dmSyntaxHighlighterBehaviorPlugin.core',
                'dmSyntaxHighlighterBehaviorPlugin.' . $vars['theme']
            )
        );
    }
}
