
<?php

require_once("config.php");



function get_time_formatted($file_path,$addr){
if($file_path!==""){
$slice=explode($file_path,$addr);
}
else{
$slice[1]=$addr;
}
$s2=explode("_",$slice[1]);
$date_time=substr($s2[2],0,12);
$hour=substr($date_time,8,2);
$minute=substr($date_time,10,2);

return $hour.":".$minute;




}
 function get_other_mp4($camera_name,$file_path,$date){
        $file_path=$file_path.$camera_name."/";
		$mp4_name=$camera_name."_".$date.".mp4";
		
		return $file_path.$date."/".$mp4_name;




 }

function view_images_period($period_n,$period,$camera,$file_path){
        $c=count($camera);
        $array_of_cams_img=array();
    $array_of_cams=array();
        $final_array=array();

        for($i=1;$i<=$c;$i++){

        $folder_name=$camera[$i]['camera_name'];
        $camera_path=$file_path.$folder_name;
   // $scanned_directory = array_diff(scandir($camera_path,1), array('..', '.','test'));

$scanned_directory = glob("$camera_path/*20*", GLOB_ONLYDIR);
sort($scanned_directory);
rsort($scanned_directory);



        $path_to_photos=$scanned_directory[0]."/";
        $images_array = array_diff(scandir($path_to_photos, 1),array('..', '.','list.txt','divx2pass.log','divx2pass.log.mbtree','lights.mp4','$avi_file_name','$mp4_file','uk.txt','uk.mp4','au.txt','au.mp4','ph.txt','ph.mp4','test'));

        $i_count=count($images_array);

   $array_of_cams_img[] =$images_array;
   $array_of_cams[]=$camera[$i]['camera_name'];
   


        }


          // print_r($array_of_cams_img);
   for($j=0;$j<count($array_of_cams_img);$j++){
           $url="";
          for($k=0;$k<count($array_of_cams_img[$j]);$k++){
          //echo "at beigaining:k=".$k."<br/>";
           $pieces = explode("_", $array_of_cams_img[$j][$k]);
          // echo  $pieces[2]."<br/>";
           $time=$pieces [2][8].$pieces [2][9].$pieces [2][10].$pieces [2][11];
         //echo $time."<br/>";
          // if($period_n==1 ){
                  $skip=0;
                  if($time>=$period[$period_n]['period_start'] AND $time<=$period[$period_n]['period_end'] ){
                //echo $time."<br/>";

                $fn=$array_of_cams[$j];
        $cp=$file_path.$fn;
    $sd = array_diff(scandir($cp,1), array('..', '.','test'));
	if($sd[0]=="" OR $sd[0]==NULL){
	$sd[0]=$sd[1];
	}
        $ptp=$cp."/".$sd[0]."/";

                          $url=$ptp.$array_of_cams_img[$j][$k];
                // echo $url."<br/>";
                if($file_path!==""){
                $b1=explode($file_path,$url);



                }
                else{
                        $b1[1]=$url;
                }


                $b2=explode("_",$b1[1]);
                $b3=substr($b2[2],0,12);




                $url2="";
                $new_url="$url,";

                for($l=1;$l<=5;$l++){
                $nxt=$ptp.$array_of_cams_img[$j][$k+$l];
                if($file_path!==""){
                $c1=explode($file_path,$nxt);
                }
                else{
                $c1[1]=$nxt;
                }
                $c2=explode("_",$c1[1]);
                $c3=substr($c2[2],0,12);


if($c3==NULL OR $c3==0 OR $c3==""){
break;
}
                if($b3==$c3 ){


                $new_url.="$nxt".",";
                $skip++;

                continue ;

                }
                else{

                break;
                }


                }

$final_array[$array_of_cams[$j]][][0]=$new_url;



                  }
                        //echo $k."before  + {$skip} <br/>";;
                $k=$k+$skip;
                //echo $k."after <br/>";;




         //  }


   }

        //var_dump($array_of_cams_img[$j]);

   }




        create_output($final_array,$camera,$file_path);




        }




?>

<?php
function ten_minute_header($period_n,$period,$camera,$file_path){
        $period_name=$period[$period_n]['period_label'];
        $start=$period[$period_n]['period_start_label'];
        $end=$period[$period_n]['period_end_label'];

echo "<a href='camera.php'>Go Back </a><h2>Side By Side View</h2><table border='1' style='' border='1' style='text-align:left;
    vertical-align:middle;'>

        <tr> <td colspan='43' style='text-align:center;'>{$period_name}  - {$start} {$end}</td></tr>
";
}

?>
<?php

