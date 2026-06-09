<?php
// util.php

function br() {
    echo("\n\n<br/><br/>\n\n");
}

function sha256($value)
{
    return hash('sha256', $value);
}