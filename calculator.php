<?php
	class Calculator
	{
		public $split;
		public $new;
		public $answer = 0;

		// Initial function runs when instance of class is created
		public function __construct($equation)
		{
			// split string equation into array
			$pattern = "/[^\d.]|[\d.]++/";
			preg_match_all($pattern, $equation, $array);
			var_dump($array[0]);
			$this->split = $array[0];
			var_dump($this->split);

			// if the array is only 1 item, it is the answer
			// if(count($this->split) == 1)
			// {
			// 	echo count($this->split);
			// 	var_dumpt($this->split);
			// 	$this->answer = (int)$this->split;
			// 	return $this->answer;
			// } 
			// else
			// {
			// 	//if theres more than 1, loop through and find the operations
			// 	$this->loopArr($this->split);
			// }
		}

		public function get_Answer()
		{
			return $this->answer;
		}

		public function loopArr($equation)
		//this function is to find what operations exist. Currently tracking *, /, %, +, and -
		{
			public $multiple = false;
			public $division = false;
			public $module = false;
			public $addition = false;
			public $subtraction = false;

			if(count($equation) < 2)
			{
				echo "answer hereeee";
				$this->answer = (int)$equation;
			}
			else
			{
				for($i = 0; $i <= count($equation)-1; $i++)
				{
					switch($equation[$i])
					{
						case "*":
							echo "Multiple exists";
							$this->multiple = true;
							break;
						case "/":
							echo "Division exists";
							$this->division = true;
							break;
						case "%":
							echo "Module exists";
							$this->module = true;
							break;
						case "+":
							echo "Addition exists";
							$this->addition = true;
							break;
						case "-":
							echo "Subtraction exists";
							$this->subtraction = true;
							break;
					}
				}
				if ($this->multiple == true || $this->division == true || $this->module == true){
					//if there are multiplications, divisions, or modules, solve them first!
					$this->mult_div_mod($equation);
				}	
			}
		}

		public function mult_div_mod($equation)
		// this function is to multiply/divide/module parts of the array before adding or subtracting
		{
			echo "Multiply, divide, module function";
			for($i = 0; $i <= count($equation)-1; $i++)
			{
				switch($equation[$i])
				{
					case "*":
						echo "Multiple exists";
						$left = (int)$equation[$i - 1];
						$right = (int)$equation[$i + 1];
						$answer = $left * $right;
						var_dump($answer);
						$equation[$i-1] = (string)$answer;
						$this->split = $this->sliceEquation($equation, $i);
						echo "<br> New equation </br>";
						var_dump($this->new);
						$this->multiple = false;
						$this->loopArr($this->new);
						// die();
						// $this->loopArr($new);
						break;
					// case "/":
					// 	echo "Division exists";
					// 	$this->division = true;
					// 	break;
					// case "%":
					// 	echo "Module exists";
					// 	$this->module = true;
					// 	break;
				}
			}
		}

		public function add_subtract()
		{
			echo "Addition function";
		}

		public function sliceEquation($equation, $index)
		//when 2 numbers in the array are added/mult/divided etc together, we need to collapse the
		// array and have only the answer. i.e. ["2", "+", "2", "*", "4", "-", 3] needs to become
		// ["2", "+", "8", "-", "3"]
		{
			echo "Slice equation function";
			$left = array_slice($equation,0,$index);
			echo " Left <br>";
			var_dump($left);
			$right = array_slice($equation, $index);
			echo "Right <br>";
			array_shift($right);
			array_shift($right);
			var_dump($right);
			$this->new = array_merge($left, $right);
			echo "<br>slice equation answer<br>";
			var_dump($this->new);
			return $this->new;
			// $this->loopArr($this->split);
		}

	}

	$newEquation = new Calculator("4*4*10*2");
	var_dump($newEquation->split);
	// echo "the answer is " . $newEquation->split;

	// $int = 5;
	// var_dump($int);
	// $str = "$int";
	// var_dump($str);
	// $float = (int)$str;
	// var_dump($float);
	// $arr = array("a", "b", "c", "d");
	// $output = array_slice($arr, 2);
	// var_dump($output);
	// $testStr = "4*4-10*5*100/2%21+3";
	// echo $testStr;
	// $pattern = "/[^\d.]|[\d.]++/";
	// preg_match_all($pattern, $testStr, $return);
	// var_dump($return[0]);
	

?>
<html>
<head>
	<title>Calculator</title>
</head>
<body>
	<h1>Calculator</h1>
</body>
</html>