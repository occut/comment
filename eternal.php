<?php
$str = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$arr = parse_url($str);

if ($arr['path'] == '/eternal.php/select'){
	 $a = select();
	 date_default_timezone_set('PRC');
	 $aas='';
	 foreach ($a as $key => $value) {
	 	$aa = explode(":", $value[3]);
	 	$day=date("Y-m-d H:i:s",strtotime("$value[5] +$aa[0] minute"));
	 	$day=date("Y-m-d H:i:s",strtotime("$day +$aa[1] second"));
	 	$times =  intval((strtotime(date("Y-m-d H:i:s"))-strtotime($day)));
	 	if($times > 30){
	 		$aas = $key;
	 		break;
	 	}
	 }
	 if ($aas == ''){
	 	echo "1";
	 }else{
	 	 echo "service:".$a[$aas][1]."|path:".$a[$aas][2]."|time:".$a[$aas][3]."|name:".$a[$aas][4]."|";
	 }
	
}
if ($arr['path'] == '/eternal.php/afferent'){
	$arr_query = convertUrlQuery($arr['query']);
	$service = $arr_query['service'];
	$path = $arr_query['path'];
	$time = $arr_query['time'];
	$name = $arr_query['name'];
	$a = add($service,$path,$time,$name);
	echo $a;
}
if ($arr['path'] == '/eternal.php/dell'){
	$content=dell();
	echo $content;
}
// var_dump($arr['path'] == '/eternal.php/afferent');
// //2.0 将URL中的参数取出来放到数组里
// $arr_query = convertUrlQuery($arr['query']);
// var_dump($arr_query);
// echo "<br/>";
// //3.0 将 参数数组 再变回 字符串形式的参数格式
// var_dump(getUrlQuery($arr_query));

/**
 * Returns the url query as associative array
 *
 * @param    string    query
 * @return    array    params
 */
function convertUrlQuery($query)
{
    $queryParts = explode('&', $query);
    $params = array();
    foreach ($queryParts as $param)
    {
        $item = explode('=', $param);
        $params[$item[0]] = $item[1];
    }
    return $params;
}
function getUrlQuery($array_query)
{
    $tmp = array();
    foreach($array_query as $k=>$param)
    {
        $tmp[] = $k.'='.$param;
    }
    $params = implode('&',$tmp);
    return $params;
}


function add($service,$path,$time,$name){
	$mysqli = new mysqli("localhost", "root", "2017Admindomain", "eternal");
    if(!$mysqli)  {
        echo"3";
    }
    $sq = "DELETE FROM `eternal` WHERE path like $path and name=$name";
	$row = $mysqli->query($sq);
	// dump($row);
    $sql="
    insert into 
        eternal
    set 
        service='".$service."',
        path='".$path."',
        time='".$time."',
        name='".$name."'
	";
	$row = $mysqli->query($sql);
    
    $mysqli->close();
    if($row){
    	return "1";
    }else{
    	return "2";
    }
}

function select(){
	$mysqli = new mysqli("localhost", "root", "2017Admindomain", "eternal");
    if(!$mysqli)  {
        echo"3";
        return false;
    }
    $sql = "SELECT * FROM eternal";
    $result = $mysqli->query($sql);
    $a = [];
     while ($row = mysqli_fetch_row($result)) {
        $a[] = $row;
    }
    return $a;
}

function dell(){
	
	$mysqli = new mysqli("localhost", "root", "2017Admindomain", "eternal");
    if(!$mysqli)  {
        echo"3";
    }
    $sql="SELECT * FROM `eternal` WHERE 1";
	$row = $mysqli->query($sql);
    
    $mysqli->close();
    if($row){
    	return "1";
    }else{
    	return "2";
    }
}