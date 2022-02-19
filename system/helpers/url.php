<?php
    function linkCss($cssPath)
    {
        if(!empty($cssPath))
        {
            return "<link rel='stylesheet' href='/integrateChat/public/".$cssPath."'>";
        }
    }

    function linkJs($jsPath)
    {
        if(!empty($jsPath))
        {
            return "<script src='/integrateChat/public/".$jsPath."'></script>";
        }
    }
?>