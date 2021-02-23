<?php


namespace App\Http\Controllers;


trait SessionTrait
{
    /**
     * Check Session Variable
     *
     * @param string $key
     * @return int|bool
     */
    public static function is_session($key)
    {
        $session = session($key);
        if (!$session) {
            return false;
        }

        return $session[0];
    }
}
