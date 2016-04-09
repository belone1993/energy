<?php
	function pagination($max, $count, $params){
		$page = ceil($count / $max);
		if(!isset($params)){
			$params = '';
		}else{
			$params = '&'.$params;
		}
		if(isset($_GET['page'])){
			$active_page = $_GET['page'];
		}else{
			$active_page = 1;
		}
		
		if($page < 8 && $page > 1){
			if($active_page == 1){
				echo "<a class='prev'>上一页</a>";
			}else{
				echo "<a href='?page=".($active_page - 1).$params."' class='prev'>上一页</a>";
			}
			
			for ($i=1;$i<=$page;$i++){
				if($i == $active_page){
					echo "<a href='?page=$i$params' class='active number'>$i</a>";
				}else {
				echo "<a href='?page=$i$params' class='number'>$i</a>";
				}
			}
			if($active_page == 7){
				echo "<a class='next'>下一页</a>";
			}else{
				echo "<a href='?page=".($active_page + 1).$params."' class='next'>下一页</a>";
			}
				
		}else if($page >7){
			if($active_page == 1){
				echo "<a class='prev'>上一页</a>";
				echo  "<a class='number active'>1</a>";
				echo  "<a href='?page=2$params' class='number'>2</a>";
				echo  "<a href='?page=3$params' class='number'>3</a>";
				echo  "<a  class='number'>...</a>";
				echo  "<a href='?page=".($page-1).$params."' class='number'>".($page-1)."</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=2$params' class='next'>下一页</a>";
			}else if($active_page == 2){
				echo "<a href='?page=1$params' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a class='number active'>2</a>";
				echo  "<a href='?page=3$params' class='number'>3</a>";
				echo  "<a  class='number'>...</a>";
				echo  "<a href='?page=".($page-1).$params."' class='number'>".($page-1)."</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=3$params' class='next'>下一页</a>";
			}else if($active_page == 3){
				echo "<a href='?page=2$params' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a href='?page=2$params' class='number'>2</a>";
				echo  "<a class='number active'>3</a>";
				echo  "<a href='?page=4$params' class='number'>4</a>";
				echo  "<a  class='number'>...</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=4$params' class='next'>下一页</a>";
			}else if($active_page == $page){
				echo "<a href='?page=".($page - 1).$params."' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a href='?page=2$params' class='number'>2</a>";
				echo  "<a  class='number'>...</a>";
				echo "<a href='?page=".($active_page-2).$params."' class='number'>".($active_page-2)."</a>";
				echo "<a href='?page=".($active_page-1).$params."' class='number'>".($active_page-1)."</a>";
				echo  "<a href='?page=$page$params' class='number active'>$page</a>";
				echo "<a class='next'>下一页</a>";
			}else if($active_page == ($page - 1)){
				echo "<a href='?page=".($page - 2).$params."' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a href='?page=2$params' class='number'>2</a>";
				echo  "<a  class='number'>...</a>";
				echo "<a href='?page=".($page-2).$params."' class='number'>".($page-2)."</a>";
				echo "<a href='?page=".($page-1).$params."' class='number active'>".($page-1)."</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=".($page).$params."' class='next'>下一页</a>";
			}else if($active_page == ($page - 2)){
				echo "<a href='?page=".($page - 3).$params."' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a  class='number'>...</a>";
				echo "<a href='?page=".($page-3).$params."' class='number'>".($page-3)."</a>";
				echo "<a href='?page=".($page-2).$params."' class='number active'>".($page-2)."</a>";
				echo "<a href='?page=".($page-1).$params."' class='number'>".($page-1)."</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=".($page - 1).$params."' class='next'>下一页</a>";
			}else{
				echo "<a href='?page=".($active_page - 1).$params."' class='prev'>上一页</a>";
				echo  "<a href='?page=1$params' class='number'>1</a>";
				echo  "<a  class='number'>...</a>";
				echo "<a href='?page=".($active_page-1).$params."' class='number'>".($active_page-1)."</a>";
				echo "<a href='?page=".($active_page).$params."' class='number active'>".($active_page)."</a>";
				echo "<a href='?page=".($active_page+1).$params."' class='number'>".($active_page+1)."</a>";
				echo  "<a  class='number'>...</a>";
				echo  "<a href='?page=$page$params' class='number'>$page</a>";
				echo "<a href='?page=".($active_page + 1).$params."' class='next'>下一页</a>";
			}
			
			
		}
		
		
	}
	
?>