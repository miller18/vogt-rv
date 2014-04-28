<?php
    
    $sql = 'SELECT first_name, last_name, email_address, office_phone, cell_phone, title, photo FROM vrvEmployees WHERE location="South"' ;
    
    $result = $conn->query($sql) or die(mysqli_error());
    
?>

<ul>

    <?php while ($row = $result->fetch_assoc()) { ?>
    
    	<li>
			<div class="salesman">
				<img src="img/staff-photos/<?php echo $row['photo']; ?>">
				<p class="name"><?php echo $row['first_name']; ?><br> <?php echo $row['last_name']; ?></p>
				<p class="title"><?php echo $row['title']; ?></p>
				<p class="phone"><?php echo $row['office_phone']; ?></p>
				<a href="mailto:<?php echo $row['email_address']; ?>" class="orange-btn">Email <?php echo $row['first_name']; ?></a>
			</div>
		</li>
    
    <?php } ?>
        
</ul>