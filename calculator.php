<?php
	class Calculator
	{
		public function __construct($equation)
		{
			$arr = str_split($equation);
			var_dump($arr);
		}
	}
?>
<html>
<head>
	<title>Calculator</title>
</head>
<body>
	<h1>Calculator</h1>
</body>
</html>