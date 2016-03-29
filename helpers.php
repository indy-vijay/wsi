<?php

function getFileNameWithoutExtension($fileNameWithPath)
{
    $info = pathinfo($fileNameWithPath);
    return basename($fileNameWithPath, '.' . $info['extension']);
}
