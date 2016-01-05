(function($){
  $.fn.uploadCover = function(vartxx, rtempx, prefj, msg1, msg2) {
    var thumb = $('img#prwimgCov');
    new AjaxUpload(this, {

      action: siteurl + "upload/cover/tp:" + vartxx + "/prefj:" + prefj + "/fold:" + rtempx.replace(/\//gi,'-') + "/r:" + Math.round(Math.random()*1000),
      name: 'uploaded_cover',
      onSubmit: function(file, ext) {
        if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
          alert(msg1);
          return false;
        } else {
			$('#linkUpCover').hide();
			$('#areapreloadCv').show();
        }
      },
      onComplete: function(file, response) {
		txtresult=response.substring(3);
		switch(response.charAt(0)){
		case '0':
			$('#linkUpCover').css('display','block');
			$('#areapreloadCv').css('display','none');			
			alert(txtresult);
			break;
		case '1':
			var randon = Math.random();
			thumb.attr('src',siteurl + rtempx + txtresult + '?randon='+randon);
			$('#loadedcover').val(txtresult);	
			$('#didchangescov').val('1');
			$('#linkUpCover').show();
			$('#linkUpCover').html(msg2);
			$('#areapreloadCv').hide();
			$('#prwimgCov').show('slow');
			break;					
		}		
      }
    });
  };
})(jQuery); 