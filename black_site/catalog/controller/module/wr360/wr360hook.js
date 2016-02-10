function WR360Initialize(graphicsPath, scriptsPath, configFileURL, divID, viewerWidth, viewerHeight, rootPath, baseWidth)
{
	var imageDiv = jQuery(divID);
	if (imageDiv.length <= 0)
		return;
	
	if (viewerWidth != "")
		imageDiv.css("width", viewerWidth);

	if (viewerHeight != "")
		imageDiv.css("height", viewerHeight)
	
	imageDiv.css("padding", 0);

    var baseWidthInt = parseInt(baseWidth);
	
	var newHtml = "<div id='wr360PlayerId'> \
  <script language='javascript' type='text/javascript'> \
     _imageRotator.settings.graphicsPath   = '" + scriptsPath + "/" + graphicsPath + "'; \
     _imageRotator.settings.configFileURL  = '" + configFileURL + "'; \
	 _imageRotator.settings.rootPath  = '" + rootPath + "'; \
	 _imageRotator.settings.responsiveBaseWidth  = " + baseWidthInt + "; \
	 _imageRotator.licenseFileURL = '" + scriptsPath + "/html/license.lic" + "'; \
  </script> \
</div>";

	imageDiv.html(newHtml);
	imageDiv.css("visibility", "visible");
	_imageRotator.runImageRotator("wr360PlayerId");

//	ADDING
	document.getElementById("wr360placer_wr360PlayerId").remove();
	$('<img style="position:absolute;border:none;margin: -47px 0 0 5px;width:50px;" draggable="false" src="/image/ico/360.png" width="50" height="45" alt="360" title="360" />').insertAfter('.image_product');
	$('<img style="position:absolute;border:none;margin-top:-53px;margin-left:107px;" draggable="false" src="/image/ico/360.png" width="50" height="45" alt="360" title="360" />').insertAfter('.popupimg');

	
}
