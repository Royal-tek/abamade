
<nav class="woocommerce-pagination">
   
<ul class="page-numbers">
    <?php 
        if($page_no > 1){
             echo "<li class=''>
                <a class='page-numbers btn btn--gray' href='?page=1&".$url_string."'>First Page</a>
             </li>"; 
        } 
    ?>
    
    <li class='
    <?php 
        if($page_no <= 1){ 
            echo " disabled"; 
        } 
    ?> '>
	<a class='page-numbers  btn btn--gray' <?php if($page_no > 1){ echo " href='?page=$previous_page&$url_string' "; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class=''><a class='page-numbers current btn btn--gray' onclick='return false'>$counter</a></li>";	
				}else{
           echo "<li class=''><a class='page-numbers btn btn--gray' href='?page=$counter&".$url_string."'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class=''><a class='page-numbers current'>$counter</a></li>";	
				}else{
           echo "<li><a class='page-numbers' href='?page=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page=1'>1</a></li>";
		echo "<li><a href='?page=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class=''><a class='current'>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page=1'>1</a></li>";
		echo "<li><a href='?page=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class=''><a class='current'>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li class='' <?php if($page_no >= $total_no_of_pages){ echo "class=''"; } ?>>
	<a class='page-numbers btn btn--gray' <?php if($page_no < $total_no_of_pages) { echo "href='?page=$next_page&".$url_string."'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class=''><a class='page-numbers btn btn--gray' href='?page=$total_no_of_pages&".$url_string."'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>

    
	</nav>