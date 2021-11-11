<?php
    function linkCss($cssPath)
    {
        if(!empty($cssPath))
        {
            return "<link rel='stylesheet' href='/dashboard/public/".$cssPath."'>";
        }
    }

    function linkJs($jsPath)
    {
        if(!empty($jsPath))
        {
            return "<script src='/dashboard/public/".$jsPath."'></script>";
        }
    }
?>