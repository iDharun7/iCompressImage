<style>
.button {
	position:absolute;
    bottom:10px;
    right:10px;
}

#img_container {
    position:relative;
    display:inline-block;
    text-align:center;
}
</style>

<?php
	function randomHex() {
		return str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
	}  
	
	function uploadAndCompress($compression=60) {		//Default compression is 60%
		$randomFileName = randomHex();
		$tempJpgFileName = $randomFileName.".jpg";
		$upload_dir = "images/";
		$compressed_dir = "compressed_images/";
		$target_file = $upload_dir . $tempJpgFileName;
		$uploadOk = 1;
		$imageFileType = "";
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		  $imageFileType = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
		  if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		  } else {
			echo "File is not an image.";
			$uploadOk = 0;
		  }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {       // 50 MB Maximum File size is allowed
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType == "jpg" ||  $imageFileType == "jpeg") {
			$uploadOk = 1;
		} else {
		  echo "Sorry, only JPG / JPEG Format is allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo " Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				$filePath = "./images/".htmlspecialchars($tempJpgFileName);
				$compressedFilePath = "./compressed_images/".$tempJpgFileName;
				
				compress($filePath, $compressedFilePath, $compression);
				
				echo "<div><h3>Preview</h3></div>";
				echo "
						<table style='border-collapse: collapse; margin: 10px auto; text-align: center;'>
							<tbody>
							<tr>
								<th>Original File</th>
								<th>Compressed File</th>
							</tr>
							<tr>
								<td><img src='".$filePath."' style='width:300px; margin: 0 auto;' class='img-thumbnail'/></td>
								<td><div id='img_container'><img src='".$compressedFilePath."' style='width:300px; margin: 0 auto;' class='img-thumbnail'/><a href='".$compressedFilePath."' class='button btn btn-success' role='button' download>Download Image</a></div></td>
							</tr>
							<tr>
								<td><span>".round(filesize($filePath) / 1024, 2)." KB</span></td>
								<td><span>".round(filesize($compressedFilePath) / 1024, 2)." KB</span> (<b>".round((filesize($filePath)-filesize($compressedFilePath))*100/filesize($filePath), 0)."% Size Reduced</b>)</td>
							</tr>
							</tbody>
						</table>
				";

			
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }

		}
	}
	
	function compress($src_file_loc, $dest_file_loc, $compression = 60) {
		$img = imagecreatefromjpeg($src_file_loc);
		imagejpeg($img, $dest_file_loc, $compression);
	}
	
	function src_file_loc($filename) {
		return "./images/".htmlspecialchars($filename);
	}
	function compressed_file_loc($filename) {
		return "./compressed_images/".$filename;
	}
?>