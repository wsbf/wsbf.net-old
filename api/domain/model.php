<?php

// model.php
function open_database_connection() {
    //$link = mysql_connect ( 'wsbf.net', 'logbook', 'TrNWKbDb7un45nTx' );
    //mysql_select_db ( 'wsbf', $link );
    //$link = mysql_connect('localhost', 'logbook', '');
    $link = mysql_connect('localhost', 'logbook', 'BFASwNamuH3KZ8Rs');
    mysql_select_db('wsbf', $link);
    if (!$link)
        die(mysql_error());
    return $link;
}

function close_database_connection($link) {
    mysql_close($link);
}

function get_history_query() {
    $link = open_database_connection();
    if ($link)
        echo("Link looks good!");
    else
        echo("Wont you fucking kill yourself?");
    $history_result = mysql_query("SELECT * from wsbf.`history`", $link) or die("fucking kill yourslef" . mysql_error($link));
    close_database_connection($link);
    return $history_result;
}

function get_senior_staff_query() {
    $link = open_database_connection();
    $senior_staff_result = mysql_query("SELECT def_positions.position, def_positions.description,
			users.first_name, users.last_name
			FROM wsbf.def_positions, wsbf.staff, wsbf.users
			WHERE def_positions.positionID <=9
			AND NOW( ) > staff.start_date AND NOW( ) < staff.end_date
			AND def_positions.positionID = staff.positionID
			AND staff.username = users.username
			ORDER BY def_positions.positionID ASC
			LIMIT 0 , 10", $link) or die(mysql_error($link));
    close_database_connection($link);
    return $senior_staff_result;
}

function get_staff_query() {
    $link = open_database_connection();
    $staff_result = mysql_query("SELECT u.first_name, u.last_name, t.team
                         		 FROM users u, def_teams t
                         		 WHERE statusID = 0 AND u.teamID = t.teamID
                         		 ORDER BY t.teamID DESC", $link) or die(mysql_error($link));
    close_database_connection($link);
    return $staff_result;
}

function get_chart_for_week($startlimit, $endlimit) {
    $link = open_database_connection();
    $chart_week_query = sprintf("SELECT logbook.logbookID, logbook.lb_album_code, logbook.lb_album, logbook.lb_artist, logbook.lb_label FROM `logbook`, `show`
	      								WHERE logbook.showID = show.showID AND show.end_time < '%s' AND show.start_time > '%s'
	      								AND lb_album_code != '' ORDER BY logbookID DESC", $endlimit, $startlimit);
    $chart_week_result = mysql_query($chart_week_query) or die(mysql_error($link));
    
    close_database_connection($link);
    return $chart_week_result;
}

function get_library_rotations() {
    $link = open_database_connection();
    $library_rotation_result = mysql_query("SELECT * FROM `def_rotations` where rotationID != 0 ORDER BY rotationID ASC", $link) or die(mysql_error($link));
    close_database_connection($link);
    return $library_rotation_result;
}

function get_library_genres() {
    $link = open_database_connection();
    $library_rotation_result = mysql_query("SELECT * from def_general_genres ORDER BY general_genreID ASC", $link) or die(mysql_error($link));
    close_database_connection($link);
    return $library_rotation_result;
}

function get_library_query($genre, $rotation) {
    $link = open_database_connection();
    // Form Query for getting albums in rotation currently. We're omitting To Be Reviewed for embarrassment's sake
    // Add in ordering by rotationID AScending.
    $library_query = "SELECT libartist.artist_name, libalbum.album_name, liblabel.label, def_rotations.rotation_bin, def_general_genres.genre
			 FROM `libalbum`, `libartist`, `liblabel`, `def_rotations`, `def_general_genres`
			 WHERE libalbum.artistID = libartist.artistID AND libalbum.labelID = liblabel.labelID
			 AND libalbum.rotationID = def_rotations.rotationID AND libalbum.general_genreID = def_general_genres.general_genreID AND libalbum.rotationID > 0 AND libalbum.rotationID < 7
			 AND libalbum.rotationID <> 5";

    if ($genre != "")
        $library_query .= sprintf(" AND def_general_genres.general_genreID = %d", genre);
    if ($rotation != "")
        $library_query .= sprintf("AND def_rotations.rotationID = %d", rotation);
    $library_query .= " ORDER BY libalbum.rotationID ASC;";
    $library_result = mysql_query($library_query, $link) or die(mysql_error($link));
    close_database_connection($link);
    return $library_result;
}

function get_schedule_week_query() {
    $link = open_database_connection();
    $schedule_result = mysql_query("SELECT users.username, users.preferred_name, schedule.scheduleID,
								schedule_hosts.schedule_alias, schedule.show_name,
								schedule.dayID, schedule.start_time, schedule.end_time,
								schedule.genre, schedule.show_typeID, def_show_types.type
								FROM `users`, `schedule`, `schedule_hosts`, `def_show_types`
								WHERE schedule.active = 1
								AND schedule_hosts.scheduleID = schedule.scheduleID
								AND def_show_types.show_typeID = schedule.show_typeID
								AND users.username = schedule_hosts.username", $link) or die(mysql_error($link));
    close_database_connection($link);
    return $schedule_result;
}
/**
 * Returns an array of the schedule for a particular day.
 * if no day is specified, it returns an array of the entire schedule for the week
 * day is from 0 to 6 representing sunday to saturday e.g.  Sunday is 0, Monday is 1, ..., Saturday = 6
 */
function get_schedule($day) {
    $link = open_database_connection();
    
/*
    select 
    s.scheduleID, s.show_name, s.description, s.start_time, s.end_time, 
    s.show_typeID, CONCAT('[', GROUP_CONCAT(CONCAT('"',IFNULL(h.schedule_alias, u.preferred_name),'"')),']') preferred_name, GROUP_CONCAT(u.username) usernames

    from `schedule` as s 
    inner join `def_days` as d on s.dayID = d.dayID 
    inner join `schedule_hosts` as h on s.scheduleID = h.scheduleID 
    inner join users as u on u.username=h.username WHERE s.active=1 AND s.dayID=2

    GROUP BY s.scheduleID, s.show_name, s.description, s.start_time, s.end_time, 
    s.show_typeID

    ORDER BY 
    s.start_time AS

*/


    $query = "select * from `schedule` as s inner join `def_days` as d on s.dayID = d.dayID "
            . "inner join `schedule_hosts` as h on s.scheduleID = h.scheduleID "
            . "inner join users as u on u.username=h.username WHERE s.active=1";
    
    if($day !=-1){
        $query = "select * from `schedule` as s inner join `def_days` as d on s.dayID = d.dayID "
            . "inner join `schedule_hosts` as h on s.scheduleID = h.scheduleID "
            . "inner join users as u on u.username=h.username WHERE s.active=1 AND s.dayID=".$day;
    }
    
    $schedule_result = mysql_query($query, $link) or die(mysql_error($link));
    
    if ($schedule_result) {
        $schedule = array();
        while ($s = mysql_fetch_assoc($schedule_result)) {
            $schedule[] = $s;
        }
        //echo "got schedule";
        close_database_connection($link);
        return $schedule;
    }
    
    close_database_connection($link);
    return $schedule_result;
}

function get_schedule_tab_query($tab) {
    $link = open_database_connection();
    $schedule_query = sprintf("SELECT schedule.scheduleID, schedule.show_name, schedule.description, schedule.start_time, schedule.end_time, 
							  	 	  schedule.show_typeID, def_show_types.type, schedule_hosts.schedule_alias, users.username, users.preferred_name 
							   FROM `schedule`, `def_show_types`, `schedule_hosts`, `users` 
							   WHERE schedule.active = 1 AND schedule.dayID = '%d' AND def_show_types.show_typeID = schedule.show_typeID 
								      AND schedule_hosts.scheduleID = schedule.scheduleID AND schedule_hosts.username = users.username 
							  ORDER BY schedule.start_time, users.username ASC", $tab);
    $schedule_result = mysql_query($schedule_query, $link) or die(mysql_error($link));
    close_database_connection($link);
    return $schedule_result;
}

function get_current_show_query() {
    $link = open_database_connection();

    $current_show_result = mysql_query("SELECT * FROM `show` ORDER BY `show`.`showID` DESC LIMIT 0 , 1", $link)
            or
            die("getting current show query " . mysql_error($link));
    close_database_connection($link);
    return $current_show_result;
}

function get_current_logbook_query() {
    $current_show = get_current_show_query();
    $current_show = mysql_fetch_row($current_show);
    $link = open_database_connection();
    $playlistQuery = sprintf("SELECT * FROM `logbook`, `show` 
					  WHERE show.showID = '%d' AND logbook.showID='%d' AND deleted = 0 
					  ORDER BY logbookID DESC", $current_show[0], $current_show[0]);
    $current_logbook = mysql_query($playlistQuery, $link)
            or
            die(mysql_error($link));
    close_database_connection($link);
    return $current_logbook;
}
function get_most_recent_track() {
    $link = open_database_connection();
    /*
    $nowPlayingQuery = "SELECT * FROM `now_playing` as n "
        . "inner join `logbook` as l on n.logbookID = l.logbookID "
        . "left outer join `show` as s on s.showID = l.showID "
        . "left outer join `show_hosts` as h on l.showID = h.showID";
        */
    $nowPlayingQuery = "SELECT * FROM `now_playing` ;";
    $nowPlayingResults = mysql_query($nowPlayingQuery,$link) or die(mysql_error($link));

    $nowPlaying = mysql_fetch_assoc($nowPlayingResults);
    close_database_connection($link);
    
    return $nowPlaying;

}

/**
 * 
 * Returns the first 20 most recent songs played in descending order beginning from the most recent
 * 
 * @return sql result set
 */
function get_most_recent_playlist() {

    $show_result = get_current_show_query();
    $show = mysql_fetch_row($show_result);

    $playlistQuery = sprintf("SELECT * FROM `logbook`, `show` 
            WHERE show.showID='%d' AND logbook.showID='%d' AND deleted=0 
            ORDER BY time_played DESC LIMIT 20", $show[0], $show[0]);

    $link = open_database_connection();
    $result = mysql_query($playlistQuery, $link);
//              or
//              die(mysql_error("getting current show query " . $link));

    $playlist = array();

    while ( ($p = mysql_fetch_assoc($result)) ) {
        $playlist[] = $p;
    }

    close_database_connection($link);

    return $playlist;
}

function get_shows_by_time_query($start, $end) {
    $link = open_database_connection();

    $show_by_time_query = sprintf("SELECT * FROM `show` where `show`.start_time > '%s' AND `show`.end_time < '%s'", $start, $end);
    $show_by_time_result = mysql_query($show_by_time_query, $link)
            or
            die(mysql_error($link));
    close_database_connection($link);
    return $show_by_time_result;
}

function get_show_playlist_query($showID) {
    $link = open_database_connection();
    $playlistQuery = sprintf("SELECT * FROM `logbook`, `show`
					  WHERE show.showID = '%d' AND logbook.showID='%d' AND deleted = 0
					  ORDER BY logbookID DESC", $showID, $showID);
    $current_playlist_result = mysql_query($playlistQuery, $link)
            or
            die(mysql_error($link));
    close_database_connection($link);
    return $current_playlist_result;
}

function get_username_hash_query($username) {
    $link = open_database_connection();
    $username_hash_query = sprintf("SELECT password, first_name, preferred_name, statusID 
										FROM users WHERE username = '%s'", $username);
    $username_hash_result = mysql_query($username_hash_query)
            or
            die(mysql_error($link));
    close_database_connection($link);
    return $username_hash_result;
}

function get_position_id_query($username) {
    $link = open_database_connection();
    $position_id_query = sprintf("SELECT positionID FROM staff WHERE username = '%s' AND start_date < NOW() AND end_date > NOW()", $username);
    $position_id_result = mysql_query($position_id_query)
            or
            die(mysql_error($link));
    close_database_connection($link);
    return $position_id_result;
}
