<?php
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet

    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //to check ip is pass from proxy

    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function days_in_month($month, $year)
{
// calculate number of days in a month 
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}
function getBrowser() {
    $versmatch = '(\);)?(\w*[\/|\s|-]\d+[\.\w]*(\s\[\w+\])?(\sMobile)?)?';
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $result = 'unknown';
    $checks = Array(
        'AOL' => 'AOL',
        'Avant Browser' => 'Avant Browser',
        'MSIE' => 'IE',
        'Chrome' => 'Chrome',
        'Navigator' => 'Netscape Navigator',
        'Iceweasel' => 'Iceweasel',
        'SeaMonkey' => 'SeaMonkey',
        'Firefox' => 'Firefox',
        'Safari' => 'Version Safari',
        'Nintendo Wii' => 'Opera',
        'Opera' => 'Opera',
        'Firebird' => 'Firebird',
        'Kazehakase' => 'Kazehakase',
        'Iceape' => 'Iceape',
        'Phoenix' => 'Phoenix',
        'Playstation 3' => 'Playstation 3',
        'PSP' => 'Playstation Portable',
        'Googlebot' => 'Googlebot',
        'msnbot' => 'msnbot-Products msnbot',
        'Yahoo! Slurp China' => 'Yahoo! Slurp China',
        'Yahoo! Slurp' => 'Yahoo! Slurp',
        'Ask Jeeves' => 'Ask Jeeves',
        'Cuil' => 'Twiceler',
        'Mozilla' => 'Mozilla',
        'BlackBerry' => 'BlackBerry'
    );

    foreach($checks as $key => $check) {
        if(preg_match('/(' . $check . ')/', $agent) > 0) {
            preg_match('/' . $key . $versmatch . '/', $agent, $matches);
            $result = str_replace('-', ' ', str_replace(');', '', str_replace('/', ' ', $matches[0])));
            switch($check) {
                case 'Safari':
                    return str_replace($result, 'Version', 'Safari');
                    break;
                case 'Navigator':
                    return str_replace($result, 'Navigator', 'Netscape');
                    break;
                case 'msnbot':
                    return str_replace(str_replace($result, 'Products', ''), 'msnbot', 'Windows Live');
                    break;
                case 'Cuil':
                    return str_replace($result, 'Twiceler', 'Cuil');
                    break;
                case 'Nintendo Wii':
                    return str_replace($result, 'Opera', 'Nintendo Wii (Opera)');
                    break;
                case 'BlackBerry':
                    return str_replace($result, 'BlackBerry', 'BlackBerry ');
                    break;
            }
            return $result;
        }
    }
}
function getOS() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    // Create list of operating systems with operating system name as array key
    $oses = array (
        'iPhone' => '(iPhone)',
        'Windows 3.11' => 'Win16',
        'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
        'Windows 98' => '(Windows 98)|(Win98)',
        'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
        'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
        'Windows 2003' => '(Windows NT 5.2)',
        'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
        'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
        'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        'Windows ME' => 'Windows ME',
        'Open BSD'=>'OpenBSD',
        'Sun OS'=>'SunOS',
        'Linux'=>'(Linux)|(X11)',
        'Safari' => '(Safari)',
        'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
        'QNX'=>'QNX',
        'BeOS'=>'BeOS',
        'OS/2'=>'OS/2',
        'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
    );

    foreach($oses as $os=>$pattern){ // Loop through $oses array
        // Use regular expressions to check operating system type
        if(empty($pattern))continue;
        if(@preg_match("/$pattern/i", $userAgent)) { // Check if a value in $oses array matches current user agent.
            return $os; // Operating system was matched so return $oses key
        }
    }
    return 'Unknown'; // Cannot find operating system so return Unknown
}






