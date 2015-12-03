<?php 
namespace Controller;

class Image
{

	public function executeCommandThumbnailCreate($input, $output)
	{
		exec("convert -resize 100x140 $input -layers flatten $output ");
	}
}

?>