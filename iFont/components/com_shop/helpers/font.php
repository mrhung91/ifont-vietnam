<?php
define('FONT_SIZE', 48);
define('FONT_WIDTH', 680);
define('FONT_MAX_WIDTH', 640);
define('FONT_MAX_HEIGHT', 109);
define("ALIGN_LEFT", "left");
define("ALIGN_CENTER", "center");
define("ALIGN_RIGHT", "right");

class ShopHelperFont {

	public static function render($fontId, $font_file, $text, $font_size = null) {
		$tmp_dir = JPATH_SITE . DS . "tmp" . DS . "font";
		if ($font_size == null) {
			$font_size = FONT_SIZE;
			$height = FONT_MAX_HEIGHT;
		} else {
			$height = $font_size * 1.7;
		}
		$width = FONT_WIDTH;

		// create canvas object for image
		$canvas = imagecreatetruecolor($width, $height);

		// paint background onto canvas
		ShopHelperFont::paintBackground($canvas, $height, $width);

		// print the text onto the canvas
		ShopHelperFont::printText($canvas, $text, $font_file, $font_size, $height);

		// set temporary file name
		$fileName = $fontId . base64_encode($text) . $font_size . ".png";
		$filePath = $tmp_dir . DS . $fileName;
		if (!file_exists($filePath)) {
			imagepng($canvas, $filePath);
		}

		$fileUrl = "/tmp/font/" . $fileName;

		// clean up after ourselves so we don't cause a memory leak
		imagedestroy($canvas);

		// return the image name
		return $fileUrl;
	}


	private static function paintBackground(&$canvas, $height, $width) {
		// get background color
		$bgColor = ShopHelperFont::allocateImageColorFromHex($canvas, "#ffffff");

		// create a filled rectangle to form the canvas background
		return imagefilledrectangle(
			$canvas,
			0,						// x-coordinate for point 1
			0, 						// y-coordinate for point 1
			$width, 				// x-coordinate for point 2
			$height, 				// y-coordinate for point 2
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

		if (strlen($color) == 6) {
			list($r, $g, $b) = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
		} elseif (strlen($color) == 3) {
			list($r, $g, $b) = array($color[0], $color[1], $color[2]);
		} else {
			return false;
		}

		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

		return array($r, $g, $b);
	}

	private static function printText(&$canvas, $text, $font, $font_size, $height) {
		$fontColor = ShopHelperFont::allocateImageColorFromHex($canvas, 'red');
		$top = ($height + $font_size) / 2;
		//imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
		ShopHelperFont::imagettftextbox($canvas, $font_size, 0, 20, $top, $fontColor, $font, $text, FONT_MAX_WIDTH);
	}

	private function imagettftextbox(&$image, $size, $angle, $left, $top, $color, $font, $text, $max_width, $max_line = 1) {
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