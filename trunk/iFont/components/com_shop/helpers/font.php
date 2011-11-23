<?php
define('FONT_WIDTH', 680);
define('FONT_MAX_WIDTH', 640);
define('FONT_MAX_HEIGHT', 109);
define("ALIGN_LEFT", "left");
define("ALIGN_CENTER", "center");
define("ALIGN_RIGHT", "right");

class ShopHelperFont {

	public static function render($fontId, $font_file, $text) {
		$tmp_dir = JPATH_SITE . DS . "tmp" . DS . "font";

		// create canvas object for image
		$canvas = imagecreatetruecolor(FONT_WIDTH, FONT_MAX_HEIGHT);

		// paint background onto canvas
		ShopHelperFont::paintBackground($canvas);

		// print the text onto the canvas
		ShopHelperFont::printText($canvas, $text, $font_file);

		// set temporary file name
		$fileName = "img_" . $fontId . "_" . time() . ".png";
		$filePath = $tmp_dir . DS . $fileName;
		imagepng($canvas, $filePath);

		$fileUrl = JURI::base() . "/tmp/font/" . $fileName;

		// clean up after ourselves so we don't cause a memory leak
		imagedestroy($canvas);

		// return the image name
		return $fileUrl;
	}


	private static function paintBackground(&$canvas) {
		// get background color
		$bgColor = ShopHelperFont::allocateImageColorFromHex($canvas, "#ffffff");

		// create a filled rectangle to form the canvas background
		return imagefilledrectangle(
		$canvas,
		0,						// x-coordinate for point 1
		0, 						// y-coordinate for point 1
		FONT_WIDTH, 	// x-coordinate for point 2
		FONT_MAX_HEIGHT, // y-coordinate for point 2
		$bgColor
		);
	}

	private static function allocateImageColorFromHex(&$canvas, $hexColor) {
		// get RGB equivalent from hex code passed
		$rgb =  ShopHelperFont::hex2rgb($hexColor);

		// allocate the color for the image and return its identifier
		return imagecolorallocate($canvas, $rgb[0], $rgb[1], $rgb[2]);
	}

	private static function hex2rgb($color)
	{
		if ($color[0] == '#')
		$color = substr($color, 1);

		if (strlen($color) == 6)
		list($r, $g, $b) = array($color[0].$color[1],
		$color[2].$color[3],
		$color[4].$color[5]);
		elseif (strlen($color) == 3)
		list($r, $g, $b) = array($color[0], $color[1], $color[2]);
		else
		return false;

		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

		return array($r, $g, $b);
	}

	private static function printText(&$canvas, $text, $font) {
		$fontColor = ShopHelperFont::allocateImageColorFromHex($canvas, 'red');
		//imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
		ShopHelperFont::imagettftextbox($canvas, 48, 0, 20, 72, $fontColor, $font, $text, FONT_MAX_WIDTH);
	}

	private function imagettftextbox(&$image, $size, $angle, $left, $top, $color, $font, $text, $max_width) {
		$align = ALIGN_LEFT;
		$text_lines = explode("\n", $text); // Supports manual line breaks!

		$lines = array();
		$line_widths = array();

		$largest_line_height = 0;

		$block = $text_lines[0];
		$current_line = ''; // Reset current line

		$words = explode(' ', $block); // Split the text into an array of single words

		$first_word = TRUE;

		$last_width = 0;

		for($i = 0; $i < count($words); $i++) {
			$item = $words[$i];
			$dimensions = imagettfbbox($size, $angle, $font, $current_line . ($first_word ? '' : ' ') . $item);
			$line_width = $dimensions[2] - $dimensions[0];

			if($line_width > $max_width) {
				$line_width = $last_width;
				$chars = str_split($item);
				$current_line .= ($first_word ? '' : ' ');
				foreach ($chars as $char) {
					$dimensions = imagettfbbox($size, $angle, $font, $current_line . $char);
					$line_width = $dimensions[2] - $dimensions[0];
					if ($line_width > $max_width) {
						$line_width = $last_width;
						break;
					} else {
						$current_line .= $char;
						$last_width = $line_width;
					}
				}
				break;
			} else {
				$current_line .= ($first_word ? '' : ' ') . $item;
			}
			$last_width = $line_width;
			$first_word = FALSE;
		}

		$left_offset = 0;
		if($align == ALIGN_CENTER) {
			$left_offset = ($max_width - $line_width) / 2;
		} elseif($align == ALIGN_RIGHT) {
			$left_offset = ($max_width - $line_width);
		}
		imagettftext($image, $size, $angle, $left + $left_offset, $top, $color, $font, $current_line);

		return true;
	}

}
?>