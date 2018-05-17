<?php
class Table extends Component {
    private $array;
    public function __construct($array){
        $this->array = $array;
    }
    public function build() {
        return '<script type="text/javascript" src="/web/static/javascript/createTable.js"></script>'
                .'<script>var data='.json_encode($this->array).';createTable(data);</script>';
    }
}
?>