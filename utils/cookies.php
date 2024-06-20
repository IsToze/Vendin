<?php

function has_cookies_enabled()
{
    return isset($_SESSION['cookies_enabled']) && $_SESSION['cookies_enabled'] or isset($_COOKIE['enable-cookie']);
}

function active_cookies()
{
    setcookie('enable-cookie', True, time() + 30 * 24 * 3600);
}

function add_cookie($key, $value)
{ // 30 days
    setcookie($key, $value, time() + 30 * 24 * 3600);
}

function has_cookie($key)
{
    return isset($_COOKIE[$key]); // Can return null :
}

function get_cookie($key)
{
    return $_COOKIE[$key];
}