<?php
include ('../header.php');
include ('../body.html');
include '../DBManager.php';
set_time_limit(0);//処理制限時間を無期限に
$y = (string)date("Y", strtotime('-1 month')); //検索する年
$m = (string)date("m", strtotime('-1 month')); //検索する月
$d = (string)date("d", strtotime('-1 month')); //検索する日
$user_id = (string)$_SESSION['id'];
$start =  date("Y-m-d H:i:s", strtotime('first day of ' . $y.$m.$d));//検索する月の初めを取得
$end = date("Y-m-d H:i:s", strtotime('last day of ' . $y.$m.$d));//検索する月の終わりを取得
$start_day = first_week_date($start);//指定した日の週の日曜日の日付取得
$end_day = fin_week_date($end);//指定した日の週の土曜日の日付取得
//----------------------------週配列--------------------------------------------------
$loop = 1;//週をカウント
$c = tweets_count(array("user_id"=>$user_id));
while($start_day < $end_day){//week[第何週目][曜日] = 名詞+形容詞+時間
	$sunday = new MongoDate(strtotime(date_utc_to_jp($start_day)));
	$saturday = next_first_week_date($start_day);
	$saturday = new MongoDate(strtotime(date_utc_to_jp($saturday)));
	$data = tweets_search(array("created_at"=>array('$gt'=>$sunday, '$lte'=>$saturday)),null,array("month"=>1,"day"=>1));
	foreach ($data as $key =>$value){
			if(isset($value['noun']) && isset($value['adjective'])){
				$week[$loop][$value['dow']][$value['hour']] = (array)$value['noun'];
				$week[$loop][$value['dow']][$value['hour']] += (array)$value['adjective'];
			}
			elseif(isset($value['noun'])){
				$week[$loop][$value['dow']][$value['hour']] = (array)$value['noun'];
			}
			elseif(isset($value['adjective'])){
				$week[$loop][$value['dow']][$value['hour']] = (array)$value['adjective'];
			}
	}
	$start_day = date('Y-m-d', strtotime('+1 week' . $start_day));
	$loop++;
}
foreach ($week as $key =>$value){//配列weekにあるnullを取り除く
	foreach ($value as $key2 =>$value2){
		if(is_array($value2)){
			foreach ($value2 as $key3 =>$value3){
				foreach ($value3 as $key4 =>$value4){
					if(empty($value4)){unset($week[$key][$key2][$key3][$key4]);}
				}
			}
		}
	}
}
foreach ($week as $key =>$value){//配列weekの値を表の一列に変換
	foreach ($value as $key2 =>$value2){//曜日ごと
		if(is_array($value2)){
			foreach ($value2 as $key3 =>$value3){
				$week_time[$key][$key2][$key3] = array();//入れる箱作り

				foreach ($value3 as $key4 =>$value4){//時ごと
					if(!empty($week[$key][$key2][$key3])){//値が入っている場合
						$p_name = max(array_keys($week[$key][$key2][$key3],max($week[$key][$key2][$key3])));
						$p_value = max($week[$key][$key2][$key3]);
						$n_name = min(array_keys($week[$key][$key2][$key3],min($week[$key][$key2][$key3])));
						$n_value = min($week[$key][$key2][$key3]);
						if($p_value <= 0){//ポジティブワードの値がマイナスの場合、削除
							$p_name = '';
							$p_value = '';
							unset($week[$key][$key2][$key3][$n_name]);
						}
						elseif($n_value >= 0){//ネガティブワードの値がプラスの場合、削除
							$n_name = '';
							$n_value = '';
							unset($week[$key][$key2][$key3][$p_name]);
						}else{//使用済みの値を取り出す
							unset($week[$key][$key2][$key3][$p_name]);
							unset($week[$key][$key2][$key3][$n_name]);
						}
						//week_time[週][曜日][時][個数] = ポジティブワード、値、ネガティブワード、値、を挿入
						array_push($week_time[$key][$key2][$key3], array("p_name"=>$p_name, "p_value"=>$p_value, "n_name"=>$n_name, "n_value"=>$n_value));
					}
					ksort($week_time[$key][$key2]);

				}
			}
		}
	}
}

//javascriptに配列を送るために変換
$array = json_encode($week_time);

function first_week_date($ymd) {//指定した日の週の週初めの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("last sunday", strtotime($ymd)));
	return $date;
}

function fin_week_date($ymd) {//指定した日の週の週終わりの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("next saturday", strtotime($ymd)));
	return $date;
}

function next_first_week_date($ymd) {//指定した日の次の週初めの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("next sunday", strtotime($ymd)));
	return $date;
}

