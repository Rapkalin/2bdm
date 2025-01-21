<?php

/**
* Return images folder path
*/
function asset($path)
{
    echo bloginfo('template_directory') . '/images/' . $path;
}