function upload($file_id, $folder = "", $types = "")
{
    if (!$_FILES[$file_id]['name'])
        return array('', 'لا يوجد ملفات ');
    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = explode(".", basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr) - 1]);
    //Get the last extension
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(), 1)), 0, 5);
    $file_title = md5($uniqer . "eslamahmedkandelmostafs" . time() . md5("eslamahmedkandelTworld"));
    $file_title = substr($file_title, 4, 9) . "." . $ext;
    $file_name = $uniqer . '_' . $file_title;
    //Get Unique Name
    $all_types = explode(",", strtolower($types));
    if ($types)
    {
        if (in_array($ext, $all_types))
            ;
        else
        {
            $result = "'" . $_FILES[$file_id]['name'] . "' هذا الملف غير صالح ";
            //Show error if any.
            return array('', $result);
        }
    } //Where the file must be uploaded to
    if ($folder)
        $folder .= '/';
    //Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;
    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile))
    {
        $result = "لا يمكن رفع هذا الملف'" . $_FILES[$file_id]['name'] . "'";
        //Show error if any.
        if (!file_exists($folder))
        {
            $result .= " : الفولدر غير موجود";
        } elseif (!is_writable($folder))
        {
            $result .= " : الفولدر غير قابل للكتابة ";
        } elseif (!is_writable($uploadfile))
        {
            $result .= " : الملف غير قابل للكتابة ";
        }
        $file_name = '';
    } else
    {
        if (!$_FILES[$file_id]['size'])
        {
            //Check if the file is made
            @unlink($uploadfile);
            //Delete the Empty file
            $file_name = '';
            $result = "الملف ليس به اى بيانات من فضلك ارفع  ملف به بيانات ";
            //Show the error message
        } else
        {
            chmod($uploadfile, 0777); //Make it universally writable.
        }
    }
    return array($file_name, $result);
}

function scanDirectories($rootDir)
{
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    $allData = array();
    // file counter gets incremented for a better
    $fileCounter = 0;
    foreach ($dirContent as $key => $content)
    {
        // filter all files not accessible
        $path = $rootDir . '/' . $content;
        if (!in_array($content, $invisibleFileNames))
        {
            // if content is file & readable, add to array
            if (is_file($path) && is_readable($path))
            {
                $tmpPathArray = explode("/", $path);
                // saving filename
                $allData[$fileCounter]['fileName'] = end($tmpPathArray);
                // saving while path (for better access)
                $allData[$fileCounter]['filePath'] = $path;
                // get file extension
                $filePartsTmp = explode(".", end($tmpPathArray));
                $allData[$fileCounter]['fileExt'] = end($filePartsTmp);
                // get file date
                $allData[$fileCounter]['fileDate'] = filectime($path);
                // get filesize in byte
                $allData[$fileCounter]['fileSize'] = filesize($path);
                $fileCounter++;
                // if content is a directory and readable, add path and name
            } elseif (is_dir($path) && is_readable($path))
            {
                $dirNameArray = explode('/', $path);
                $allData[$path]['dirPath'] = $path;
                $allData[$path]['dirName'] = end($dirNameArray);
                // recursive callback to open new directory
                $allData[$path]['content'] = scanDirectories($path);
            }
        }
    }
    return $allData;
}
if (!function_exists('mime_content_type'))
{
    function mime_content_type($filename)
    {
        $mime_types = array( // images
            'png' => 'image/png', 'jpe' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'jpg' =>
            'image/jpeg', 'gif' => 'image/gif', 'bmp' => 'image/bmp', 'ico' =>
            'image/vnd.microsoft.icon', 'tiff' => 'image/tiff', 'tif' => 'image/tiff', 'svg' =>
            'image/svg+xml', 'svgz' => 'image/svg+xml', );
        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types))
        {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open'))
        {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else
        {
            return 'application/octet-stream';
        }
    }
}
function Tworld_size_type($size)
{
    $types = array("B", "KB", "MB", "GB");
    for ($i = 0; $size > 1000; $i++, $size /= 1024)
        ;
    $result['value'] = round($size, 2);
    $result['type'] = $types[$i];
    return $result;
}

function isValidURL($url)
{
   return filter_var($url, FILTER_VALIDATE_URL);
}





