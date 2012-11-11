<?php

/**
 * @author TheCelavi
 * @license http://www.runopencode.com/terms-and-conditions/free-for-all Free for all
 * @category Diem Validator
 * @version 1.0.0
 */
class dmValidatorSHValidateHighliteLines extends sfValidatorBase
{

    protected function configure($options = array(), $messages = array())
    {
        $this->addMessage('invalid', '"%value%" is not valid list of lines to highlight.');
    }

    protected function doClean($value)
    {
        $value = trim($value);
        if (strpos($value, ',')) {
            $arr = explode(',', $value);
            foreach ($arr as $el) {
                $el = trim($el);
                $clean = intval($el);
                if (strval($clean) != $el) {
                    throw new sfValidatorError($this, 'invalid', array('value' => $value));
                }
            }
            return implode(',', $arr);
        } elseif ($value != '') {
            $clean = intval($value);
            if (strval($clean) != $value) {
                throw new sfValidatorError($this, 'invalid', array('value' => $value));
            }
        } elseif ($this->getOption('required')) {
            throw new sfValidatorError($this, 'invalid', array('value' => $value));
        }
        return $value;
    }

}
