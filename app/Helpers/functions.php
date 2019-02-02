<?php

/**
 * @param $date
 * @return null
 */
function defaultDateFormat($date) {
    return $date ? $date->format('Y-m-d') : null;
}

/**
 * Return nav-here if current path begins with this path.
 *
 * @param string $path
 * @return string
 */
function setActive($path)
{
    return Request::is($path . '*');
}
