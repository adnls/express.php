<?php

class BreadCrumbs extends Component {
    public function build() {
        //pas besoin de faire appel au router pour avoir l'url
        // pas besoin de logique, si on arrive la, elle est forcement juste
        $url = $_GET['url']; 
        return '<h1>'.$url.'</h1>';
    }
}

?>