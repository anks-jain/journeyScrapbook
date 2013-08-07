<?php
	include 'db_connect.php';
	include 'login_security_functions.php'; 
	sec_session_start();
	if(login_check($mysqli) == true) {
		$user_id = $_SESSION['user_id'];
    $result = mysqli_query($mysqli, "SELECT * FROM pic_cordinates WHERE user_id= 1" );
		if(! $result) {
    	die("SQL Error: " . mysqli_error($mysqli));
		}
		$pic_array = array();
		$pic_thumb_array = array();
		while ($row = mysqli_fetch_array($result)) {
			$pic = "../uploader/server/php/files/".$user_id."/".$row['pic_path'];
			$pic_thumb = "../uploader/server/php/files/".$user_id."/thumbnail/".$row['pic_path'];
			array_push($pic_array,$pic);
			array_push($pic_thumb_array,$pic_thumb);
		}

?>
<html>
	<header>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<link   href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">	
		<link href="../bootstrap/css/tweaks.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
  	<link rel="stylesheet" href="../uploader/css/jquery.fileupload-ui.css">
    <script type="text/javascript" src="../fotorama-4.2.3/fotorama.js"></script>
  	<link rel="stylesheet" href="../fotorama-4.2.3/fotorama.css">
	  <noscript><link rel="stylesheet" href="../uploader/css/jquery.fileupload-ui-noscript.css"></noscript>

	</header>
	<body>
			<?php include 'header.php' ?>
			<div id="uploadpics" style="float:right">
     		 <a href="#uploadpics_modal"  class="btn btn-success" data-toggle="modal" data-refresh="true">Upload Pics</a> </div>
      <!-- Plugin to upload images -->
      <div style="display:none" class="modal fade" id="uploadpics_modal">
          <div class="modal-header content-heading">
            <h3>Upload</h3>
          </div>
          <div class="modal-body">
    				<!-- The file upload form used as target for the file upload widget -->
    				<form id="fileupload" action="../uploader/server/php/index.php" method="POST" enctype="multipart/form-data">
        			<!-- Redirect browsers with JavaScript disabled to the origin page -->
							<input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
        			<noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
        			<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        			<div class="row fileupload-buttonbar">
            		<div class="span7">
                	<!-- The fileinput-button span is used to style the file input field as button -->
                	<span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                	</span>
                	<button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                	</button>
                	<button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                	</button>
                	<button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                	</button>
                	<input type="checkbox" class="toggle">
                	<!-- The loading indicator is shown during file processing -->
                	<span class="fileupload-loading"></span>
            		</div>
            		<!-- The global progress information -->
            		<div class="span5 fileupload-progress fade">
                	<!-- The global progress bar -->
                	<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                	</div>
                	<!-- The extended global progress information -->
                	<div class="progress-extended">&nbsp;</div>
            		</div>
        			</div>
        			<!-- The table listing the files available for upload/download -->
        			<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    				</form>
          </div>
      </div>
      <br/><br/><br/>
			<!-- Refresh page when modal is closed -->
			<script>
				$('#uploadpics_modal').on('hidden', function () {
					location.reload();
					console.log("hi");
				});
			</script>
			<!-- Gallery to show the Images -->
			<div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="800/600" data-height="60%"  data-keyboard="true" data-min-width="400" data-max-width="1000" data-min-height="300" data-max-height="100%">
				<?php 
					for($i=0;$i<sizeof($pic_array);$i++) {
				?>
  				<a href="<?php echo $pic_array[$i];?>"><img src="<?php echo $pic_thumb_array[$i];?>"></a>
				<?php 
					}
				?>
			</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
                <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            {% } %}
        </td>
        <td>
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
                <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>
			<?php include 'footer.php' ?>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../uploader/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../uploader/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../uploader/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="../uploader/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="../uploader/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="../uploader/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="../uploader/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="../uploader/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="../uploader/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="../uploader/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
	</body>
</html>
<?php		
	} else {
		echo 'You are not authorized to access this page.';	
	}
?>
