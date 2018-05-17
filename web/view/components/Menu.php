<?php
include_once('Component.php');

class Menu extends Component {
    public function build(){
        return '<nav>'
                .'<h1>Menu</h1>'
                .'<a href="/web/home">Home</a>'
                .'<br/>'
                .'<a href="/web/param">Param</a>'
                .'</nav>';
    }
}
?>