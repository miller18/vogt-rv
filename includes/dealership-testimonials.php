<?php

    
    //require_once('includes/connection.inc.php');
   
    //$conn = dbConnect('write');
   
    $sql = "SELECT 
                customer_name,
                testimonial_text
                FROM vrvTestimonials
                ORDER BY RAND()
                LIMIT 1";
    
    // submit the query and capture the result
    
    $result = $conn->query($sql) or die(mysqli_error($conn));
    

?>

        <div class="row">
		    <div class="twelve columns testimonial">
		    
		        <?php while ($row = $result->fetch_assoc()) { 
		        
		            $position=200; // Define how many characters you want to display.

                    $message= $row['testimonial_text'];
                     
                    // Find what is the last character.
                    $testimonial = substr($message,$position,1);
                    
                    // In this step, if the last character is not " "(space) run this code.
                    // Find until we found that last character is " "(space) 
                    // by $position+1 (14+1=15, 15+1=16 until we found " "(space) that mean character no.20) 
                    
                    if ($testimonial !=" "){
                    
                        while ($testimonial !=" "){
                            $i=1;
                            $position=$position+$i;
                            $message= $row['testimonial_text']; 
                            $testimonial = substr($message,$position,1); 
                            }
                        }
                    
                    $testimonial = substr($message,0,$position); 
                                    
                ?>
		    
			        <h5 class="dealer-testimonial"><?php echo strip_tags($testimonial); ?>  ...</h5> 
			        <p class="testimonial-author"><?php echo $row['customer_name']; ?></p>
			    
			    <?php } ?>
			    
		    </div>
		</div>
		
		
		
		
			    
		            
		         
