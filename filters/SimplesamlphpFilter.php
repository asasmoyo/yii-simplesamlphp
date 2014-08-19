<?php

/**
 * Description of SimplesamlphpFilter
 *
 * @author Arba
 */
class SimplesamlphpFilter extends CFilter {

    public $permission = '';

    protected function preFilter($filterChain) {
        if ($this->permission != 'tes')
            return true;
        return false;
    }

}
