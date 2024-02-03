<?php
if(session_status()==1){
    session_start();
}

require_once "Controllers/CPrincipal.php";