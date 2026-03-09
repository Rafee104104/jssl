<?php
/*
 * mysql_* compatibility for legacy code running on PHP 7/8.
 * Uses a shared mysqli connection stored in $GLOBALS['conn'].
 */

if (!function_exists('mysql_connect')) {
    function mysql_connect($host = 'localhost', $user = '', $pass = '')
    {
        $link = mysqli_connect($host, $user, $pass);
        if ($link) {
            $GLOBALS['conn'] = $link;
        }
        return $link;
    }
}

if (!function_exists('_mysql_compat_link')) {
    function _mysql_compat_link($link = null)
    {
        if ($link) {
            return $link;
        }
        return isset($GLOBALS['conn']) ? $GLOBALS['conn'] : null;
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($db, $link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_select_db($link, $db) : false;
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_query($link, $query) : false;
    }
}

if (!function_exists('mysql_fetch_object')) {
    function mysql_fetch_object($result)
    {
        return mysqli_fetch_object($result);
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, $mode = MYSQLI_BOTH)
    {
        return mysqli_fetch_array($result, $mode);
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result)
    {
        return mysqli_fetch_row($result);
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result)
    {
        return mysqli_num_rows($result);
    }
}

if (!function_exists('mysql_num_fields')) {
    function mysql_num_fields($result)
    {
        return mysqli_num_fields($result);
    }
}

if (!function_exists('mysql_field_name')) {
    function mysql_field_name($result, $fieldOffset)
    {
        $meta = mysqli_fetch_field_direct($result, (int)$fieldOffset);
        return $meta ? $meta->name : false;
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, $rowNumber)
    {
        return mysqli_data_seek($result, (int)$rowNumber);
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_insert_id($link) : 0;
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_affected_rows($link) : -1;
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($string, $link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_real_escape_string($link, $string) : addslashes($string);
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_error($link) : '';
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close($link = null)
    {
        $link = _mysql_compat_link($link);
        return $link ? mysqli_close($link) : false;
    }
}

if (!function_exists('mysql_result')) {
    function mysql_result($result, $row = 0, $field = 0)
    {
        if (!mysqli_data_seek($result, (int)$row)) {
            return false;
        }
        $data = mysqli_fetch_array($result, MYSQLI_BOTH);
        if (!is_array($data)) {
            return false;
        }
        return isset($data[$field]) ? $data[$field] : false;
    }
}
