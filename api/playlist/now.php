<?php

include ("../domain/model.php");
//include_once("../config/dbconnect.inc.php");
/*
header('Access-Control-Allow-Origin: *');
$link = open_database_connection();
$nowPlayingQuery = "SELECT * FROM `now_playing` as n "
        . "inner join `logbook` as l on n.logbookID = l.logbookID "
        . "left outer join `show` as s on s.showID = l.showID "
        . "left outer join `show_hosts` as h on l.showID = h.showID";
$nowPlayingResult = mysql_query($nowPlayingQuery,$link) or die(mysql_error($link));
*/
//echo "fuck";
$song = get_most_recent_track();

//echo "<a onclick=\"loadNowPlaying()\"><b>" . $song['lb_track_name'] . "</b> by <b>" . $song['lb_artist_name'] . "</b></a>";
echo json_encode($song);
//echo $song;
//