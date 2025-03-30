<?php
    function pridat_navigaciu(array $odkazy){
        $vystup = "";
        foreach($odkazy as $nazov_odkazu => $odkaz){
            $vystup .= '<li><a href="' . $odkaz . '" class="smoothScroll">' . $nazov_odkazu . '</a></li>';
        }
        return $vystup;
    }
?>