function create_output($array,$camera,$file_path){
//var_dump($array);


        //print_r($array);
echo "<tr>";
        for($i=1;$i<=count($camera);$i++){
                $camera_name=$camera[$i]['camera_name'];
                echo "<th>Time</th>";
            echo "<th>$camera_name</th>";
                //echo "<tr style='border:thin solid gray;' >";
                //echo "<th style='border:thin solid gray; width:100px;'>";
                //echo $camera_name;
                //echo "</th>";
                //for($j=0;$j<count($array[$camera_name]);$j++){

                //echo "<td  style=' text-align:center'><a href='{$array[$camera_name][$j]}'><img src='".$array[$camera_name][$j]."' width='160' height='120' style=''></a></td>";

                //}

                //echo "</tr>";

        }

        echo "</tr>";

        //print_r($array);
        $max=0;
   for($i=1;$i<=count($camera);$i++){$cam_name=$camera[$i]['camera_name'];
   if($max<count($array[$cam_name])){
   $max=count($array[$cam_name]);
}

        }

        for($i=0;$i<$max;$i++){

        $previous_stop_point=array(0=>array(0=>"no file",1=>"no file"));

        echo "<tr>";
        for($j=1;$j<=count($camera);$j++){
        $f=1;
$p_s_p=$previous_stop_point[$f][1];
$c_f_n=$array[$cam_name][$i];
$e=explode($file_path,$c_f_n);
$e1=explode("_",$e[1]);
$e2=$e1[2];


if($e2==$p_s_p){
$f=$f+1;

}
$f=$f+1;
        $cam_name=$camera[$j]['camera_name'];
        $cam_width=$camera[$j]['camera_thumb_width'];
                $cam_height=$camera[$j]['camera_thumb_height'];
if($array[$cam_name][$i]=="" OR $array[$cam_name][$i]==NULL){

$array[$cam_name][$i]="no_picture";
}

if($array[$cam_name][$i]!=="no_picture"){
$output="";

$time_formatted="24:00";




for($p=0;$p<5;$p++){
$f_n=$array[$cam_name][$i][0];
$width=$camera[$j]['camera_thumb_width'];
$height=$camera[$j]['camera_thumb_height'];
$slice=explode(",",$f_n);



if($slice[$p]!==""){
$time_formatted=get_time_formatted($file_path,$slice[$p]);
$output.="<a href='$slice[$p]'><img src='$slice[$p]' width='$width',height='$height'></a>";

}
else{
break;
}
}








echo "<td>{$time_formatted}</td><td  style=' text-align:left'>$output</td>";


}
else{
echo "<td></td><td  style=' text-align:center'>No Image Data</td>";
}
        }
        //echo $camera_name;
        //print_r($array[$camera_name]);


        echo "</tr>";


}

}
?>



<?php


if(isset($_GET['period']) AND $_GET['period']!==""){

        $period_n=urlencode(stripslashes($_GET['period']));
        ten_minute_header($period_n,$period,$camera,$file_path);
        view_images_period($period_n,$period,$camera,$file_path);

}
if(isset($_GET['single']) AND $_GET['single']!==""){

        $cam_name=urlencode(stripslashes($_GET['cam_name']));
        $hour=urlencode(stripslashes($_GET['hour']));
        $minute=urlencode(stripslashes($_GET['minute']));
        $date=urlencode(stripslashes($_GET['date']));
        view_single_img($camera,$cam_name,$period,$hour,$minute,$date,$file_path);


}

if(isset($_GET['live']) AND $_GET['live']=="1"){
        $cam_name=urlencode(stripslashes($_GET['cam_name']));
        $rtsp=urlencode(stripslashes($_GET['rtsp']));
        view_live_feed($cam_name,$rtsp);
}

if(isset($_GET['mp4_download']) AND $_GET['mp4_download']!==""){
        $camera_name=urlencode(stripslashes($_GET['cam_name']));
        $mp4_url=urlencode($_GET['mp4_download']);
        $url=get_other_mp4($camera_name,$file_path,$mp4_url);


        header("LOCATION:{$url}");
}
?>
</table>

<?php



function view_live_feed($cam_name,$rtsp){

        $rtsp=urldecode($rtsp);

        echo "<center><h2><a href='camera.php'>Back To Main Page</a<</h2>
        <table border='1' style='text-align:center;' width='60%'><br/><center>
<tbody><tr><td colspan='3'><br/><object type='application/x-vlc-plugin' data='{$rtsp}' width='600' height='600' id='video1'>
     <param name='movie' value='{$rtsp}'/>
     <embed type='application/x-vlc-plugin' name='video1'
     autoplay='no' loop='no' width='400' height='300'
     target='{$rtsp}' />
         <br/>
     <a href='{$rtsp}'>{$cam_name}</a>
</object>
</center></td></tr>

</tbody></table></center>
        ";
}


?>
<?php




