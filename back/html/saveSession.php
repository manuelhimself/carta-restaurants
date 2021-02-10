<?php
if (isset($_REQUEST['id'])) {
    $_SESSION['establiment'] = $_REQUEST['id'];
} else {
    die();
}