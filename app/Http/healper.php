<?php

function fileUpload($path, $file)
{
    $extention = strtolower($file->getClientOriginalExtension());
    $name = time() . rand(100, 999) . '.' . $extention;
    return $file->move($path, $name);
}

function fileDelete($file)
{
    if (file_exists($file)) {
        unlink($file);
    }
}
