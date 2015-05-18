<?php
	class Calculator
	{
		public $split;
		public $answer = 0;

		public $multiple = false;
		public $division = false;
		public $modulus = false;
		public $addition = false;
		public $subtraction = false;

		public function __construct($equation)
		// Initial function runs when instance of class is created
		{
			echo "The submitted equation is " . $equation . "<br>";
			// split string equation into array
			// used this link to understand regex:
			// http://forums.phpfreaks.com/topic/238685-regex-to-break-apart-math-equations/
			$pattern = "/[^\d.]|[\d.]++/";
			preg_match_all($pattern, $equation, $array);
			$this->split = $array[0];
			var_dump($this->split);
			$this->loopArr($this->split);
		}

		public function loopArr($equation)
		//this function is to find what operations exist. Currently tracking *, /, %, +, and -
		{
			$this->multiple = false;
			$this->division = false;
			$this->modulus = false;
			$this->addition = false;
			$this->subtraction = false;

			if(count($equation) < 2)
			//if the equation is less than 2, then that's the answer!
			{
				$this->answer = (float)$equation[0];
				return;
			}
			else
			{
				//loop through the equation and find what operations exist
				for($i = 0; $i <= count($equation)-1; $i++)
				{
					switch($equation[$i])
					{
						case "*":
							$this->multiple = true;
							break;
						case "/":
							$this->division = true;
							break;
						case "%":
							$this->modulus = true;
							break;
						case "+":
							$this->addition = true;
							break;
						case "-":
							$this->subtraction = true;
							break;
					}
				}
			}
			if ($this->multiple == true || $this->division == true || $this->modulus == true)
			{
				//if there are multiplications, divisions, or moduluses (modulai?),
				//solve them first!
				$this->mult_div_mod($equation);
			}
			elseif ($this->addition == true || $this->subtraction == true)
			{
				$this->add_subtract($equation);
			}
			else
			{
				echo "Don't leave spaces in the equation! <br>";
			}
		}

		public function mult_div_mod($equation)
		// this function is to multiply/divide/modulus parts of the array before adding or subtracting
		{
			//loop through the equation, from left to right the first *,/, or %.
			for($i = 0; $i <= count($equation)-1; $i++)
			{
				switch($equation[$i])
				{
					case "*":
						$left = (float)$equation[$i - 1];
						$right = (float)$equation[$i + 1];
						$tempAnswer = $left * $right;
						$equation[$i-1] = (string)$tempAnswer;
						$this->split = $this->sliceEquation($equation, $i);
						//recrusively start the loop all over with the new equation
						return $this->loopArr($this->split);
						break;
					case "/":
						$left = (float)$equation[$i - 1];
						$right = (float)$equation[$i + 1];
						$tempAnswer = $left/$right;
						$equation[$i-1] = (string)$tempAnswer;
						$this->split = $this->sliceEquation($equation, $i);
						//recrusively start the loop all over with the new equation
						return $this->loopArr($this->split);
						break;
					case "%":
					 	$left = (float)$equation[$i - 1];
					 	$right = (float)$equation[$i + 1];
					 	$tempAnswer = $left%$right;
					 	$equation[$i-1] = (string)$tempAnswer;
					 	$this->split = $this->sliceEquation($equation, $i);
					 	//recrusively start the loop all over with the new equation
					 	return $this->loopArr($this->split);
					 	break;
				}
			}
		}

		public function add_subtract($equation)
		// this function is to add or subtract parts of the array after multiplication/division/modulus
		{
			//loop through equation. no *,/,% should be present. Left to right, solve + or -
			for($i = 0; $i <= count($equation)-1; $i++)
			{
				switch($equation[$i])
				{
					case "+":
						$left = (float)$equation[$i - 1];
						$right = (float)$equation[$i + 1];
						$tempAnswer = $left + $right;
						$equation[$i-1] = (string)$tempAnswer;
						$this->split = $this->sliceEquation($equation, $i);
						//recrusively start the loop all over with the new equation
						return $this->loopArr($this->split);
						break;
					case "-":
						$left = (float)$equation[$i - 1];
						$right = (float)$equation[$i + 1];
						$tempAnswer = $left - $right;
						$equation[$i-1] = (string)$tempAnswer;
						$this->split = $this->sliceEquation($equation, $i);
						//recrusively start the loop all over with the new equation
						return $this->loopArr($this->split);
						break;
				}
			}
		}

		public function sliceEquation($equation, $index)
		//when 2 numbers in the array are added/mult/divided etc together, we need to collapse the
		//array and have only the answer. i.e. ["2", "+", "2", "*", "4", "-", 3] needs to become
		//["2", "+", "8", "-", "3"]
		{
			$left = array_slice($equation,0,$index);
			$right = array_slice($equation, $index);
			array_shift($right);
			array_shift($right);
			return array_merge($left, $right);
		}

	}

	// Add your equation as a string or create a new object
	// i.e. $newObj = new Calculator("9-5+10*2/1%2");
	// please DO NOT leave spaces in the equation! (dont do "3 + 4". do "3+4")
	$newEquation = new Calculator("7*5+10/2%2+7-4");
	echo "The answer is " . $newEquation->answer;
	//I spent about 12 hours working on this

?>