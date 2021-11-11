<?php
function anchor($href, $value, $option=array())
{
    if(isset($option))
    {
        if (array_key_exists('class', $option))
        {
            $class = $option['class'];
        }
        else
        {
            $class = null;
        }

        if (array_key_exists('id', $option))
        {
            $id = $option['id'];
        }
        else
        {
            $id = null;
        }
    }

    else
    {
        $id = null;
        $class = null;
    }


    $url = BASE_URL.$href;

    return "<a href='".$url."' class='".$class."' id='".$id."'>$value</a>";
}

function anchorVoid($href, $value, $option=array())
{
    if(isset($option))
    {
        if (array_key_exists('class', $option))
        {
            $class = $option['class'];
        }
        else
        {
            $class = null;
        }

        if (array_key_exists('id', $option))
        {
            $id = $option['id'];
        }
        else
        {
            $id = null;
        }
    }

    else
    {
        $id = null;
        $class = null;
    }


    $url = $href;

    return "<a href='".$url."' class='".$class."' id='".$id."'>$value</a>";
}
?>