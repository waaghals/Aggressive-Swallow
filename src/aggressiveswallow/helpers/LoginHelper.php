<?php
namespace Aggressiveswallow\Helpers;
use Aggressiveswallow\Tools\Container;

/**
 * Description of LoginHelper
 *
 * @author Patrick
 */
class LoginHelper {
    public static function isLoggedIn(){
        $sess = Container::make("session");
        /* @var $sess \Aggressiveswallow\Tools\Session */
        if($sess->has("isLoggedIn")){
            return $sess->isLoggedIn;
        }
        return false;
    }
}
