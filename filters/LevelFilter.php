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
        $result = false;

        if (!empty(array_intersect($this->allowedLevels, $this->getSimplesamlphp()->level))) {
            $result = true;
        }

        return $result;
    }

    private function getSimplesamlphp() {
        $temp = $this->simplesamlphpComponentName;
        return Yii::app()->$temp;
    }

}
