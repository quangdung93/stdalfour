function accept(id){
	if(id == 1){
		report = "Bạn có muốn xóa hay không?";
	}else if (id == 2){
		report = "Bạn có muốn sửa hay không?";
	}else if (id == 3){
		report = "Bạn có muốn kích hoạt hay không?";
	}
	var xn = confirm(report);
	if(xn == true)
		return true;
	else
		return false;
}
function BrowseServer(){
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '/ckfinder/';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField();
	finder.popup();
}
function BrowseServerList(elementId){
	CKFinder.popup( {
		chooseFiles: true,
		width: 1100,
		height: 600,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
				var output = document.getElementById( elementId );
				output.value = file.getUrl();
			} );

			finder.on( 'file:choose:resizedImage', function( evt ) {
				var output = document.getElementById( elementId );
				output.value = evt.data.resizedUrl;
			} );
		}
	});
}
function BrowseServerListAlbum(elementId,aId){
	CKFinder.popup( {
		chooseFiles: true,
		width: 900,
		height: 600,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
				document.getElementById( aId ).src = file.getUrl();
				var output = document.getElementById( elementId );
				output.value = file.getUrl();
			} );

			finder.on( 'file:choose:resizedImage', function( evt ) {
				var output = document.getElementById( elementId );
				output.value = evt.data.resizedUrl;
			} );
		}
	});
}
// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField(fileUrl){
	document.getElementById( 'linkimages' ).value = fileUrl;
}
function SetFileFieldList(fileUrl, data){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}