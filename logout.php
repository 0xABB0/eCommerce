<?php
require_once 'functions.php';
session_start();
logout();
header('Location: index.php');