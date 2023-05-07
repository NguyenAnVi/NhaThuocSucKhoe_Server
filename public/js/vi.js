function removeAccents(str) {
	var AccentsMap = [
		"aàảãáạăằẳẵắặâầẩẫấậ",
		"AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
		"dđ", "DĐ",
		"eèẻẽéẹêềểễếệ",
		"EÈẺẼÉẸÊỀỂỄẾỆ",
		"iìỉĩíị",
		"IÌỈĨÍỊ",
		"oòỏõóọôồổỗốộơờởỡớợ",
		"OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
		"uùủũúụưừửữứự",
		"UÙỦŨÚỤƯỪỬỮỨỰ",
		"yỳỷỹýỵ",
		"YỲỶỸÝỴ"    
	];

	for (var i=0; i<AccentsMap.length; i++) {
		var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
		var char = AccentsMap[i][0];
		str = str.replace(re, char);
	}
	return str;
}

function showPrice(){
  let price = $('#price').data('price')
  let saleoffprice = $('#price').data('saleoffprice')
  if(saleoffprice != 0) {
    $('#price').html(currency(saleoffprice)).append(`<span style="font-size:1rem; color:gray; text-decoration-line:line-through; font-weight:500; margin-left:20px">${currency(price)}</span>`);
  }
}

function currency(num){
	let dong = Intl.NumberFormat('vi-VN', {
		style: 'currency',
		currency: 'VND',
	});
	return dong.format(parseInt(num));
}

function parseImages(str){
  return str.substring(2,str.length-2).split("\",\"");
}

function getImageAt(str_arr, index = 0){
  let result = "";
  console.log(parseImages(str_arr));
  result = parseImages(str_arr)[index];
  return result
}