<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT System</title>
    <!-- Argon and Bootstrap CSS -->
    <link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/argon.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar or Navbar could go here if needed -->
