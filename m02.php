<form method="post">
	<input type="text" name="input" placeholder="input" />
	<input type="text" name="key" placeholder="key" />
	<select name="method">
		<option value="encrypt">Encrypt</option>
		<option value="decrypt">Decrypt</option>
	</select>
	<input type="submit" value="Submit" />
</form>
<?php
if(isset($_POST['input'])){
	if($_POST['method'] == "encrypt")
		echo encrypt($_POST['input'], $_POST['key']);
	else
		echo decrypt($_POST['input'], $_POST['key']);
}
function encrypt($text, $key){
	$jml_text = strlen($text);
	$key = full_key($key, $jml_text);
	for($i = 0;$i < $jml_text;$i++){
		$besar = ctype_upper($text[$i]);
		$hasil[$i] = index_huruf(huruf_index($text[$i], $besar) + huruf_index($key[$i], $besar), $besar);
	}
	return implode($hasil);
}
function decrypt($text, $key){
	$jml_text = strlen($text);
	$key = full_key($key, $jml_text);
	for($i = 0;$i < $jml_text;$i++){
		$besar = ctype_upper($text[$i]);
		$hasil[$i] = index_huruf(huruf_index($text[$i], $besar) - huruf_index($key[$i], $besar) + 26, $besar);
	}
	return implode($hasil);
}
function full_key($key, $jml_text){
	$i = 0;
	while(strlen($key) != $jml_text){
		$key = $key.$key[$i];
		$i++;
	}
	return $key;
}
function huruf_index($huruf, $besar){
	$index_besar = range('A', 'Z') ;
	$index_kecil = range('a', 'z') ;
	if($besar)
		$hasil = array_search($huruf, $index_besar);
	else
		$hasil = array_search($huruf, $index_kecil);
	return $hasil;
}
function index_huruf($index, $besar){
	$index_besar = range('A', 'Z');
	$index_kecil = range('a', 'z');
	if($besar){
		if($index >= count($index_besar))
			$index = $index - count($index_besar);
		$hasil = $index_besar[$index]; 
	}
	else{
		if($index >= count($index_kecil))
			$index = $index - count($index_kecil);
		$hasil = $index_kecil[$index]; 
	}
	return $hasil;
}
?>