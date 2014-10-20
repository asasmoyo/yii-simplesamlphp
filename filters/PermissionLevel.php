<?php

/**
 * Description of PermissionLevel
 *
 * @author Arba
 */
class PermissionLevel extends CFilter {

    public $allowedPermissions = array();
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
