$(function(){

    $('.fileinput1').each(function() {
      var i = 0;
      var id = "finputOverlay"+(++i);

      $(".overlay span", this).attr("id", id);

      $(this).swfupload({
          // Backend Settings
          upload_url: "../upload.php",    // Relative to the SWF file (or you can use absolute paths)
          
          // File Upload Settings
          file_size_limit : "102400", // 100MB
          file_types : "*.*",
          file_types_description : "All Files",
          file_upload_limit : "10",
          file_queue_limit : "0",
      
          // Button Settings
          button_placeholder_id : "finputOverlay"+i,
          button_width: 242,
          button_height: 32,
          button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
          button_cursor: SWFUpload.CURSOR.HAND,

          
          // Flash Settings
          flash_url : "scripts/externals/swfupload/Flash/swfupload.swf"
          
      });
      
      
      // assign our event handlers
      $('.fileinput1')
          .bind('fileQueued', function(event, file){
              // start the upload once a file is queued
              $(".input", this).val(file.name);
              $(this).swfupload('startUpload');
          })
          .bind('uploadComplete', function(event, file){
              //alert('Upload completed - '+file.name+'!');
              // start the upload (if more queued) once an upload is complete
              $(this).swfupload('startUpload');
      });
    });

});