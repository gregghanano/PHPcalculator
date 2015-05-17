<?php
	class Calculator
	{
		public $split;
		public $multiple = false;
		public $division = false;
		public $module = false;
		public $addition = false;
		public $subtraction = false;

		public function __construct($equation)
		{
			$this->split = str_split($equation);
			$this->loopArr($this->split);
		}

		public function get_splitEquation()
		{
			return $this->split;
		}

		public function loopArr($equation)
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
			if ($this->multiple == true || $this->division == true || $this->module==true){
				echo "Multiply!";
				$this->mult_div_mod($equation);
			}	
		}

		public function mult_div_mod($equation)
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

	}

	$newEquation = new Calculator("4+4+5*2-4*5/1");
	var_dump($newEquation);

	// $int = 5;
	// var_dump($int);
	// $str = "$int";
	// var_dump($str);
	// $float = (int)$str;
	// var_dump($float);

?>
<html>
<head>
	<title>Calculator</title>
</head>
<body>
	<h1>Calculator</h1>
</body>
</html>