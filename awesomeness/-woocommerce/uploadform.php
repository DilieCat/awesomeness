<div id="upload-wrapper">
  <div align="center">
    <form action="<?php echo get_stylesheet_directory_uri();?>/processupload.php" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
      <input name="image_file" id="imageInput" type="file" />
      <input type="submit"  id="submit-btn" value="Klik om een foto te selecteren" />
      <a class="woo-sc-button custom custom-upload" href="#upload"><span class="woo-">Voeg een foto toe</span></a>
      <img src="<?php echo get_stylesheet_directory_uri();?>/img/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
    </form>
    <div id="progressbox" style="display:none;">
      <div id="progressbar"></div>
      <div id="statustxt">0%</div>
    </div>
    <div class="image_upload_warning"></div>
    <div id="output"></div>
  </div>
</div>
