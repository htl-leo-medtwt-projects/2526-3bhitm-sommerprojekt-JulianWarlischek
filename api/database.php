<?php
session_start();

$_db_host = 'db_server';
$_db_username = 'so26';
$_db_password = 'projekt';
$_db_datenbank = 'so26';

$conn = new mysqli($_db_host, $_db_username, $_db_password, $_db_datenbank);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}