<?php
include '../DBManager.php';
set_time_limit(0);//処理制限時間を無期限に
$y = (string)date("Y"); //検索する年
$m = (string)date("m"); //検索する月
$d = (string)date("d"); //検索する日
//データ検索
$data = tweets_search(array("year"=>$y,"month"=>$m,"day"=>$d),null,array("month"=>1,"day"=>1));
foreach ($data as $key =>$value){
	if(isset($value['noun']) && isset($value['adjective'])){
		$day[$value['hour']] = (array)$value['noun'];
		$day[$value['hour']] += (array)$value['adjective'];
	}
	elseif(isset($value['noun'])){
		$day[$value['hour']] = (array)$value['noun'];
	}
	elseif(isset($value['adjective'])){
		$day[$value['hour']] = (array)$value['adjective'];
	}
}

foreach ($day as $key =>$value){//配列weekにあるnullを取り除く
	foreach ($value as $key2 =>$value2){
		if(empty($value2)){unset($day[$key][$key2]);}
	}
}


foreach ($day as $key =>$value){
	if(is_array($value)){
		$day_time[$key] = array();//入れる箱作り

		foreach ($value as $key2 =>$value2){//時ごと
			if(!empty($day[$key][$key2])){//値が入っている場合
				$p_name = max(array_keys($day[$key],max($day[$key])));
				$p_value = max($day[$key]);
				$n_name = min(array_keys($day[$key],min($day[$key])));
				$n_value = min($day[$key]);

				if($p_value <= 0){//ポジティブワードの値がマイナスの場合、削除
					$p_name = '';
					$p_value = '';
					unset($day[$key][$n_name]);
				}
				elseif($n_value >= 0){//ネガティブワードの値がプラスの場合、削除
					$n_name = '';
					$n_value = '';
					unset($day[$key][$p_name]);
				}else{//使用済みの値を取り出す
					unset($day[$key][$p_name]);
					unset($day[$key][$n_name]);
				}
				//week_time[週][曜日][時][個数] = ポジティブワード、値、ネガティブワード、値、を挿入
				array_push($day_time[$key], array("p_name"=>$p_name, "p_value"=>$p_value, "n_name"=>$n_name, "n_value"=>$n_value));
			}
			ksort($day_time);

		}
	}
}

//javascriptに配列を送るために変換
$array = json_encode($day_time);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>
<script type="text/javascript">
var day = JSON.parse('<?php echo  $array; ?>');

function hyo_sel(){//insert:表を挿入するdivID,
	var Re = document.getElementById("cell");//表を挿入するdivを取得
	Re.textContent = null;
	folding(Re, "day_01", "今日のデータ", true);

	var div_point = document.createElement("div");
	div_point.id = "point";
	div_point.style = "border:solid 1px #AAA";
	var id = document.getElementById("day_01");
	cell_title(id, div_point, "時間", "ポジティブワード", "数値", "ネガティブワード", "数値");
	keys = Object.keys(day);
	len = keys.length;
	keys.sort();
	for (i = 0; i < len; i++) {
		key2 = keys[i];
			for(key3 in day[key2]){
			var time = key2;
			var pName = day[key2][key3]['p_name'];
			var pValue = day[key2][key3]['p_value'];
			var nName = day[key2][key3]['n_name'];
			var nValue = day[key2][key3]['n_value'];

			if(key3 <= 0){
				cell_value(true, div_point, time, pName, pValue, nName, nValue);
			}else{
				cell_value(false, div_point, "", pName, pValue, nName, nValue);
			}
		}
	}

}

//Re:挿入先, id:何週目,
function folding(Re, id, text, jud){//折り畳みページを挿入
	//折りたたみ展開ポインタ
	var div_title = document.createElement("div");
	div_title.onclick = function (){
		obj=document.getElementById(id).style;
		obj.display=(obj.display=='none')?'block':'none';
	}
	div_title.innerHTML = "<a style='cursor:pointer;'>"+text+"</a>";

	//折りたたまれ部分
	var div_contents = document.createElement("div");
	div_contents.id = id;
	if(jud){//展開済みにするのか判定
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
</script>
</head>
<body>
<div id="cell"></div>
</body>
</html>