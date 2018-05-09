<?php
class Session {
    public function start(){
        if (!isset($_SESSION)) session_start();
    }

    public function destroy(){
        if (isset($_SESSION)) session_destroy();
    }
}
?>