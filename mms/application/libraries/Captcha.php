<?php
	class Captcha
	{
	  	var	$width = '100';
		var $height = '34';
		var $num = '4';

		public function __construct($conf='')
		{	
			if($conf!='')
			{
				foreach ($conf as $key => $value) {
					$this->$key = $value;
				}
			}
		}

		public function show()
		{
			$w = $this->width;
			$h = $this->height;
			$fontsize = 6;
			$randcode="";

			$image = imagecreatetruecolor($w,$h);//创建画布
			$bgcolor = imageColorAllocate($image,255,255,255);
			imagefill($image, 0, 0, $bgcolor);

			//绘制干扰线
			for ($i=0; $i<100; $i++) 
			{ 
				$pointcolor = imageColorAllocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
				imagesetpixel($image,mt_rand(1,$w-1),mt_rand(1,$h-1),$pointcolor);

			}
			//绘制干扰线	
			for($i=0;$i<5;$i++)
			{
				$linecolor = imageColorAllocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
				imageline($image, mt_rand(1,$w-1),mt_rand(1,$h-1), mt_rand(1,$w-1), mt_rand(1,$h-1),$linecolor);
			}
			//产生随机字符
			for($i=0;$i<4;$i++)
			{
				$fontcolor = imageColorAllocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
				$data = 'abcdefghijklmnopqrstuvwxyz3456789';
				$font = substr($data,mt_rand(0,strlen($data)),1);

				$randcode.=$font;

				$x = $i*($w/4)+mt_rand(5,10);
				$y = mt_rand(7,12);
				imagestring($image,$fontsize, $x, $y,$font,$fontcolor);
			}
			$_SESSION[$this->name]=$randcode;
			header('Content-type:image/png');
			imagepng($image);
			imagedestroy($image);
		}
	}