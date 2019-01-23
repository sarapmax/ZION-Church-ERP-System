<?php

/**
 * @param $date
 * @return null
 */
function defaultDateFormat($date) {
    return $date ? $date->format('Y-m-d') : null;
}
