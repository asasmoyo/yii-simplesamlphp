<?php

class SSOUserIdentity extends CUserIdentity {

    public function authenticate() {
        return true;
    }

}
