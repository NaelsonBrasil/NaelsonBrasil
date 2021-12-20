<?php

function getRealIpAddr()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else
        $ip = $_SERVER['REMOTE_ADDR'];
    return  $ip;
}

function write_ini_file($file, $array = [])
{

	// check first argument is string
	if (!is_string($file)) {
		throw new \InvalidArgumentException('Function argument 1 must be a string.');
	}
	// check second argument is array
	if (!is_array($array)) {
		throw new \InvalidArgumentException('Function argument 2 must be an array.');
	}
	// process array
	$data = array();
	foreach ($array as $key => $val) {
		if (is_array($val)) {
			$data[] = "[$key]";
			foreach ($val as $skey => $sval) {
				if (is_array($sval)) {
					foreach ($sval as $_skey => $_sval) {
						if (is_numeric($_skey)) {
							$data[] = $skey . '[] = ' . (is_numeric($_sval) ? $_sval : (ctype_upper($_sval) ? $_sval : '"' . $_sval . '"'));
						} else {
							$data[] = $skey . '[' . $_skey . '] = ' . (is_numeric($_sval) ? $_sval : (ctype_upper($_sval) ? $_sval : '"' . $_sval . '"'));
						}
					}
				} else {
					$data[] = $skey . ' = ' . (is_numeric($sval) ? $sval : (ctype_upper($sval) ? $sval : '"' . $sval . '"'));
				}
			}
		} else {
			$data[] = $key . ' = ' . (is_numeric($val) ? $val : (ctype_upper($val) ? $val : '"' . $val . '"'));
		}
		// empty line \n
		//$data[] = null;
	}

	// open file pointer, init flock options
	$fp = fopen($file, 'w');
	$retries = 0;
	$max_retries = 100;

	if (!$fp) {
		return false;
	}

	// loop until get lock, or reach max retries
	do {
		if ($retries > 0) {
			usleep(rand(1, 5000));
		}
		$retries += 1;
	} while (!flock($fp, LOCK_EX) && $retries <= $max_retries);

	// couldn't get the lock
	if ($retries == $max_retries) {
		return false;
	}

	// got lock, write data
	fwrite($fp, implode(PHP_EOL, $data) . PHP_EOL);

	// release lock
	flock($fp, LOCK_UN);
	fclose($fp);

	return true;
}

/**
 * Inserts an array of strings into a file (.htaccess ), placing it between
 * BEGIN and END markers.
 *
 * Replaces existing marked info. Retains surrounding
 * data. Creates file if none exists.
 *
 * @since 1.5.0
 *
 * @param string       $filename  Filename to alter.
 * @param string       $marker    The marker to alter.
 * @param array|string $insertion The new content to insert.
 * @return bool True on write success, false on failure.
 */
function insert_with_markers($filename, $marker, $insertion)
{
	if (!file_exists($filename)) {
		if (!is_writable(dirname($filename))) {
			return false;
		}
		if (!touch($filename)) {
			return false;
		}
	} elseif (!is_writeable($filename)) {
		return false;
	}

	if (!is_array($insertion)) {
		$insertion = explode("\n", $insertion);
	}

	$start_marker = "# BEGIN {$marker}";
	$end_marker   = "# END {$marker}";

	$fp = fopen($filename, 'r+');
	if (!$fp) {
		return false;
	}

	// Attempt to get a lock. If the filesystem supports locking, this will block until the lock is acquired.
	flock($fp, LOCK_EX);

	$lines = array();
	while (!feof($fp)) {
		$lines[] = rtrim(fgets($fp), "\r\n");
	}

	// Split out the existing file into the preceding lines, and those that appear after the marker
	$pre_lines    = $post_lines = $existing_lines = array();
	$found_marker = $found_end_marker = false;
	foreach ($lines as $line) {
		if (!$found_marker && false !== strpos($line, $start_marker)) {
			$found_marker = true;
			continue;
		} elseif (!$found_end_marker && false !== strpos($line, $end_marker)) {
			$found_end_marker = true;
			continue;
		}
		if (!$found_marker) {
			$pre_lines[] = $line;
		} elseif ($found_marker && $found_end_marker) {
			$post_lines[] = $line;
		} else {
			$existing_lines[] = $line;
		}
	}

	// Check to see if there was a change
	if ($existing_lines === $insertion) {
		flock($fp, LOCK_UN);
		fclose($fp);

		return true;
	}

	// Generate the new file data
	$new_file_data = implode(
		"\n",
		array_merge(
			$pre_lines,
			array($start_marker),
			$insertion,
			array($end_marker),
			$post_lines
		)
	);

	// Write to the start of the file, and truncate it to that length
	fseek($fp, 0);
	$bytes = fwrite($fp, $new_file_data);
	if ($bytes) {
		ftruncate($fp, ftell($fp));
	}
	fflush($fp);
	flock($fp, LOCK_UN);
	fclose($fp);

	return (bool) $bytes;
}

