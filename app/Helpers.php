<?php

/**
 * @return string as AN IMAGE with full URL asset
 * @param array of ImageURLs ex.: [https://abc.jpg,https://efg.jpg]
 * @param position : 0 .. length of array - index of image
 */
if (!function_exists('getImageAt')) {
	function getImageAt(string $array = null, int $position)
	{
		if($array)
			if(json_decode(str_replace('\\','',$array))[$position] != '')
				return json_decode(str_replace('\\','',$array))[$position];
		return asset('storage/products/no-image.png');
	}
}

if (!function_exists('getLength')) {
	function getLength($array){
		if($array)
			return count(json_decode(str_replace('\\','',$array)));
		return 0;
	}
}


if (!function_exists('getCollection')){
	function getCollection($array) {
		$output = '<div style="width:10rem; height:5rem;overflow: hidden" uk-slider="center:true; finite :true; ">';
		$output .= '<ul class="uk-grid uk-slider-items uk-child-width-1-1">';
		if($array){
			$js = json_decode(str_replace('\\','',$array));
			foreach ($js as $item){
				$output .= '<li><img style="object-fit: cover;width:10rem; height:5rem;" src="'. $item . '"></li>';
			}
		}
		$output .= '</ul></div>';
		return $output;
	}
} 

if (!function_exists('unified_format')) {
	function unified_format($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
	
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);

		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}
}

if(!function_exists('numToText')){
	function numToText($amount)
	{
			$Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
			$TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
			$textnumber = "";
			$length = strlen($amount);
		
			for ($i = 0; $i < $length; $i++)
			$unread[$i] = 0;
		
			for ($i = 0; $i < $length; $i++)
			{              
				$so = substr($amount, $length - $i -1 , 1);               
			
				if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
					for ($j = $i+1 ; $j < $length ; $j ++)
					{
						$so1 = substr($amount,$length - $j -1, 1);
						if ($so1 != 0)
							break;
					}                      
						
					if (intval(($j - $i )/3) > 0){
						for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
							$unread[$k] =1;
					}
				}
			}
		
			for ($i = 0; $i < $length; $i++)
			{       
				$so = substr($amount,$length - $i -1, 1);      
				if ($unread[$i] ==1)
				continue;
			
				if ( ($i% 3 == 0) && ($i > 0))
				$textnumber = $TextLuythua[$i/3] ." ". $textnumber;    
			
				if ($i % 3 == 2 )
				$textnumber = 'trăm ' . $textnumber;
			
				if ($i % 3 == 1)
				$textnumber = 'mươi ' . $textnumber;
			
			
				$textnumber = $Text[$so] ." ". $textnumber;
			}
		
			$textnumber = str_replace("không mươi", "lẻ", $textnumber);
			$textnumber = str_replace("lẻ không", "", $textnumber);
			$textnumber = str_replace("mươi không", "mươi", $textnumber);
			$textnumber = str_replace("một mươi", "mười", $textnumber);
			$textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
			$textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
			$textnumber = str_replace("mười năm", "mười lăm", $textnumber);
		
			// return ucfirst($textnumber." đồng chẵn");
			return ucfirst($textnumber);

	}
}

if(!function_exists('toCurrency')){
	function toCurrency($num, $str='đ'){
		return number_format($num, 0, ',', '.').' '.$str;
	} 
}

if(!function_exists('getCategoriesTree')){
	function getCategoriesTree($categories, $parent_id = 0, $char = '')
	{
		$html = '';
		foreach ($categories as $key => $item) {
			if ($item->parent_id == $parent_id) {
				$html .= '
					<tr>
						<td>' . $item->id . '</td>
						<td>' . $char . $item->name . '</td>
						<td>' . checkStatus($item->id, $item->status) . '</td>
						<td><button class="uk-button-primary uk-icon-button" type="submit" onclick="window.location.href=\''.route("admin.category.edit", $item->id).'\'"><span uk-icon="pencil"></span></button></td>
						<td><button class="uk-button-danger uk-icon-button" type="submit" onclick="window.location.href=\''.route("admin.category.destroy", $item->id).'\'"><span uk-icon="close"></span></button></td>
					</tr>
				';
				$id = $item->id;
				unset($categories[$key]);

				$html .= getCategoriesTree($categories, $item->id, $char . ' ' . $parent_id . ' 👉 ');
			}
		}

		return $html;
	}
}

if(!function_exists('checkStatus')){
	function checkStatus($id, $status): string
	{
		return '<button data-id="'.$id.'" class="check-status uk-button-'. ($status == 1 ? 'secondary' : 'default').' uk-icon-button  uk-form-small" type="button"><span uk-icon="'. ($status == 1 ? 'check' : 'close').'"></span></button>';
	}
}

if(!function_exists('copyr')){
	function copyr($source, $dest)
	{
	// Simple copy for a file
	if (is_file($source)) {
		return copy($source, $dest);
	}

	// Make destination directory
	if (!is_dir($dest)) {
		mkdir($dest);
	}

	// Loop through the folder
	$dir = dir($source);
	while (false !== $entry = $dir->read()) {
		// Skip pointers
		if ($entry == '.' || $entry == '..') {
			continue;
		}

		// Deep copy directories
		if ($dest !== "$source/$entry") {
			copyr("$source/$entry", "$dest/$entry");
		}
	}

	// Clean up
	$dir->close();
	return true;
	}
}

if(!function_exists('rrmdir')){
	function rrmdir($dir) { 
		if (is_dir($dir)) { 
		  $objects = scandir($dir);
		  foreach ($objects as $object) { 
				if ($object != "." && $object != "..") { 
					if (is_dir($dir. DIRECTORY_SEPARATOR .$object) 
						&& !is_link($dir."/".$object))
					rrmdir($dir. DIRECTORY_SEPARATOR .$object);
					else
					unlink($dir. DIRECTORY_SEPARATOR .$object); 
				} 
		  }
		  rmdir($dir); 
		} 
	}
}