function makerandomkeys($overview, $keysnum = 20)
{
    $overview = strip_tags($overview);
    $overview = stripcslashes($overview);
    $overview = str_replace("&nbsp;", "", $overview);
    $words = explode(' ', $overview);
    $words = array_unique($words);
    shuffle($words);
    $words = implode(',', array_slice($words, 0, $keysnum));
    $words = str_replace(" ", "", $words);
    $words = str_replace(chr(13), "", $words);
    $words = str_replace("\\n", "", $words);
    return $words;
}
function makedesc($overview)
{
    $overview = strip_tags($overview);
    $overview = stripcslashes($overview);
    $overview = str_replace("&nbsp;", "", $overview);
    $overview = str_replace(chr(13), "", $overview);
    return substr($overview, 0, 300);
}
function just_clean($string)
{
    // Replace other special chars
    $specialCharacters = array('#' => '', '$' => '', '%' => '', '&' => '', '@' => '',
        '?' => '', '.' => '', '+' => '', '=' => '', '\\' => '', '/' => '');
    while (list($character, $replacement) = each($specialCharacters))
    {
        $string = str_replace($character, '-' . $replacement . '-', $string);
    }
    // Remove all remaining other unknown characters
    //$string = preg_replace('/[^a-zA-Z0-9-]/', ' ', $string);
    $string = preg_replace('/^[-]+/', '', $string);
    $string = preg_replace('/[-]+$/', '', $string);
    $string = preg_replace('/[-]{2,}/', ' ', $string);
    return $string;
}
function maketitleforurl($title)
{
    $title = strip_tags($title);
    $title = stripcslashes($title);
    $title = htmlspecialchars($title);
    // Prev to protect our url
    $title = just_clean($title);
    $title = str_replace(" ", "-", $title);
    return $title;
}
function time_since($tm, $rcs = 0)
{
    $tm = intval($tm);
    if (empty($tm))
        return "غير محدد";
    $cur_tm = time();
    $dif = $cur_tm - $tm;
    $pds = array('ثانية', 'دقيقة', 'ساعة', 'يوم', 'اسبوع', 'شهر', 'سنة', 'عقد');
    $lngh = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
    for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--)
        ;
    if ($v < 0)
        $v = 0;
    $_tm = $cur_tm - ($dif % $lngh[$v]);
    $no = floor($no);
    if ($no <> 1)
        $pds[$v] .= '';
    $x = sprintf("%d %s ", $no, $pds[$v]);
    if (($rcs == 1) && ($v >= 1) && (($cur_tm - $_tm) > 0))
        $x .= time_ago($_tm);
    return $x;
}
//online
function curPageURL()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
if(!function_exists("multiRequest")){
 function multiRequest($data, $options = array())
    {
                  // array of curl handles
            $curly = array();
            // data to be returned
            $result = array();
            // multi handle
            $mh = curl_multi_init();
            // loop through $data and create curl handles
            // then add them to the multi-handle
            foreach ($data as $id => $d) {
                $curly[$id] = curl_init();
                $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
                curl_setopt($curly[$id], CURLOPT_URL, $url);
                curl_setopt($curly[$id], CURLOPT_HEADER, 0);
                curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curly[$id], CURLOPT_TIMEOUT, 30);
                // post?
                if (is_array($d)) {
                    if (!empty($d['post'])) {
                        curl_setopt($curly[$id], CURLOPT_POST, 1);
                        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
                    }
                }
                // extra options?
                if (!empty($options)) {
                    curl_setopt_array($curly[$id], $options);
                }
                curl_multi_add_handle($mh, $curly[$id]);
            }
            // execute the handles
            $running = null;
            do {
                curl_multi_exec($mh, $running);
            } while ($running > 0);
            // get content and remove handles
            foreach ($curly as $id => $c) {
                $datafrom = curl_multi_getcontent($c);
                if (curl_errno($c)) {
                    $result[$id] = 'Curl error: ' . curl_error($c);
                } else {
                    $result[$id] = $datafrom;
                }
                curl_multi_remove_handle($mh, $c);
            }
            // all done
            curl_multi_close($mh);
            return $result;
            }
            }
function check_email_address($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}



function filtersmall($number)
{
    $arFliterTospace = array("/[^0-9]/i","/^0*/i","/^\+*/i","/^966/i","/^20/i","/^0*/i","/^\+*/i");
    $orginalNumber = $number;
    $number = preg_replace($arFliterTospace, "", $number);
    /*Remove more than 13 and less than 8 */
    if (strlen($number) < 9 || strlen($number) > 13)
    {
        return false;
    }
    if (strlen($number) >= 9 && strlen($number) <= 10)
    {
        if (preg_match('/^1/i', $number))
            $number = "20" . $number;
        /* for egypt*/
        if (preg_match('/^5/i', $number))
            $number = "966" . $number;
        /* for sa*/
    }
    /* now remove numbers less than 13*/
    if (strlen($number) < 10)
    {
        return false;
    }
    if(preg_match("/^966/",$number) && strlen($number)>12){
        return false;
    }
    if(preg_match("/^966/",$orginalNumber) && !preg_match("/^966/",$number)){
        return false;
    }

    if(preg_match("/^20/",$number) && strlen($number)!=12){
        return false;
    }
    if(preg_match("/^20/",$orginalNumber) && !preg_match("/^20/",$number)){
        return false;
    }
    return $number;
}
?>