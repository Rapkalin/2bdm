<?php

/**
* Return images folder path
*/
function asset($path): string
{
    return get_template_directory_uri() . '/assets/images/' . $path;
}