function date_utc_to_jp($utc_date){//日付を東京のタイムゾーンへ変更
	return date("Y-m-d H:i:s", strtotime($utc_date. " +9 hour"));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" href="flickity.min.css"></link>
<link rel="stylesheet" type="text/css" href="week.css"></link>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<link rel="stylesheet" type="text/css" href="../css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script src="flickity.pkgd.min.js"></script>
<script src="vanilla.js"></script>
<script type="text/javascript">
function frameClick() {
    document.location.href = "../your_page/your_page.php";
  }

$(function(){
$('.main-gallery').flickity({
	cellAlign: 'center', // 各画像（セル）の基準位置をしていできます。デフォルトはcenter。
	wrapAround: true, // trueで無限スライダーになります。
	contain: true, // trueでラッパー内に収まるようにスライドします。
	pageDots: true, // falseで下のドットを非表示にします。
	prevNextButtons: true,
});
});

//jQuery
function listener(/* parameters */) {
  console.log('eventName happened');
}
// bind event listener
// $carousel.on( 'eventName.flickity', listener );
// $carousel.on( 'scroll.flickity', function( event, progress ) {
//   console.log( 'Flickity scrolled ' + progress * 100 + '%' )
// })

$carousel.on( 'scroll.flickity', function( event, progress ) {
  progress = Math.max( 0, Math.min( 1, progress ) );
  $progressBar.width( progress * 100 + '%' );
});
// unbind event listener
$carousel.off( 'eventName.flickity', listener );
// bind event listener to trigger once. note ONE not ON
$carousel.one( 'eventName.flickity', function() {
  console.log('eventName happened just once');
});
</script>
<script type="text/javascript">
var week = JSON.parse('<?php echo  $array; ?>');

function hyo_sel(){//insert:表を挿入するdivID,
	selected = document.hyo.sel.value;//<select>で指定された値を取得
	var Re = document.getElementById("cell");//表を挿入するdivを取得
	Re.textContent = null;

	for(key in week){
		folding(Re,  key);
		var div_point = document.createElement("div");
		div_point.id = "point";
		div_point.style = "border:solid 1px #AAA";
		var id = document.getElementById(key);
		cell_title(id, div_point, "時間", "ポジティブワード", "数値", "ネガティブワード", "数値");
		keys = Object.keys(week[key][selected]);
		len = keys.length;
		keys.sort();
		for (i = 0; i < len; i++) {
			key2 = keys[i];
			for(key3 in week[key][selected][key2]){
				var time = key2;
				var pName = week[key][selected][key2][key3]['p_name'];
				var pValue = week[key][selected][key2][key3]['p_value'];
				var nName = week[key][selected][key2][key3]['n_name'];
				var nValue = week[key][selected][key2][key3]['n_value'];

				if(key3 <= 0){
					cell_value(true, div_point, time, pName, pValue, nName, nValue);
				}else{
					cell_value(false, div_point, "", pName, pValue, nName, nValue);
				}
			}
		}
	}

}

//Re:挿入先, id:何週目,
function folding(Re, id){//折り畳みページを挿入
	//折りたたみ展開ポインタ
// 	var Re = document.getElementById("cell");//表を挿入するdivを取得
	var div_title = document.createElement("div");
	div_title.onclick = function (){
		obj=document.getElementById(id).style;
		obj.display=(obj.display=='none')?'block':'none';
	}
	div_title.innerHTML = "<a style='cursor:pointer; border: medium solid #ffff00;'>"+id+"週目ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>";

	//折りたたまれ部分
	var div_contents = document.createElement("div");
	div_contents.id = id;
	if(key == 1){
		div_contents.style="display: block; clear: both;";
	}else{
		div_contents.style = "display:none;clear:both;";
	}

	Re.appendChild(div_title);
	Re.appendChild(div_contents);
}

function cell_title(Re, div_point, time, pName, pValue, nName, nValue){//Re:複製する1行の挿入先

	div_row = document.createElement("div");
	div_row.className = "row";

	div_time = document.createElement("div");
	div_time.className = "time";
	div_time.innerHTML = time;

	div_pName = document.createElement("div");
	div_pName.className = "posi";
	div_pName.innerHTML = pName;
	div_pValue = document.createElement("div");
	div_pValue.className = "posi";
	div_pValue.innerHTML = pValue;

	div_nName = document.createElement("div");
	div_nName.className = "nega";
	div_nName.innerHTML = nName;
	div_nValue = document.createElement("div");
	div_nValue.className = "nega";
	div_nValue.innerHTML = nValue;

	Re.appendChild(div_point);
	div_point.appendChild(div_row);
	div_row.appendChild(div_time);
	div_row.appendChild(div_pName);
	div_row.appendChild(div_pValue);
	div_row.appendChild(div_nName);
	div_row.appendChild(div_nValue);
}

function cell_value(jud, div_point, time, pName, pValue, nName, nValue){//Re:複製する1行の挿入先
	div_row = document.createElement("div");
	div_row.className = "row";

	div_time = document.createElement("div");
	div_time.className = "time";
	div_time.innerHTML = time;
	if(jud){
		div_time.style = "border-bottom-style: none;";
	}else{
		div_time.style = "border-top-style: none;border-bottom-style: none;";
	}

	div_pName = document.createElement("div");
	div_pName.className = "posi";
	div_pName.innerHTML = pName;
	div_pValue = document.createElement("div");
	div_pValue.className = "posi";
	div_pValue.innerHTML = pValue;

	div_nName = document.createElement("div");
	div_nName.className = "nega";
	div_nName.innerHTML = nName;
	div_nValue = document.createElement("div");
	div_nValue.className = "nega";
	div_nValue.innerHTML = nValue;

	div_row.appendChild(div_time);
	div_row.appendChild(div_pName);
	div_row.appendChild(div_pValue);
	div_row.appendChild(div_nName);
	div_row.appendChild(div_nValue);
	var element2 = div_row.cloneNode(true); // 要素を複製
	div_point.appendChild(element2);

}

window.onload = hyo_sel;
// window.onload = tes;
// window.onload = folding;
</script>
<title>曜日比較グラフ</title>
</head>
<body>
<?php
include ('w_graph_data_mon.php');
include ('w_graph_data_tue.php');
include ('w_graph_data_wed.php');
include ('w_graph_data_thu.php');
include ('w_graph_data_fri.php');
include ('w_graph_data_sat.php');
include ('w_graph_data_sun.php');
?>


<?php
//テスト用の値
	//週
// 	$prev = '日曜日';
// 	$week = '月曜日';
// 	$next = '火曜日';
	//単語
	$word = '楽しい';

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>


<div class="main">
<div id="header2">
		<div class="general-button" onclick="frameClick();" style="float: left; margin: 10px;">
			<div class="button-content">
				<span class="button-text">戻る</span>
			</div>
		</div>
	<h1>曜日ごとの比較</h1>
	<div class="clear" />
	<div class="clear" />
</div><!-- Fin_header2 -->

<div id="table">
<div class="note">
	<p>選択した曜日の、各時間ごとの<br/>全ツイートを表示しています。</p>
</div>
<form name="hyo">
<div>
	<select name="sel" onchange="hyo_sel()">
		<option value="Sun" selected="selected">日曜日</option>
		<option value="Mon">月曜日</option>
		<option value="Tue">火曜日</option>
		<option value="Wed">水曜日</option>
		<option value="Thu">木曜日</option>
		<option value="Fri">金曜日</option>
		<option value="Sat">土曜日</option>
	</select>
</div>
</form>
<div id="cell"></div>
</div><!--  Fin_table -->

<div class="main-gallery">	<!-- gitにjpgraphのimg版がある-->
	<img src="line_graph.php?con_mon_week1=<?=$con_mon_week1?>&con_mon_week2=<?=$con_mon_week2?>&con_mon_week3=<?=$con_mon_week3?>&con_mon_week4=<?=$con_mon_week4?>&con_mon_week5=<?=$con_mon_week5?>" alt="月曜日" class="gallery-cell"/>
	<img src="line_graph2.php?con_tue_week1=<?=$con_tue_week1?>&con_tue_week2=<?=$con_tue_week2?>&con_tue_week3=<?=$con_tue_week3?>&con_tue_week4=<?=$con_tue_week4?>&con_tue_week5=<?=$con_tue_week5?>" alt="火曜日" class="gallery-cell"/>
	<img src="line_graph3.php?con_wed_week1=<?=$con_wed_week1?>&con_wed_week2=<?=$con_wed_week2?>&con_wed_week3=<?=$con_wed_week3?>&con_wed_week4=<?=$con_wed_week4?>&con_wed_week5=<?=$con_wed_week5?>" alt="水曜日" class="gallery-cell"/>
	<img src="line_graph4.php?con_thu_week1=<?=$con_thu_week1?>&con_thu_week2=<?=$con_thu_week2?>&con_thu_week3=<?=$con_thu_week3?>&con_thu_week4=<?=$con_thu_week4?>&con_thu_week5=<?=$con_thu_week5?>" alt="木曜日" class="gallery-cell"/>
	<img src="line_graph5.php?con_fri_week1=<?=$con_fri_week1?>&con_fri_week2=<?=$con_fri_week2?>&con_fri_week3=<?=$con_fri_week3?>&con_fri_week4=<?=$con_fri_week4?>&con_fri_week5=<?=$con_fri_week5?>" alt="金曜日" class="gallery-cell"/>
	<img src="line_graph6.php?con_sat_week1=<?=$con_sat_week1?>&con_sat_week2=<?=$con_sat_week2?>&con_sat_week3=<?=$con_sat_week3?>&con_sat_week4=<?=$con_sat_week4?>&con_sat_week5=<?=$con_sat_week5?>" alt="土曜日" class="gallery-cell"/>
	<img src="line_graph7.php?con_sun_week1=<?=$con_sun_week1?>&con_sun_week2=<?=$con_sun_week2?>&con_sun_week3=<?=$con_sun_week3?>&con_sun_week4=<?=$con_sun_week4?>&con_sun_week5=<?=$con_sun_week5?>" alt="日曜日" class="gallery-cell"/>
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->

</body>
</html>