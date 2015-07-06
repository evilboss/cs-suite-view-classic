
<?php require_once("config.php"); ?>

<head>
<meta http-equiv="refresh" content="300">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>

</head>
<nav>
	<div class="blue lighten-1 nav-wrapper">
		<a href="" class="brand-logo">CloudStaff Suite View </a>

	</div>

</nav>
<small>(in beta) version 0.12</small>


	<div class="row">
	<div class="col s9">



	<table class="hoverable" border="1" >

<?php





function keytime($period){

        $c=count($period);
        for($i=1;$i<=$c;$i++){

                echo "<tr>";
                echo "<td>{$period[$i]['period_label']}</td>";
                echo "<td>{$period[$i]['period_start_label']}</td>";
                echo "<td>{$period[$i]['period_end_label']}</td>";
                echo "<td><a   target='_blank'  href='view.php?period={$i}'> Side-by-Side</a></td>";
                echo "</tr>";



        }






}

  function get_date_list($cam_name,$file_path){

            $new_path=$file_path.$cam_name."/";
	$scanned_directory = glob("$new_path**", GLOB_ONLYDIR);
	sort($scanned_directory);
rsort($scanned_directory);
return $scanned_directory;
  }
  function get_other_mp4($camera_name,$file_path,$date){
          $new_path=$file_path.$camera_name."/";

          $today_dir=$date;
          $new_new_path= $new_path. $today_dir."/";
         $mp4_folder= array_diff(scandir($new_new_path,1), array('..', '.'));
        $mp4_file_name="No File";

if ($handle = opendir($new_new_path)) {

    while (false !== ($entry = readdir($handle))) {
        if (preg_match('/\.mp4$/', $entry)) {
          $mp4_file_name=$entry;
        }
    }

    closedir($handle);
} $mp4_file_full_url= $new_new_path.$mp4_file_name;

return $mp4_file_full_url;
  }
  function get_yesterday_mp4($camera_name,$file_path){
$yesterday_date=date('Ymd',strtotime("-1 days"));
$mp4_url=$camera_name."_".$yesterday_date.".mp4";
return $file_path.$camera_name."/".$yesterday_date."/".$mp4_url;
  }

    function get_today_mp4($camera_name,$file_path){
         $today_date=date('Ymd',strtotime("today"));
$mp4_url=$camera_name."_".$today_date.".mp4";
return $file_path.$camera_name."/".$today_date."/".$mp4_url;
    }




function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
function get_camera_last_image($camera_name,$file_path){
	$folder_name=$camera_name;	
	$camera_path=$file_path.$folder_name;
$scanned_directory = glob("$camera_path/**", GLOB_ONLYDIR);
sort($scanned_directory);
rsort($scanned_directory);

	$path_to_photos=$scanned_directory[0];
	$avi_file_name=$camera_name."_".$scanned_directory[0].".avi";
	$mp4_file=$camera_name."_".$scanned_directory[0].".mp4";
	$images_array =  glob($path_to_photos.'/*.jpg');
	
sort($images_array);
rsort($images_array);
	$i_count=count($images_array);
	
//print_r($images_array);
	$last_img_name="";
	for($i=0;$i<100;$i++){
	

if($images_array[$i]!==NULL AND $images_array[$i]!==$avi_file_name AND $images_array[$i]!== $mp4_file){
$last_img_name=$images_array[$i];
//echo $images_array[$i];
break;
}
	}
	
	return $last_img_name;

}

