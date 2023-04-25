
	<div id ="footer">Copyright 20<?php echo date("y,");?>, A Comp</div>

</body>
</html>
<?php
if (isset($connection)){
mysqli_close($connection);
}
?> 
