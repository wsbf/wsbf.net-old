<?php

/*
 * returns charts as json
 */

require_once("../domain/model.php");
require_once("album.php");
require_once("chart.php");

$week_end = mysql_real_escape_string(htmlentities($_GET['week_end']))/1000;
$prev_week_start = mysql_real_escape_string(htmlentities($_GET['prev_week_start']))/1000;

$this_week_charts = get_chart_for_week(date("Y-m-d H:i:s", $week_start), date("Y-m-d H:i:s", $week_end));

$last_week_charts = get_chart_for_week(date("Y-m-d H:i:s", $prev_week_start), date("Y-m-d H:i:s", $week_start));

$lastWeek = new Chart($prev_week_start, $week_start);

while ($row = mysql_fetch_array($last_week_charts, MYSQL_ASSOC)) {
    if (validAlbumNo($row['lb_album_code'])) {
        if ($lastWeek->hasAlbumID($row['lb_album_code'])) {
            $lastWeek->getAlbum($row['lb_album_code'])->again();
        } else{
            $lastWeek->addAlbum(new Album($row['lb_album_code'], $row['lb_album'], $row['lb_artist'], $row['lb_label']));
        }
    }
}

$thisWeekChart = new Chart($week_start, $week_end);
/** Fill out albums for THIS week, they are objects * */
while ($row = mysql_fetch_array($this_week_charts, MYSQL_ASSOC)) {
    if (validAlbumNo($row['lb_album_code'])) {
        if ($thisWeekChart->hasAlbumID($row['lb_album_code'])) {
            $thisWeekChart->getAlbum($row['lb_album_code'])->again();
        } else {
            $thisWeekChart->addAlbum(new Album($row['lb_album_code'], $row['lb_album'], $row['lb_artist'], $row['lb_label']));
        }
    }
}

$lastWeek->sorter('compare');
$thisWeekChart->sorter('compare');

/* Determine rank differences */

$thisWeekChart->determineRank();
$lastWeek->determineRank();
$thisWeekChart->determineChange($lastWeek->getAlbumArray());


$albums = $thisWeekChart->getAlbumArray();

if($albums){
    echo json_encode($albums);
}else{
    //echo "here";
    //Hope this never happens. It shouldn't if passed the right inputs
    $err = array();
    $err["error"]=  "1";
    $err["message"]= "Error occurred! could not retrieve chart";
    echo json_encode($err);
}
