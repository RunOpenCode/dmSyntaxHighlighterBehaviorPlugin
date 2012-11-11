<?php

/**
 * @author TheCelavi
 * @license http://www.runopencode.com/terms-and-conditions/free-for-all Free for all
 * @category Diem Extended Front behaviors
 * @version 1.0.0
 */
class dmSyntaxHighlighterBehaviorForm extends dmBehaviorBaseForm
{

    protected $theme = array(
        'Default' => 'Default',
        'Django' => 'Django',
        'Eclipse' => 'Eclipse',
        'Emacs' => 'Emacs',
        'FateToGrey' => 'Fade to grey',
        'MDUltra' => 'Midnight ultra',
        'Midnight' => 'Midnight',
        'RDark' => 'RDark'
    );
    protected $syntax = array(
        'AS3' => 'ActionScript 3',
        'AppleScript' => 'AppleScript',
        'Bash' => 'Bash',
        'CSharp' => 'C#',
        'ColdFusion' => 'ColdFusion',
        'Cpp' => 'C++',
        'Css' => 'CSS',
        'Delphi' => 'Delphi',
        'Diff' => 'Diff',
        'Erlang' => 'Erlang',
        'Groovy' => 'Groovy',
        'JScript' => 'Java Script',
        'Java' => 'Java',
        'JavaFX' => 'Java FX',
        'Perl' => 'Perl',
        'Php' => 'PHP',
        'Plain' => 'Plain',
        'PowerShell' => 'PowerShell',
        'Python' => 'Python',
        'Ruby' => 'Ruby',
        'Sass' => 'Sass',
        'Scala' => 'Scala',
        'Sql' => 'SQL',
        'Vb' => 'Visual Basic',
        'Xml' => 'XML'
    );

    public function configure()
    {
        $this->widgetSchema['inner_target'] = new sfWidgetFormInputText();
        $this->validatorSchema['inner_target'] = new sfValidatorString(array(
                'required' => false
            ));

        $this->widgetSchema['theme'] = new sfWidgetFormChoice(array(
                'choices' => $this->getI18n()->translateArray($this->theme)
            ));
        $this->validatorSchema['theme'] = new sfValidatorChoice(array(
                'choices' => array_keys($this->theme)
            ));

        $this->widgetSchema['syntax'] = new sfWidgetFormChoice(array(
                'choices' => $this->getI18n()->translateArray($this->syntax),
                'multiple' => true,
                'expanded' => false
            ));
        $this->validatorSchema['syntax'] = new sfValidatorChoice(array(
                'choices' => array_keys($this->syntax),
                'multiple' => true,
                'min' => 1
            ));

        $this->widgetSchema['gutter'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['gutter'] = new sfValidatorBoolean();

        $this->widgetSchema['auto_links'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['auto_links'] = new sfValidatorBoolean();

        $this->widgetSchema['collapse'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['collapse'] = new sfValidatorBoolean();

        $this->widgetSchema['first_line'] = new sfWidgetFormInputText();
        $this->validatorSchema['first_line'] = new sfValidatorInteger(array(
                'min' => 1
            ));

        $this->widgetSchema['highlight'] = new sfWidgetFormInputText();
        $this->validatorSchema['highlight'] = new dmValidatorSHValidateHighliteLines(array(
                'required' => false
            ));

        $this->widgetSchema['html_script'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['html_script'] = new sfValidatorBoolean();

        $this->widgetSchema['smart_tabs'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['smart_tabs'] = new sfValidatorBoolean();

        $this->widgetSchema['tab_size'] = new sfWidgetFormInputText();
        $this->validatorSchema['tab_size'] = new sfValidatorInteger(array(
                'min' => 1
            ));

        $this->widgetSchema['toolbar'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['toolbar'] = new sfValidatorBoolean();

        $this->getWidgetSchema()->setHelps(array(
            'theme' => 'Display theme',
            'syntax' => 'Language syntax to highlight',
            'gutter' => 'Turn off or on gutter with line numbers',
            'auto_links' => 'Detection of links in the highlighted element',
            'colapse' => 'Force highlighted elements on the page to be collapsed by default',
            'first_line' => 'First (starting) line number',
            'highlight' => 'Lines to highlight, if any, separated with comma (,) for more than one',
            'html_script' => 'Highlight a mixture of HTML/XML code and a script',
            'smart_tabs' => 'Turn off or on smart tabs feature',
            'tab_size' => 'Adjust tab size',
            'toolbar' => 'Turn off or on toolbar'
        ));

        $defaults = sfConfig::get('dm_dmSyntaxHighlighterBehaviorPlugin_defaults');

        if (!$this->getDefault('theme')) {
            $this->setDefault('theme', $defaults['theme']);
        }
        if (!$this->getDefault('syntax')) {
            $this->setDefault('syntax', array('Php'));
        }
        if (!$this->getDefault('gutter')) {
            $this->setDefault('gutter', $defaults['gutter']);
        }
        if (!$this->getDefault('auto_links')) {
            $this->setDefault('auto_links', $defaults['auto_links']);
        }
        if (!$this->getDefault('collapse')) {
            $this->setDefault('collapse', $defaults['collapse']);
        }
        if (!$this->getDefault('first_line')) {
            $this->setDefault('first_line', $defaults['first_line']);
        }
        if (!$this->getDefault('highlight')) {
            $this->setDefault('highlight', $defaults['highlight']);
        }
        if (!$this->getDefault('html_script')) {
            $this->setDefault('html_script', $defaults['html_script']);
        }
        if (!$this->getDefault('smart_tabs')) {
            $this->setDefault('smart_tabs', $defaults['smart_tabs']);
        }
        if (!$this->getDefault('tab_size')) {
            $this->setDefault('tab_size', $defaults['tab_size']);
        }
        if (!$this->getDefault('toolbar')) {
            $this->setDefault('toolbar', $defaults['toolbar']);
        }

        parent::configure();
    }

}
