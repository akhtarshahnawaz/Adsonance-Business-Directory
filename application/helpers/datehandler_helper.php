<?php



/*
* Gets Date in Format mm/dd/yy and returns Timestamp
*/

function createTimeStamp($date) {
    $timestamp=false;
    date_default_timezone_set('Asia/Kolkata');
    $date_array = explode("/",$date);
    if($date_array[0] && $date_array[1] && $date_array[2]){
        $timestamp = mktime(0,0,0,$date_array[0],$date_array[1],$date_array[2]);
    }
    return $timestamp;
}


/*
 * Takes date in format mm/dd/yyyy and returns in format dd.MonthName.yyyy
 * */


function dateToString($date){
    $months=array(
        '01'=>'Jan',
        '02'=>'Feb',
        '03'=>'Mar',
        '04'=>'Apr',
        '05'=>'May',
        '06'=>'Jun',
        '07'=>'Jul',
        '08'=>'Aug',
        '09'=>'Sep',
        '10'=>'Oct',
        '11'=>'Nov',
        '12'=>'Dec'
    );
    $date=explode('/',$date);
    $month=$months[$date[0]];
    $day=$date[1];
    $year=$date[2];

    return $day.' '.$month.' '.$year;
}


function stringToDate($dateString){
    $months=array(
        'Jan'=>'01',
        'Feb'=>'02',
        'Mar'=>'03',
        'Apr'=>'04',
        'May'=>'05',
        'Jun'=>'06',
        'Jul'=>'07',
        'Aug'=>'08',
        'Sep'=>'09',
        'Oct'=>'10',
        'Nov'=>'11',
        'Dec'=>'12'
    );
    $date=explode(" ",$dateString);
    $month=$months[$date[1]];
    $day=$date[0];
    $year=$date[2];

    return $month.'/'.$day.'/'.$year;
}



/*
 * Returns Today's Date in FORMAT: mm/dd/yyyy
 * */
function dateToday(){
    date_default_timezone_set('Asia/Kolkata');
    $ci=& get_instance();
    $ci->load->helper('date');
    $datestring = "%m/%d/%Y";
    $time = time();
    $date=mdate($datestring, $time);
    return $date;
}


/*
 * Returns Timestamp to Date in FORMAT: mm/dd/yyyy
 * */
function timestampToDate($timestamp){
    date_default_timezone_set('Asia/Kolkata');
    $ci=& get_instance();
    $ci->load->helper('date');
    $datestring = "%m/%d/%Y";
    $date=mdate($datestring, $timestamp);
    return $date;
}


/*
 * Returns Timestamp to Date in FORMAT: mm/dd/yyyy
 * */
function timestampToday(){
    date_default_timezone_set('Asia/Kolkata');
    return time();
}


/*
 * returns Gap Between Two Given Dates
 *
 * */

function dateGap($date1,$date2=null){
    if(!isset($date2)){
        $date2=dateToday();
    }
    $date1_array = explode("/",$date1);
    $date2_array = explode("/",$date2);
    $timestamp1 =
        mktime(0,0,0,$date1_array[0],$date1_array[1],$date1_array[2]);
    $timestamp2 =
        mktime(0,0,0,$date2_array[0],$date2_array[1],$date2_array[2]);
    if ($timestamp1>$timestamp2) {
        $gap=$timestamp1-$timestamp2;
        return timestampToDate($gap);
    } else if ($timestamp1<$timestamp2) {
        $gap=$timestamp2-$timestamp1;
        return timestampToDate($gap);
    } else {
        return 0;
    }
}




