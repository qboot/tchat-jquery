<?php

session_start();

if(isset($_SESSION['user'])) {
    echo "Success";
    return;
} else {
    echo "Failed";
    return;
}