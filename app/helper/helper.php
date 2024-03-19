<?php


// get 페이지네이션
if (! function_exists("pagination2")) {

    function pagination2($write_pages, $total_page, $add="")
    {

        $qstr = $_SERVER['QUERY_STRING'];
        $cur_page = $_REQUEST['page'] ?? 1;

        if ($qstr != "") {
            $qstr = "";
            foreach ($_REQUEST as $key=>$val) {
                if ($key == "page") continue;
                if ($qstr != "") $qstr .= "&";
                if (is_array($val)) {
                    foreach ($val as $idx => $_val) {
                        if ($qstr != "") $qstr .= "&";
                        $arrayTypeStr = urlencode("[]");
                        $qstr .= "{$key}{$arrayTypeStr}={$_val}";
                    }
                } else {
                    $qstr .= "{$key}={$val}";
                }
            }
        }

        $pageAddress = explode("?", $_SERVER['REQUEST_URI'])[0];

//        $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $pageAddress . "?" . $qstr;
        $url = $pageAddress . "?" . $qstr;

        $str = '';
        if ($cur_page > 1) {
            $str .= "<a href='{$url}&page=1{$add}' class='pg_page pg_start'></a>".PHP_EOL;
        }

        $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;

        $end_page = $start_page + $write_pages - 1;

        if ($end_page >= $total_page) $end_page = $total_page;

        if ($cur_page > 1) {
            $cur_page_sub = $cur_page-1;
            $str .= "<a href='{$url}&page={$cur_page_sub}{$add}' class='pg_page pg_prev'></a>".PHP_EOL;
        }

        if ($total_page > 1) {
            for ($k=$start_page;$k<=$end_page;$k++) {
                if ($cur_page != $k)
                    $str .= '<a href="'.$url.'&page='.$k.$add.'" class="pg_page">'.$k.'<span class="sound_only"></span></a>'.PHP_EOL;
                else
                    $str .= '<span class="sound_only"></span><strong class="pg_current">'.$k.'</strong><span class="sound_only"></span>'.PHP_EOL;
            }
        }

        if ($total_page > $cur_page) $str .= '<a href="'.$url.'&page='.($cur_page+1).$add.'" class="pg_page pg_next"></a>'.PHP_EOL;

        if ($cur_page < $total_page) {
            $str .= '<a href="'.$url.'&page='.$total_page.$add.'" class="pg_page pg_end"></a>'.PHP_EOL;
        }

        if ($str)
            return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
        else
            return "";
    }

}
