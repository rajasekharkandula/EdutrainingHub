// common scripts
(function() {
    "use strict";
	
})(jQuery);
/* --------------------- Common Function Starts  --------------------------*/
var path = '/FirstTrack';
function getStates(data,callback,selectValue){
	var callback="#"+callback;
	$.ajax({
		url:prefix+'/home/location_detail/PSTATE/'+data.value,
		type:'POST',
		processData: true,
		dataType:'JSON'
	}).done(function(data){
		var len=data.length;
		html = '<option value=""></option>';
		for(i=0;i<len;i++){
			if(selectValue == data[i].stateID)
				html += "<option value='"+data[i].stateID+"' selected>"+data[i].stateName+"</option>";
			else
				html += "<option value='"+data[i].stateID+"' >"+data[i].stateName+"</option>";
		}
		$(callback).html(html);
		$(callback).select2({placeholder: "Select state",allowClear:true});
		if(selectValue != "")$(callback).trigger('change');
	}); 
}
function getCities(data,callback,selectValue){
	var callback="#"+callback;
	$.ajax({
		url:prefix+'/home/location_detail/PCITY/'+data.value,
		type:'POST',
		processData: true,
		dataType:'JSON'
	}).done(function(data){
		var len=data.length;
		html = '<option value=""></option>';
		for(i=0;i<len;i++){
			if(selectValue == data[i].cityID)
				html += "<option value='"+data[i].cityID+"' selected>"+data[i].cityName+"</option>";
			else
				html += "<option value='"+data[i].cityID+"' >"+data[i].cityName+"</option>";
		}
		$(callback).html(html);
		$(callback).select2({placeholder: "Select city",allowClear:true});
		if(selectValue != "")$(callback).trigger('change');
	}); 
}
function getLocations(data,callback,selectValue){
	var callback="#"+callback;
	$.ajax({
		url:prefix+'/home/location_detail/PLOCATION/'+data.value,
		type:'POST',
		processData: true,
		dataType:'JSON'
	}).done(function(data){
		var len=data.length;
		html = '<option value=""></option>';
		for(i=0;i<len;i++){
			if(selectValue == data[i].locationID)
				html += "<option value='"+data[i].locationID+"' selected>"+data[i].locationName+"</option>";
			else
				html += "<option value='"+data[i].locationID+"' >"+data[i].locationName+"</option>";
		}
		$(callback).html(html);
		$(callback).select2({placeholder: "Select location",allowClear:true});
	}); 
}
/* File Upload */
function image_upload(id,w,h) {
	//Get reference of FileUpload.
	var fileUpload = $("#"+id)[0];
	
	$("#"+id).parent().find(".preview").remove();
	$("#"+id).parent().find(".text-danger").remove();
	
	//Check whether the file is valid Image.
	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
	if (regex.test(fileUpload.value.toLowerCase())) {
		//Check whether HTML5 is supported.
		if (typeof (fileUpload.files) != "undefined") {
			//Initiate the FileReader object.
			var reader = new FileReader();
			//Read the contents of Image File.
			reader.readAsDataURL(fileUpload.files[0]);
			reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
				image.onload = function () {
					//Determine the Height and Width.
					var height = this.height;
					var width = this.width;
					if (height < h || width < w) {
						$("#"+id).val('');
						$("#"+id).parent().append('<span class="text-danger">Image width and height should be greater than '+w+'X'+h+'</span>');
						return false;
					}
					
					$("#"+id).parent().append('<img class="preview" src='+this.src+'>');
					return true;
				};
			}
		} else {
			$("#"+id).val('');
			$("#"+id).parent().append('<span class="text-danger">This browser does not support HTML5.</span>');
			return false;
		}
	} else {
		$("#"+id).val('');
		$("#"+id).parent().append('<span class="text-danger">Please select a valid Image file.</span>');
		return false;
	}
}
function file_upload(id) {
	//Get reference of FileUpload.
	var fileUpload = $("#"+id)[0];
	var ext = fileUpload.value.split('.').pop();
	//Check whether the file is valid Image.
	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.pdf|.png|.gif)$");
	if (ext != 'pdf' && ext != 'docx' && ext != 'doc') {
		$("#"+id).val('');
		$("#"+id).parent().append('<span class="text-danger">Please select a valid document.</span>');
		return false;
	} 
}
/* End of Drop a Query Form*/
