<?php
// Generate random Background
function PutRandomBG() {
					$root = $_SERVER['DOCUMENT_ROOT'];
                    $path = "/resources/bgs/"; 
					$dir = $root . $path;

					$tmp = array();
					
					if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            while (($file = readdir($dh)) !== false) {
                                if (!in_array($file, array(".", ".."))) {
                                    $tmp[] = $file;
                                }
                            }
                            closedir($dh);
                        }
                    }
                    

					$arr_str = implode("|", $tmp);
					echo "<script type='text/javascript'>
					        function RandomBG(phpInput) {
                                var files = phpInput.split('|');
                                var i     = Rand(0, files.length-1);

                                document.body.style.backgroundImage = 'url(\"/resources/bgs/' + files[i] + '\")';
                                document.body.style.backgroundSize = 'cover';
                            }
                            function Rand (min, max) {
                                return Math.floor(Math.random() * (max - min + 1)) + min;
                            }
					        RandomBG('$arr_str');
					     </script>";
}
					///////////////////////////////
?>
