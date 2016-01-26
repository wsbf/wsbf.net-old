<?php

/*
 * @author Emmanuel John
 * 
 * This file loads the first 20 most recent playlist and returns the result as a json object.
 * 
 * @return json
 * 
 */

include ("../domain/model.php");

//retrieve the
$playlist_result = get_most_recent_playlist();
header("content-type:application/json");
echo json_encode($playlist_result);
