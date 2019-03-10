<?php

    class connectDataBase
	{
		public $link = "";
		function __construct()
		{
			// 配置数据库链接参数：地址、用户名、密码、数据库名
			$host = 'localhost';
			$user = 'root';
            $pass = 'Zcy123456';
			$db_name = 'ecis';
			$timezone="Asia/Shanghai";

			if ($link = mysqli_connect($host,$user,$pass)) {
				mysqli_select_db($link,$db_name);
				mysqli_query($link,"set names 'UTF8'");
				$this->link = $link;
				//echo "数据库连接成功！";
            } else {
				echo "数据库连接失败！";
				exit;
			}
		}
	
		/**
		 * 检测与过滤服务器接收到的数据
		 * @method test_input
		 * @param  string     $data 传入需要检测的数据
		 * @return string           返回过滤过的数据
		 */
		public function test_input($data)
		{
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  $data = preg_replace('/&amp;/','&',$data);
		  return $data;
		}
	}

?>
