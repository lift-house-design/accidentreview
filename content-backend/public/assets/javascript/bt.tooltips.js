var createImgTip = function(element)
{
	var e = jQuery(element).parent();
	var str = "<img style=\"display:none;\" src=\""+e.attr("href")+"\" onload=\"javascript:doCreateImgTip(this);\" />";
	jQuery(str).appendTo(e);
}
var doCreateImgTip = function(img)
{
	var iMaxW = 640;
	var iMaxH = 480;
	var iW = img.width;
	var iH = img.height;
	var iNewW = iW;
	var iNewH = iH;
	var fZoom = 1.0;

	if((iW/iH) > (iMaxW/iMaxH))
		fZoom = iW / iMaxW;
	else
		fZoom = iH / iMaxH;
	
	if(fZoom>1)
	{
		iNewW = Math.round(iW/fZoom);
		iNewH = Math.round(iH/fZoom);
	}
	
	var e1 = jQuery(img).parent();
	var e2 = jQuery(img).parent().parent();

	e2.bt("<img src=\""+e1.attr("href")+"\" width=\""+iNewW+"\" height=\""+iNewH+"\">", 
	{
	  width: iNewW, 
	  fill: 'white', 
	  cornerRadius: 10, 
	  padding: 10,
	  strokeWidth: 1,
	  trigger: ['mouseover', 'mouseout']
	});
}