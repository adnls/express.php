<?php
include_once('Component.php');

class Menu extends Component {
    public function build(){
        return '<nav>'
                .'<h1>Menu</h1>'
                .'<a href="/work/home">Home</a>'
                .'<br/>'
                .'<a href="/work/param/random">Param</a>'
                .'</nav>';
    }
}
?>