function inputProtec($str): string
{
	$spaceRemove = preg_replace('/\s+/', '', $str);
	return addslashes(strip_tags(trim(htmlspecialchars($spaceRemove))));
}

/**
 * Development by Naelson.g.saraiva@gmail.com 14/08/2019
 *
 * @since 1.5.5
 *
 * @param string       $current url
 * @param string       $current directory root
 * @param string       $system opetational    windows of linux
 * @return bool directory root
 */
function directoryRoot($foldersCurrentByUrl, $dir, $system_operation)
{

	switch ($system_operation) {
		case 'linux':

			//Url
			//
			//	/admin/ warning - last bar
			//	/lin2web/admin/  warning - last bar
			//

			//Directory
			//	/opt/lampp/htdocs/admin here not have last bar 
			//	/opt/lampp/htdocs/lin2web/admin here not have last bar 

			$urlBar = 0;

			for ($n1 = 0; $n1 < strlen($foldersCurrentByUrl); $n1++)
				if (@$foldersCurrentByUrl[$n1 + 1] == '/') $urlBar = $urlBar  + 1;
				else if (@$foldersCurrentByUrl[$n1 + 1] == NULL)
					break;


			$myDir = $dir;
			$myBarDir = 0;

			for ($n2 = 0; $n2 < strlen($dir); $n2++) {
				if ($myDir[$n2] == '/') {
					$myBarDir = $myBarDir  + 1;
				}
			}

			if ($urlBar == 1) {

				$barUp = ($myBarDir - ($urlBar - 1));
			} else if ($urlBar == 2) {

				$barUp = ($myBarDir - ($urlBar - 2));
			} else if ($urlBar == 3) { //Windows

				$barUp = ($myBarDir - ($urlBar - 3));
			}

			$myResult = '';
			$cBar = 0;
			for ($i = 0; $i < strlen($dir); $i++) {

				if ($myDir[$i] == '/') $cBar = $cBar  + 1;

				if ($cBar == $barUp) break;

				$myResult .= $myDir[$i];
			}

			return $myResult . '/';

			break;

		case 'windows':
			$winCounting = 0;
			$newWay = '';
			$firstCount = 0;

			while (!empty($dir[$winCounting])) {

				if ($dir[$winCounting] == '\\') {
					$dir[$winCounting] = "/";
					$firstCount = $firstCount + 1;
				}

				$newWay .= $dir[$winCounting];
				$winCounting = $winCounting + 1;
			}

			$windowWay = ''; //end result naelson.g.saraiva@gmail.com
			$nBar = 0;
			for ($i = 0; $i < strlen($newWay); $i++) {

				$windowWay .= $newWay[$i];

				if ($newWay[$i] == "/") $nBar = $nBar + 1;
				if ($nBar == $firstCount) break;
			}

			return $windowWay;
			break;
	}
}
