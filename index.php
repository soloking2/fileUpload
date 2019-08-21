<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload File</title>
	<style>
		body{
			background: linear-gradient(90deg, #2BC0E4 10%, #EAECC6 90%);
    		font-family: "Bahnschrift", "Avenir";
		}
		.upload{
			width: 40%;
			margin: 40px auto;
		}

		#uploadForm{
			padding: 30px;
			font-size: 18px;
		}
		#uploadForm label{
			font-size: 15px;
		}
		input[type=file]{
			margin-top: 10px;
			font-size: 15px;
		}

		input[type=button]{
			color: #fff;
			background: green;
			font-size: 17px;
			margin:10px 0;
			padding: 10px;
			outline: none;
			border: none;
			cursor: pointer;
		}

		#progressBar{
			margin-top: 10px;
			width: 100%;
			padding: 12px;
		}
	</style>
	<script>

	const uploadFileHandler = () => {
		let file = document.getElementById("uploadFile").files[0];
		let formdata = new FormData();
		formdata.append("uploadFile", file);

		let ajax = new XMLHttpRequest();

		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);

		ajax.open("POST", "uploadFile.php", true);
		ajax.send(formdata);

	}

	const progressHandler= (event) => {
		document.getElementById("contentProgress").innerHTML = "Uploaded " + event.loaded+" bytes of " + event.total;
		var percent = (event.loaded / event.total) * 100;

		var progressValue = document.getElementById("progressBar").value = Math.round(percent);
		document.getElementById("status").innerHTML = progressValue+"% uploaded .. please wait " + "<span><img src='2.gif'></span>";

	}

	const completeHandler = (event) => {
		document.getElementById("status").innerHTML = event.target.responseText;
		document.getElementById("progressBar").value = 0;
		document.getElementById("uploadFile").value = '';


	}

	const errorHandler = (event) => {
		document.getElementById("status").innerHTML = "Upload failed";
		document.getElementById("uploadFile").value = '';
	}

	const abortHandler = (event) => {
		document.getElementById("status").innerHTML = "Upload Aborted";
		document.getElementById("uploadFile").value = '';
	}

</script>
</head>

<body>
	<div class="upload">

		<form id="uploadForm" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>File Upload</legend>
			<label for="uploadFile">Pick a file</label><br>
			<input type="file" name="uploadFile" id="uploadFile"><br>

			<input type="button" value="Upload File" name="submit" title="Please upload pictures" data-upload onclick="uploadFileHandler();"><br>
			
			<progress value="0" max="100" id="progressBar"></progress>
				<h3 id="status"></h3>
				<p id="contentProgress"> </p>
			</fieldset>
		</form>
</div>


</body>
</html>