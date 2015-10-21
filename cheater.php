<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		 $tmp=0;
	 	if($_POST["radiogroup"]=="visa"){
	 		if(preg_match("/^4/", $_POST["credit_card"])) $tmp=1;
	 	}else if($_POST["radiogroup"]=="masterCard"){
	 		if(preg_match("/^5/", $_POST["credit_card"])) $tmp=1;
	 	}
		 if (!(isset($_POST["Name"])) || empty($_POST["Name"]) || !(isset($_POST["ID"])) || empty($_POST["ID"]) || !(isset($_POST["credit_card"])) || empty($_POST["credit_card"])){
		?>

		<h1>Sorry</h1>
		<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>

		<!-- Ex 4 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		--> 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		 } elseif (!preg_match("/^[a-zA-Z]+([\-]?[a-zA-Z]+)*([ ]?[a-zA-Z]+)([\-]?[a-zA-Z]+)*$/", $_POST["Name"])) {

		?>

			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		 } elseif (!preg_match("/[0-9]{16}/", $_POST["credit_card"]) || $tmp==0) {
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?=$_POST["Name"]?></li>
			<li>ID: <?=$_POST["ID"]?> </li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: 			
				<?php
					$ID="";
					$names=["CSE326","CSE107","CSE603","CIN870"];
					$ID=processCheckbox($names);
				?>
			<?=$ID?></li>
			<li>Grade: <?=$_POST["grade"]?></li>
			<?php
				if(isset($_POST["visa"])){
					$card="visa";
				}else{
					$card="mastercard";
				}
			?>
			<li>Credit Card: <?=$_POST["credit_card"]?> (<?=$card?>)
			</li>
		</ul>
		
		<!-- Ex 3 : 
			<p>Here are all the loosers who have submitted here:</p> -->
		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			$file_string=$_POST["Name"].";".$_POST["ID"].";".$_POST["credit_card"].";".$card;
			$current=" ";
			if(!(file_exists($filename))){
				file_put_contents($filename, $current);
			} 
			$current=file_get_contents($filename);
			$current.=$file_string."\n<br/>";
			file_put_contents($filename, $current);
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

		<?php
			$file_content=file_get_contents($filename);
		?>
		
		<pre>
		<p>Here are all the loosers who have submitted here:<br/></p>
		<p><?=$file_content?></p>
		</pre>		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
		}
					function processCheckbox($names){
				$result="";
				foreach ($names as $value) {
					if(isset($_POST[$value])){
						if($_POST[$value]=="on"){
							$result.=$value.", ";
						}
					}	
				}
				$result=substr($result,0,-2);
				return $result;
			}
		?>
		
	</body>
</html>