function view_single_img($camera,$cam_name,$period,$hour,$minute,$date,$file_path){

$peices=explode("-",$date);
$real_date=$peices[0].$peices[1].$peices[2];
$time_m=$hour.$minute;

$real_path=$file_path.$cam_name."/".$real_date."/";
$images_array = array_diff(scandir($real_path, 1), array('..', '.'));
$full_img_name="sss.jpg";
        for($i=0;$i<count($images_array);$i++){

                $p=explode("_",$images_array[$i]);
                 $time=$p [2][8].$p [2][9].$p[2][10].$p[2][11];


                if($time==$time_m){

                        $full_img_name=$images_array[$i];
                        break;

                }


        }
        if(file_exists($real_path.$full_img_name)){

        echo "<h2><a href='camera.php'>Back To Main Page</a<</h2><table border='1'>
<tbody><tr><td colspan='3'><img src='{$real_path}{$full_img_name}'></td></tr> <br/><br/>";
 view_single_img_footer($camera,$cam_name,$period,$hour,$minute,$date,$file_path,$time_m);
show_all_other_minutes_with_same_time($time,$file_path,$full_img_name,$cam_name,$real_path,$camera,$period,$hour,$minute,$date,$time_m);

        }
        else{
		
		jump_to_next_avilable_photo($time,$file_path,$full_img_name,$cam_name,$real_path,$camera,$period,$hour,$minute,$date,$time_m);
		
                        echo "<h2><a href='camera.php'>Back To Main Page</a<</h2><table border='1'>
<tbody><tr><td colspan='3'>Image Not FOund</td></tr>";
 view_single_img_footer($camera,$cam_name,$period,$hour,$minute,$date,$file_path,$time_m);
                echo "";
        }
		
		echo "</tbody></table>";
       

}


function view_single_img_footer($camera,$cam_name,$period,$hour,$minute,$date,$file_path,$time_m){
        $location="";
        for($i=1; $i<=count($camera); $i++){

                if($camera[$i]['camera_name']==$cam_name){
                        $location=$camera[$i]['camera_location'];
                        break;
                }




        }
        if($minute=="59"){

                $next_time_hour=$hour+1;
                if(strlen($next_time_hour)==1){
                        $next_time_hour="0".$next_time_hour;

                }
                $next_time_minute="00";
                $later_time_hour=$hour;
                if(strlen($later_time_hour)==1){
                        $later_time_hour="0".$later_time_hour;

                }
                $later_time_minute=$minute-1;
        }
        else{

                $next_time=$time_m+01;
                $later_time=$time_m-01;
                if(strlen($next_time)==3){

                        $next_time="0".$next_time;
                }
                if(strlen($later_time)==3){

                        $later_time="0".$later_time;
                }
                $next_time_hour=substr($next_time,0,2);
                $next_time_minute=substr($next_time,2,2);
                $later_time_hour=substr($later_time,0,2);
                $later_time_minute=substr($later_time,2,2);

        }

        if($minute=="00"){

                $later_time_hour=$hour-1;
                $later_time_minute="59";

                        if(strlen($later_time_hour)==1){
                        $later_time_hour="0".$later_time_hour;

                }
				
				       if($minute=="" OR $minute==NULL){

                
                $later_time_minute="00";
                $next_time_minute="01";
                }

        }
		
		

        echo "
        <tr><td> <a href='view.php?single=1&date={$date}&hour={$later_time_hour}&minute={$later_time_minute}&cam_name={$cam_name}'>&lt;-Back</a></td><td align='center'>{$cam_name} - {$date} - {$location} </td><td align='right'><a href='view.php?single=1&date={$date}&hour={$next_time_hour}&minute={$next_time_minute}&cam_name={$cam_name}'>Next -&gt;</a></td></tr>";


}



function show_all_other_minutes_with_same_time($time,$file_path,$file_begining,$camera_name,$real_path,$camera,$period,$hour,$minute,$date,$time_m){

$orginal_fil=$real_path.$file_begining;


$pic=explode("_TIMING.jpg",$file_begining);
$last5=substr($pic[0],-5);

$slice=explode($last5,$pic[0]);
$file_top=$slice[0];
$de=$real_path;

$ss=glob("{$de}*$file_top*");


for($i=0; $i<count($ss);$i++){
if($ss[$i]==$original_fil){

continue;

}
else{
echo "<tr><td colspan='3'><br/><img src='$ss[$i]'></td> <br/></tr>";
 view_single_img_footer($camera,$camera_name,$period,$hour,$minute,$date,$file_path,$time_m);
}

}
}


function jump_to_next_avilable_photo($time,$file_path,$full_img_name,$cam_name,$real_path,$camera,$period,$hour,$minute,$date,$time_m){
$dir=$file_path.$cam_name;
$g=glob($real_path.'*.jpg') ;


for($i=0;$i<count($g);$i++){

$file_nm=$g[$i];
$slice=explode($real_path,$file_nm);

$kk=explode("_",$slice[1]);

$tt=substr($kk[2],8,2).substr($kk[2],10,2);

$hh=substr($kk[2],8,2);
$mm=substr($kk[2],10,2);
if($tt>$time_m OR $tt<$time_m){



header("LOCATION:view.php?single=1&date={$date}&hour={$hh}&minute={$mm}&cam_name={$cam_name}");
exit;
}



}
}

?>

