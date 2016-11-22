//チェックボックスごとに判定する


function checked1(){
	var checker1 = document.forms.form1.check1.checked;
	var checker2 = document.forms.form1.check2.checked;
	var checker3 = document.forms.form1.check3.checked;
	var checker4 = document.forms.form1.check4.checked;
	var checker5 = document.forms.form1.check5.checked;
	var item = $('graph');

if (checker1 == false) {//1=F
	if (checker2 == false) {//2=F
		if (checker3 == false) {//3=F
			if(checker4 == false){//4=F
 				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data3=true&data4=true&data5=true\">");}//F F F F F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data3=true&data4=true\">");}//F F F F T
			}
			else{//4=T
				if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data3=true&data5=true\">");}//F F F T F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data3=true\">");}//F F F T T
			}
		}
		else{//3=T
			if(checker4 == false){//4=F
				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data4=true&data5=true\">");}//F F T F F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data4=true\">");}//F F T F T
			}
			else{//4=T
				if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data5=true\">");}//F F T T F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true\">");}//F F T T T
			}
		}
	}
	else{//2=T
		if (checker3 == false) {//3=F
			if(checker4 == false){//4=F
				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data1=true&data3=true&data4=true&data5=true\">");}//F T F F F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data3=true&data4=true\">");}//F T F F T
			}
			else{//4=T
				if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data1=true&data3=true&data5=true\">");}//F T F T F
				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data3=true\">");}//F T F T T
	 			}
		}
	 	else{//3=T
	 		if(checker4 == false){//4=F
	 			if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data1=true&data4=true&data5=true\">");}//F T T F F
	 			else{Element.update(item,"<img src=\"line_graph.php?data1=true&data4=true\">");}//F T T F T
	 		}
	 		else{//4=T
	 			if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data1=true&data5=true\">");}//F T T T F
	 			else{Element.update(item,"<img src=\"line_graph.php?data1=true\">");}//F T T T T
	 		}
		}
	}
}

else{//1=T
	if(checker2 == false) {//2=F
		if (checker3 == false) {//3=F
			if(checker4 == false){//4=F
	 				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data2=true&data3=true&data4=true&data5=true\">");}//T F F F F
	 				else{Element.update(item,"<img src=\"line_graph.php?data2=true&data3=true&data4=true\">");}//T F F F T
			}//4閉じ
			else{//4=T
		 			if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data2=true&data3=true&data5=true\">");}//T F F T F
					else{Element.update(item,"<img src=\"line_graph.php?data2=true&data3=true\">");}//T F F T T
			}//4閉じ
		}//3閉じ
		else{//3=T
			if(checker4 == false){//4=F
	 				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data4=true&data5=true\">");}//T F T F F
	 				else{Element.update(item,"<img src=\"line_graph.php?data1=true&data2=true&data4=true\">");}//T F T F T
			}//4閉じ
			else{//4=T
				if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data2=true&data5=true\">");}//T F T T F
 				else{Element.update(item,"<img src=\"line_graph.php?data2=true\">");}//T F T T T
			}//4閉じ
		}//3閉じ
	}//2閉じ
	else{//2=T
		if (checker3 == false) {//3=F
			if(checker4 == false){//4=F
				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data3=true&data4=true&data5=true\">");}//T T F F F
	 			else{Element.update(item,"<img src=\"line_graph.php?data3=true&data4=true\">");}//T T F F T
			}
			else{//4=T
	 			if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data3=true&data5=true\">");}//T T F T F
				else{Element.update(item,"<img src=\"line_graph.php?data3=true\">");}//T T F T T
			}
		}
		else{//3=T
			if(checker4 == false){//4=F
	 				if(checker5 == false){Element.update(item,"<img src=\"line_graph.php?data4=true&data5=true\">");}//T T T F F
	 				else{Element.update(item,"<img src=\"line_graph.php?data4=true\">");}//T T T F T
			}
			else{//4=T
		 			if (checker5 == false) {Element.update(item,"<img src=\"line_graph.php?data5=true\">");}//T T T T F
					else{Element.update(item,"<img src=\"line_graph.php\">");}//T T T T T
			}//4閉じ
		}//3閉じ
	}//2閉じ
}//1閉じ

}