function last_still($camera_name,$file_path){

	$folder_name=$camera_name;	
	$camera_path=$file_path.$folder_name;
    $scanned_directory = array_diff(scandir($camera_path,1), array('..', '.','test'));
	
	if($scanned_directory[0]=="" OR $scanned_directory[0]==NULL){
	$scanned_directory[0]=$scanned_directory[1];
	
	}
	
	
	$path_to_photos=$camera_path."/".$scanned_directory[0];
$images_array =  glob($path_to_photos.'/*.jpg');
sort($images_array);
rsort($images_array);

	$i_count=count($images_array);

	$last_img_name="";

		for($i=0;$i<100;$i++){
	

if($images_array[$i]!==NULL ){
$last_img_name=$images_array[$i];
//echo $images_array[$i];
break;
}
	}

	 $pieces = explode("_", $last_img_name);

$time_period= $pieces[2];
$year=substr($time_period,0,4);
$month=substr($time_period,4,2);
$day=substr($time_period,6,2);
$hour=substr($time_period,8,2);
$minute=substr($time_period,10,2);
$test_date="2015-05-10";

$time_formatted="2015-04-22 ";

//$time_in_12_hour_format  = date("g:i a", strtotime($time_formatted));
$full_date_time=$year."-".$month."-".$day." ".$time_formatted;

$time_to_be_calculated = strtotime($year."-".$month."-".$day.$hour.":".$minute);

$time_passed=humanTiming($time_to_be_calculated)." ago";

if($time_passed==NULL){
$time_passed= "Just Now ";
}
elseif($time_passed==""){
$time_passed ="Just Now ";
}
elseif($time_passed==0){
$time_passed = "Just Now ";
}

return $time_passed;
}
echo "<tr>";
echo "<td></td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
$ss=get_camera_last_image($cam_name,$file_path);

$beg=$file_path.$cam_name."/";
$pic=explode($beg,$ss);
$folder_name=explode("/",$pic[1]);
$file_name=explode("_",$folder_name[1]);

$h=substr($file_name[2],8,2);
$m=substr($file_name[2],10,2);
$d=substr($file_name[2],0,4)."-".substr($file_name[2],4,2)."-".substr($file_name[2],6,2);
$link_url="view.php?single=1&date={$d}&hour={$h}&minute={$m}&cam_name={$cam_name}";
        $cam_width=$camera[$i]['camera_thumb_width'];
                $cam_height=$camera[$i]['camera_thumb_height'];
echo "<td><a href='{$link_url}'><img class='responsive-img'src='{$ss}' width='{$cam_width}' height='{$cam_height}' /> </a></td>";




}
echo "</tr>";

echo "<tr>";
echo "<td>Camera Name</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
echo "<td>{$cam_name}</td>";
}

echo "</tr>";

echo "</tr>";



echo "</tr>";

echo "<tr>";
echo "<td>Location </td>";
for($i=1;$i<=count($camera);$i++){
$cam_location=$camera[$i]['camera_location'];
echo "<td>{$cam_location}</td>";
}

echo "</tr>";

echo "</tr>";

echo "<tr>";
echo "<td>Status </td>";
for($i=1;$i<=count($camera);$i++){
$cam_status=$camera[$i]['camera_status'];
echo "<td>{$cam_status}</td>";
}

echo "</tr>";
echo "</tr>";

echo "<tr>";
echo "<td>Resolution</td>";
for($i=1;$i<=count($camera);$i++){
$cam_res=$camera[$i]['camera_res'];
echo "<td>{$cam_res}</td>";
}

echo "</tr>";

echo "<tr>";
echo "<td>Local IP</td>";
for($i=1;$i<=count($camera);$i++){
$cam_lip=$camera[$i]['camera_ip'];
echo "<td>{$cam_lip}</td>";
}

echo "</tr>";
echo "<tr>";
echo "<td>Last Still</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
$time_passed=last_still($cam_name,$file_path);
echo "<td>{$time_passed}</td>";
}

echo "</tr>";

$ccc=count($camera)+1;
echo "<tr style='text-align:center;'>";
echo "<td colspan='{$ccc}'><b>Suite VIew Live (rtsp)</b></td>";


echo "</tr>";

echo "<tr>";
echo "<td>Camera Name</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
echo "<td>$cam_name</td>";
}

echo "</tr>";


