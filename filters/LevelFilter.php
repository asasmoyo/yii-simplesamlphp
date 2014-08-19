<?php

/**
 * Description of LevelFilter
 *
 * @author Arba
 */
class LevelFilter extends CFilter {

    public $allowedLevels = null;
    public $simplesamlphpComponentName = null;

    protected function preFilter($filterChain) {
        $this->checkProperties();
        
        
    }

    private function checkProperties() {
        if ($this->simplesamlphpComponentName == null)
            throw new CException('Property simplesamlphpComponentName belum diset.');

        if (!is_array($this->allowedLevels))
            throw new CException('Property allowedLevels harus array.');
    }

    private function getSimplesamlphp() {
        $temp = $this->simplesamlphpComponentName;
        return Yii::app()->$temp;
    }

}
