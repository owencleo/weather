<html>
<head>
  <title>Weather</title>
</head>

<body background="photo.png">
<style>
 
 .border{
   border: 1px solid white;
   padding: 10px;
   margin-left: 400px;
   margin-right: 400px;
 }
  .aqi-value{
    text-align: center!important;
    font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
    font-size:40px;
    font-weight:bold;
    color: white!important;
  }
  
  .title{

  	width: 100%;
  	color:#fff;
  	margin-bottom:0px;
  	padding-top:10px;
  	padding-bottom: 10px;
  }
 
  .weather-icon{
    text-align: center;
    color: white!important;
  	width:40%;
  	font-weight: bold;
  	padding:10px;
  	border: 1px solid #fff;
    margin-left: 200px;
  }
</style>
<?php
$cache_file = 'data.json';
if(file_exists($cache_file)){
  $data = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $data = file_get_contents($api_url);
  file_put_contents($cache_file, $data);
  $data = json_decode($data);
}

$current = $data->results->current[0];

?>
<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
      	return round($cen,2);
      }
  }
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />

  <div class="border">
    <h3 class="title text-center bordered"><?php echo $current->city.' ('.$current->country.')';?></h3>
     <p class="aqi-value"><?php echo convert2cen($current->temp,$current->temp_unit);?> °C</p>
            <p class="weather-icon">
              <img style="margin-left:-10px;" src="<?php echo $current->image;?>">
              <?php echo $current->description;?>
            </p>
  </div>
</body>
</html>