echo "<tr>";
echo "<td>Internal Access</td>";
for($i=1;$i<=count($camera);$i++){
$cam_res=$camera[$i]['camera_res'];
echo "<td><a  target='_blank' href='view.php?live=1&&rtsp={$camera[$i]['camera_rtsp_loca']}&&cam_name={$camera[$i]['camera_name']}&&i={$i}'>Web</a> | <a  target='_blank' href='{$camera[$i]['camera_rtsp_loca']}' >App</a></td>";
}

echo "</tr>";

echo "<tr>";
echo "<td>External Access</td>";
for($i=1;$i<=count($camera);$i++){
$cam_res=$camera[$i]['camera_res'];
echo "<td><a target='_blank'  href='view.php?live=1&&rtsp={$camera[$i]['camera_rtsp_internet']}&&cam_name={$camera[$i]['camera_name']}&&i={$i}'>Web </a>|  <a  target='_blank' href='{$camera[$i]['camera_rtsp_internet']}' > App </a></td>";
}

echo "</tr>";

echo "<tr>";
echo "<td>Username</td>";
for($i=1;$i<=count($camera);$i++){
$cam_username=$camera[$i]['camera_rtsp_username'];
echo "<td>$cam_username</td>";
}

echo "</tr>";
echo "</tr>";

echo "<tr>";
echo "<td>Password</td>";
for($i=1;$i<=count($camera);$i++){
$cam_password=$camera[$i]['camera_rtsp_password'];
echo "<td>$cam_password</td>";
}

echo "</tr>";

echo "<tr>";

$ccc=count($camera)+1;
echo "<tr style='text-align:center;'>";

echo "<td colspan='{$ccc}'><b>Suite View Playback (.mp4)</b></td>";


echo "</tr>";

echo "<tr>";
echo "<td>Camera Name</td>";

for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];

echo "<td>$cam_name</td>";
}

echo "</tr>";

echo "<tr>";
echo "<td>Today</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
$today=get_today_mp4($cam_name,$file_path);
echo "<td><a  target='_blank' href='{$today}'>Today</a></td>";
}

echo "</tr>";


echo "</tr>";

echo "<tr>";
echo "<td>Yesterday</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];
$yesterday=get_yesterday_mp4($cam_name,$file_path);
echo "<td><a  target='_blank' href='{$yesterday}'>Yesterday</a></td>";
}

echo "</tr>";

echo "</tr>";

echo "<tr>";
echo "<td>Other</td>";
for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];

	$date_array= get_date_list($cam_name,$file_path);
		$select_box="";
		for($j=0;$j<count($date_array);$j++){
		$exploded=$file_path.$cam_name."/";
		$formatted=explode($exploded,$date_array[$j]);
		
			$date_y=substr($formatted[1],0,4);
			$date_m=substr($formatted[1],4,2);
			$date_d=substr($formatted[1],6,2);
			$formatted_date=$date_y."-".$date_m."-".$date_d;
			$non_formatted_date=$date_y.$date_m.$date_d;
			$select_box.="<option value='{$non_formatted_date}'>$formatted_date</option>";
		}





echo "<td><form  target='_blank' action='view.php?download_mp4={$non_formatted_date}' method='get'><input type='hidden' name='cam_name' value='{$cam_name}'><select name='mp4_download'>$select_box</select> <br/><input type='submit' value='Download'></form></td>";
}

echo "</tr>";
echo "<tr>";

$ccc=count($camera)+1;
echo "<tr style='text-align:center;'>";
echo "<td colspan='{$ccc}'><b>Suite View Snapshot (.jpg)</b></td>";

echo "</tr>";


echo "<tr>";
echo "<td>Camera Name</td>";

for($i=1;$i<=count($camera);$i++){


$cam_name=$camera[$i]['camera_name'];


//print_r($time_array);
echo "<td>".$cam_name."</td>";






}


echo "</tr>";







echo "<tr>";
echo "<td>Start Date And Time</td>";

