<?php

if(isset($_POST['submit'])) {
	searchemail($search);
} else {
	echo "<a href='searchemail.html'>Go back to search</a>";
}	

function listdir($dir='.') { 
    if (!is_dir($dir)) { 
        return false; 
    } 
    
    $files = array(); 
    listdiraux($dir, $files); 

    return $files; 
} 

function listdiraux($dir, &$files) { 
    $handle = opendir($dir); 
    while (($file = readdir($handle)) !== false) { 
        if ($file == '.' || $file == '..') { 
            continue; 
        } 
        $filepath = $dir == '.' ? $file : $dir . '/' . $file; 
        if (is_link($filepath)) 
            continue; 
        if (is_file($filepath)) 
            $files[] = $filepath; 
        else if (is_dir($filepath)) 
            listdiraux($filepath, $files); 
    } 
    closedir($handle); 
} 

function searchemail($search) {

	$start = time();

	$path = '/home/sosvolunteertrip/public_html';
	$files = listdir($path); 
	sort($files, SORT_LOCALE_STRING); 

	//write the string you want to search here
	$search=$_POST['$search'];
	$count=0;
	$found=0;
	$numoffiles=0;
	$maxsize = 1000000;

	echo "Searching for: ".$search." in ".$path."<br><br>";

	foreach ($files as $f) {
		if (filesize($f) < $maxsize) {
			$numoffiles++;
			echo "<script>console.log('".$numoffiles."');</script>";
			$file1 = file_get_contents($f);
			if (strpos($file1, $search)==true) {
				 $found++;
				 echo  $f." YAY<br>";
			} else {
				//echo  $f." NOO<br>";
			} 
		}
	} 

	$end = time();
	echo "<br>done searching. ".($end - $start)." sec<br> Found <b>". $found . "</b> files<br>total files: ".count($files)."<br>";
	echo "number of files under ".$maxsize." bytes: ".$numoffiles."<br><br><br>";
	echo "<a href='searchemail.html'>Go back to search</a>";
}
?>
