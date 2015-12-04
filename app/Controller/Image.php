<?php 
namespace Controller;

class Image extends \SlimController\SlimController
{

	public static function executeCommandThumbnailCreate($input, $output)
	{
		exec("convert -resize 200x240 $input -layers flatten $output ");
	}
}

?>