for($i=1;$i<=count($camera);$i++){
$cam_name=$camera[$i]['camera_name'];

sort($time_array[$cam_name]['minute']);
sort($time_array[$cam_name]['hour']);
echo "<td><form    action='view.php' method='get'>
<input type='hidden' name='single' value='1' />";
echo "<br/><label>Date :</label><select name='date'>";
echo "<option value='".date('Y-m-d')."'>";
echo $days_ago = date('Y-m-d');
echo "</option>";
echo "<option value='".date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))))."'>";
echo $days_ago = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));
echo "</option>";
echo "<option value='". date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d'))))."'>";
echo $days_ago = date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d'))));
echo "</option>";
echo "</select>
<br/>
<br/>
<label>Time :</label>
<select name='hour'>";


echo "	 
	 <option value='00'>00</option>
	 <option value='01'>01</option>
	 <option value='02'>02</option>
	  <option value='03'>03</option>
	 <option value='04'>04</option>
	 <option value='05'>05</option>
	  <option value='06'>06</option>
	    <option value='07'>07</option>
		  <option value='08'>08</option>
		    <option value='09'>09</option>
			  <option value='10'>10</option>
			    <option value='11'>11</option>
				  <option value='12'>12</option>
				    <option value='13'>13</option>
					  <option value='14'>14</option>
					    <option value='15'>15</option>
						  <option value='16'>16</option>
						    <option value='17'>17</option>
							  <option value='18'>18</option>
							    <option value='19'>19</option>
								  <option value='20'>20</option>
								   <option value='21'>21</option>
								    <option value='22'>22</option>
									 <option value='23'>23</option>
	 ";












echo "
       </select>
";

echo "
       <select name='minute'>
";



echo "<option value='00'>00</option>
  <option value='01'>01</option>
  <option value='02'>02</option>
  <option value='03'>03</option>
  <option value='04'>04</option>
  <option value='05'>05</option>
  <option value='06'>06</option>
  <option value='07'>07</option>
  <option value='08'>08</option>
  <option value='09'>09</option>
  <option value='10'>10</option>
  <option value='11'>11</option>
  <option value='12'>12</option>
  <option value='13'>13</option>
  <option value='14'>14</option>
  <option value='15'>15</option>
  <option value='16'>16</option>
  <option value='17'>17</option>
  <option value='18'>18</option>
  <option value='19'>19</option>
  <option value='20'>20</option>
  <option value='21'>21</option>
  <option value='22'>22</option>
  <option value='23'>23</option>
  <option value='24'>24</option>
  <option value='25'>25</option>
  <option value='26'>26</option>
  <option value='27'>27</option>
  <option value='28'>28</option>
  <option value='29'>29</option>
  <option value='30'>30</option>
  <option value='31'>31</option>
  <option value='32'>32</option>
  <option value='33'>33</option>
  <option value='34'>34</option>
  <option value='35'>35</option>
  <option value='36'>36</option>
  <option value='37'>37</option>
  <option value='38'>38</option>
  <option value='39'>39</option>
  <option value='40'>40</option>
  <option value='41'>41</option>
  <option value='42'>42</option>
  <option value='43'>43</option>
  <option value='44'>44</option>
  <option value='45'>45</option>
  <option value='46'>46</option>
  <option value='47'>47</option>
  <option value='48'>48</option>
 <option value='49'>49</option>
  <option value='50'>50</option>
  <option value='51'>51</option>
  <option value='52'>52</option>
  <option value='53'>53</option>
  <option value='54'>54</option>
  <option value='55'>55</option>
  <option value='56'>56</option>
  <option value='57'>57</option>
  <option value='58'>58</option>
  <option value='59'>59</option>";










echo "</select>

<input type='hidden'  name='cam_name' value='{$cam_name}'>
<br/><br/>
<center><input  type='submit' value='View' /></center>
";








echo "

 </form>
</td>";


}

echo "</tr>";
?>

</table>
		</div>
		<div class="col s3">
<h2 class="blue-text text-darken-2">Bookmarks</h2>



<table class="hoverable" border="1" >
  <tr>
    <td>Title</td>
    <td>Start Time </td>
    <td>End Time</td>
         <td>Action</td>



  </tr>

 <?php



 keytime($period);

 ?>

	</div>



	</div>