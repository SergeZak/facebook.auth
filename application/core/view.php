<?php

class View
{

    function generate($content_view, $data = null, $template_view = 'template_view.php')
    {

        if(is_array($data)) {
            extract($data);
        }


        include 'application/views/'.$template_view;
    }
}