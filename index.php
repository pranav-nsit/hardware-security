<!DOCTYPE HTML>

<html>
	<head>
		<title>Hardware Security</title>

	</head>
<body>
  
    
    
    <section >
        <h3> Hardware Security Attack and security countermeasures </h3>
        <p><a href="add-problems.php" >Add Problems</a></p>
        <p><a href="counter-measures.php" >Add counter measures</a></p>
    </section>

<section>
<div style="margin: 0 0 0 10%; float: left;" width="auto">
<h2>Problems:</h2>
       <form method="post" action="index.php">               
    <input type='hidden' name='result[]' />
     
           
     <?php

  $conn=mysqli_connect('hostname','database_user_name','database_password','database_name');
 
if(mysqli_connect_errno($conn))
{
		echo 'Cannot connect to server';
}
$query = "SELECT * FROM problems";
$problem = $conn->query($query);
if ($problem->num_rows > 0) {
  
    ?>
 
    <input type='hidden' name='result[]' />
           
    <?php

   while($one = $problem->fetch_assoc()) {
       
    echo "<input type='checkbox' name='result[]' style='align:left;' value='". $one['id']."'>". $one['name']." <br>";
       
    }
}
 ?>
           
   <input type='submit' name='submit' value='Submit'>


</form>                     
				</div>
    
  
    
    <div style="margin: 0 10% 0 0; float: right;" width="auto">
   <h2>Counter Measures:</h2>     
         
   
                    
     <?php

        
          $query = "SELECT * FROM solutions";
$solution = $conn->query($query);
if ($solution->num_rows > 0) 

{ 
    $n=0;
   
  if(!empty($_POST))
  {
    $problem=$_POST['result']; 
    $sid=array();
    $sid_new=array();
    
    $Num = count($problem);
    for($c=0; $c < $Num; $c++)
    {
        $pid= $problem[$c];
      $query = "SELECT * FROM problems WHERE id='$pid'";
	  $problems_q = $conn->query($query);
	  $one=$problems_q->fetch_assoc();
        $sid[($c*10)+0]=$one["f_id0"];
        $sid[($c*10)+1]=$one["f_id1"];
        $sid[($c*10)+2]=$one["f_id2"];
        $sid[($c*10)+3]=$one["f_id3"];
        $sid[($c*10)+4]=$one["f_id4"];
        $sid[($c*10)+5]=$one["f_id5"];
        $sid[($c*10)+6]=$one["f_id6"];
        $sid[($c*10)+7]=$one["f_id7"];
        $sid[($c*10)+8]=$one["f_id8"];
        $sid[($c*10)+9]=$one["f_id9"];
    }
    
    for($c=0; $c< ($Num*10);$c++)
    {

    	if($sid[$c]!=-1)
    	{
    		$mark=0;
    		for($j=0; $j<$n; $j++)
    		{
    			if($sid_new[$j]==$sid[$c])
    				$mark=1;
    		}
    		if($mark==0)
    		{
				    	$sid_new[]=$sid[$c];  
				    	$n++;  			
    		}

    	}
    	
    }
      
      
  }

   while($one = $solution->fetch_assoc()) {
       $mark=0;
       for($i=0; $i<$n; $i++)
       {
           if($sid_new[$i]==$one["sid"])
               $mark=1;
       }
       if($mark==1)
       {
           echo "<div style='background-color: #4CAF50; border: none; color: white; padding: 5px 5px; text-align: center;
    text-decoration: none; display: inline-block; font-size: 16px;'>".$one["sname"]."</div><br>";
       }
       else
       {
           echo "".$one["sname"]."<br> ";
       }
    }

}
    ?>        
				</div>
   
       
        </section>   


	</body>
</html>