
<html>
<style type="text/css"> 
</style>
<head>
<SCRIPT LANGUAGE=JavaScript>
function buscar()
{
	if (event.keyCode == 13)
    {
		uno.action='medicamentos.php';
		uno.target='';
		uno.submit();	
	}
}
function buscar1()
{
	uno.action='medicamentos.php';
	uno.target='';
	uno.submit();
}



<!-- Original:  Kedar R. Bhave (softricks@hotmail.com) -->
<!-- Web Site:  http://www.softricks.com -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- -->
<!-- modifications and customizations to work with the "overLIB" library: -->
<!-- Author:   James B. O'Connor (joconnor@nordenterprises.com) -->
<!-- Web Site: http://www.nordenterprises.com -->
<!-- developed for use with http://home-owners-assoc.com -->
<!-- Note: while overlib works fine with Netscape 4, this function does not work very well, since portions of the "over" div -->
<!--   end up under other fields on the form and cannot be seen.  If you really want to use this with NS4, -->
<!--   you'll need to change the positioning in the overlib() call to make sure the "over" div gets positioned -->
<!--   away from all other form fields -->
<!-- you can get overLIB from: -->
//\  overLIB 3.50  --  This notice must remain untouched at all times.
//\  Copyright Erik Bosrup 1998-2001. All rights reserved.
//\  By Erik Bosrup (erik@bosrup.com).  Last modified 2001-08-28.
//\  Portions by Dan Steinman (dansteinman.com). Additions by other people are
//\  listed on the overLIB homepage.
//\  Get the latest version at http://www.bosrup.com/web/overlib/

var weekend = [0,6];
var weekendColor = "#e0e0e0";
var fontface = "Verdana";
var fontsize = 8;			// in "pt" units; used with "font-size" style element

var gNow = new Date();
var ggWinContent;
var ggPosX = -1;
var ggPosY = -1;

Calendar.Months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

// Non-Leap year Month days..
Calendar.DOMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
// Leap year Month days..
Calendar.lDOMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

function Calendar(p_item, p_month, p_year, p_format) {
	if ((p_month == null) && (p_year == null))	return;

	if (p_month == null) {
		this.gMonthName = null;
		this.gMonth = null;
		this.gYearly = true;
	} else {
		this.gMonthName = Calendar.get_month(p_month);
		this.gMonth = new Number(p_month);
		this.gYearly = false;
	}

	this.gYear = p_year;
	this.gFormat = p_format;
	this.gBGColor = "white";
	this.gFGColor = "black";
	this.gTextColor = "black";
	this.gHeaderColor = "black";
	this.gReturnItem = p_item;
}

Calendar.get_month = Calendar_get_month;
Calendar.get_daysofmonth = Calendar_get_daysofmonth;
Calendar.calc_month_year = Calendar_calc_month_year;

function Calendar_get_month(monthNo) {
	return Calendar.Months[monthNo];
}

function Calendar_get_daysofmonth(monthNo, p_year) {
	/* 
	Check for leap year ..
	1.Years evenly divisible by four are normally leap years, except for... 
	2.Years also evenly divisible by 100 are not leap years, except for... 
	3.Years also evenly divisible by 400 are leap years. 
	*/
	if ((p_year % 4) == 0) {
		if ((p_year % 100) == 0 && (p_year % 400) != 0)
			return Calendar.DOMonth[monthNo];
	
		return Calendar.lDOMonth[monthNo];
	} else
		return Calendar.DOMonth[monthNo];
}

function Calendar_calc_month_year(p_Month, p_Year, incr) {
	/* 
	Will return an 1-D array with 1st element being the calculated month 
	and second being the calculated year 
	after applying the month increment/decrement as specified by 'incr' parameter.
	'incr' will normally have 1/-1 to navigate thru the months.
	*/
	var ret_arr = new Array();
	
	if (incr == -1) {
		// B A C K W A R D
		if (p_Month == 0) {
			ret_arr[0] = 11;
			ret_arr[1] = parseInt(p_Year) - 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) - 1;
			ret_arr[1] = parseInt(p_Year);
		}
	} else if (incr == 1) {
		// F O R W A R D
		if (p_Month == 11) {
			ret_arr[0] = 0;
			ret_arr[1] = parseInt(p_Year) + 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) + 1;
			ret_arr[1] = parseInt(p_Year);
		}
	}
	
	return ret_arr;
}

function Calendar_calc_month_year(p_Month, p_Year, incr) {
	/* 
	Will return an 1-D array with 1st element being the calculated month 
	and second being the calculated year 
	after applying the month increment/decrement as specified by 'incr' parameter.
	'incr' will normally have 1/-1 to navigate thru the months.
	*/
	var ret_arr = new Array();
	
	if (incr == -1) {
		// B A C K W A R D
		if (p_Month == 0) {
			ret_arr[0] = 11;
			ret_arr[1] = parseInt(p_Year) - 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) - 1;
			ret_arr[1] = parseInt(p_Year);
		}
	} else if (incr == 1) {
		// F O R W A R D
		if (p_Month == 11) {
			ret_arr[0] = 0;
			ret_arr[1] = parseInt(p_Year) + 1;
		}
		else {
			ret_arr[0] = parseInt(p_Month) + 1;
			ret_arr[1] = parseInt(p_Year);
		}
	}
	
	return ret_arr;
}

// This is for compatibility with Navigator 3, we have to create and discard one object before the prototype object exists.
new Calendar();

Calendar.prototype.getMonthlyCalendarCode = function() {
	var vCode = "";
	var vHeader_Code = "";
	var vData_Code = "";
	
	// Begin TableDrawing code here..
	vCode += ("<div align=center><TABLE BORDER=1 BGCOLOR=\"" + this.gBGColor + "\" style='font-size:" + fontsize + "pt;'>");
	
	vHeader_Code = this.cal_header();
	vData_Code = this.cal_data();
	vCode += (vHeader_Code + vData_Code);
	
	vCode += "</TABLE></div>";
	
	return vCode;
}

Calendar.prototype.show = function() {
	var vCode = "";

	// build content into global var ggWinContent
	ggWinContent += ("<FONT FACE='" + fontface + "' ><B>");
	ggWinContent += (this.gMonthName + " " + this.gYear);
	ggWinContent += "</B><BR>";
	
	// Show navigation buttons
	var prevMMYYYY = Calendar.calc_month_year(this.gMonth, this.gYear, -1);
	var prevMM = prevMMYYYY[0];
	var prevYYYY = prevMMYYYY[1];

	var nextMMYYYY = Calendar.calc_month_year(this.gMonth, this.gYear, 1);
	var nextMM = nextMMYYYY[0];
	var nextYYYY = nextMMYYYY[1];
	
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=1 CELLSPACING=0 CELLPADDING=0 BGCOLOR='#e0e0e0' style='font-size:" + fontsize + "pt;'><TR><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + this.gMonth + "', '" + (parseInt(this.gYear)-1) + "', '" + this.gFormat + "'" +
		");" +
		"\">Ao<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one month'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + prevMM + "', '" + prevYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\">Mes<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += "       </TD><TD ALIGN=center>";
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one month'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + nextMM + "', '" + nextYYYY + "', '" + this.gFormat + "'" +
		");" +
		"\">Mes<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', '" + this.gMonth + "', '" + (parseInt(this.gYear)+1) + "', '" + this.gFormat + "'" +
		");" +
		"\">Ao<\/A>]</TD></TR></TABLE><BR>");

	// Get the complete calendar code for the month, and add it to the
	//	content var
	vCode = this.getMonthlyCalendarCode();
	ggWinContent += vCode;
}

Calendar.prototype.showY = function() {
	var vCode = "";
	var i;

	ggWinContent += "<FONT FACE='" + fontface + "' ><B>"
	ggWinContent += ("Year : " + this.gYear);
	ggWinContent += "</B><BR>";

	// Show navigation buttons
	var prevYYYY = parseInt(this.gYear) - 1;
	var nextYYYY = parseInt(this.gYear) + 1;
	
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=1 CELLSPACING=0 CELLPADDING=0 BGCOLOR='#e0e0e0' style='font-size:" + fontsize + "pt;'><TR><TD ALIGN=center>");
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go back one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', null, '" + prevYYYY + "', '" + this.gFormat + "'" +
		");" +
        "\">Ao<\/A>]</TD><TD ALIGN=center>");
	ggWinContent += "       </TD><TD ALIGN=center>";
	ggWinContent += ("[<A HREF=\"javascript:void(0);\" " +
		"onMouseOver=\"window.status='Go forward one year'; return true;\" " +
		"onMouseOut=\"window.status=''; return true;\" " +
		"onClick=\"Build(" + 
		"'" + this.gReturnItem + "', null, '" + nextYYYY + "', '" + this.gFormat + "'" +
		");" +
        "\">Ao<\/A>]</TD></TR></TABLE><BR>");

	// Get the complete calendar code for each month.
	// start a table and first row in the table
	ggWinContent += ("<TABLE WIDTH='100%' BORDER=0 CELLSPACING=0 CELLPADDING=5 style='font-size:" + fontsize + "pt;'><TR>");
	var j;
	for (i=0; i<12; i++) {
		// start the table cell
		ggWinContent += "<TD ALIGN='center' VALIGN='top'>";
		this.gMonth = i;
		this.gMonthName = Calendar.get_month(this.gMonth);
		vCode = this.getMonthlyCalendarCode();
		ggWinContent += (this.gMonthName + "/" + this.gYear + "<BR>");
		ggWinContent += vCode;
		ggWinContent += "</TD>";
		if (i == 3 || i == 7) {
			ggWinContent += "</TR><TR>";
			}

	}

	ggWinContent += "</TR></TABLE></font><BR>";
}

Calendar.prototype.cal_header = function() {
	var vCode = "";
	
	vCode = vCode + "<TR>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Dom</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Lun</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Mar</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Mie</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Jue</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Vie</B></FONT></TD>";
	vCode = vCode + "<TD ALIGN=CENTER WIDTH='16%'><FONT FACE='" + fontface + "' COLOR='" + this.gHeaderColor + "'><B>Sab</B></FONT></TD>";
	vCode = vCode + "</TR>";
	
	return vCode;
}

Calendar.prototype.cal_data = function() {
	var vDate = new Date();
	vDate.setDate(1);
	vDate.setMonth(this.gMonth);
	vDate.setFullYear(this.gYear);

	var vFirstDay=vDate.getDay();
	var vDay=1;
	var vLastDay=Calendar.get_daysofmonth(this.gMonth, this.gYear);
	var vOnLastDay=0;
	var vCode = "";

	/*
	Get day for the 1st of the requested month/year..
	Place as many blank cells before the 1st day of the month as necessary. 
	*/
	vCode = vCode + "<TR>";
	for (i=0; i<vFirstDay; i++) {
		vCode = vCode + "<TD ALIGN=CENTER  WIDTH='14%'" + this.write_weekend_string(i) + "><FONT FACE='" + fontface + "'> </FONT></TD>";
	}

	// Write rest of the 1st week
	for (j=vFirstDay; j<7; j++) {
		vCode = vCode + "<TD ALIGN=CENTER  WIDTH='14%'" + this.write_weekend_string(j) + "><FONT FACE='" + fontface + "'>" +
			"<A HREF='javascript:void(0);' " + 
				"onMouseOver=\"window.status='set date to " + this.format_data(vDay) + "'; return true;\" " +
				"onMouseOut=\"window.status=' '; return true;\" " +
				"onClick=\"document." + this.gReturnItem + ".value='" + 
				this.format_data(vDay) + 
				"';ggPosX=-1;ggPosY=-1;nd();nd();\">" + 
				this.format_day(vDay) + 
			"</A>" + 
			"</FONT></TD>";
		vDay=vDay + 1;
	}
	vCode = vCode + "</TR>";

	// Write the rest of the weeks
	for (k=2; k<7; k++) {
		vCode = vCode + "<TR>";

		for (j=0; j<7; j++) {
			vCode = vCode + "<TD ALIGN=CENTER  WIDTH='14%'" + this.write_weekend_string(j) + "><FONT FACE='" + fontface + "'>" +
				"<A HREF='javascript:void(0);' " +
					"onMouseOver=\"window.status='set date to " + this.format_data(vDay) + "'; return true;\" " +
					"onMouseOut=\"window.status=' '; return true;\" " +
					"onClick=\"document." + this.gReturnItem + ".value='" + 
					this.format_data(vDay) + 
					"';window.scroll(0,ggPosY);ggPosX=-1;ggPosY=-1;nd();nd();\">" +
				this.format_day(vDay) + 
				"</A>" + 
				"</FONT></TD>";
			vDay=vDay + 1;

			if (vDay > vLastDay) {
				vOnLastDay = 1;
				break;
			}
		}

		if (j == 6)
			vCode = vCode + "</TR>";
		if (vOnLastDay == 1)
			break;
	}
	
	// Fill up the rest of last week with proper blanks, so that we get proper square blocks
	for (m=1; m<(7-j); m++) {
		if (this.gYearly)
			vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'" + this.write_weekend_string(j+m) +
			"><FONT FACE='" + fontface + "' COLOR='gray'> </FONT></TD>";
		else
			vCode = vCode + "<TD ALIGN=CENTER WIDTH='14%'" + this.write_weekend_string(j+m) +
			"><FONT FACE='" + fontface + "' COLOR='gray'>" + m + "</FONT></TD>";
	}
	
	return vCode;
}

Calendar.prototype.format_day = function(vday) {
	var vNowDay = gNow.getDate();
	var vNowMonth = gNow.getMonth();
	var vNowYear = gNow.getFullYear();

	if (vday == vNowDay && this.gMonth == vNowMonth && this.gYear == vNowYear)
		return ("<FONT COLOR=\"RED\"><B>" + vday + "</B></FONT>");
	else
		return (vday);
}

Calendar.prototype.write_weekend_string = function(vday) {
	var i;

	// Return special formatting for the weekend day.
	for (i=0; i<weekend.length; i++) {
		if (vday == weekend[i])
			return (" BGCOLOR=\"" + weekendColor + "\"");
	}
	
	return "";
}

Calendar.prototype.format_data = function(p_day) {
	var vData;
	var vMonth = 1 + this.gMonth;
	vMonth = (vMonth.toString().length < 2) ? "0" + vMonth : vMonth;
	var vMon = Calendar.get_month(this.gMonth).substr(0,3).toUpperCase();
	var vFMon = Calendar.get_month(this.gMonth).toUpperCase();
	var vY4 = new String(this.gYear);
	var vY2 = new String(this.gYear.substr(2,2));
	var vDD = (p_day.toString().length < 2) ? "0" + p_day : p_day;

	switch (this.gFormat) {
		case "MM\/DD\/YYYY" :
			vData = vMonth + "\/" + vDD + "\/" + vY4;
			break;
		case "MM\/DD\/YY" :
			vData = vMonth + "\/" + vDD + "\/" + vY2;
			break;
		case "MM-DD-YYYY" :
			vData = vMonth + "-" + vDD + "-" + vY4;
			break;
		case "YYYY-MM-DD" :
			vData = vY4 + "-" + vMonth + "-" + vDD;
			break;
		case "MM-DD-YY" :
			vData = vMonth + "-" + vDD + "-" + vY2;
			break;
		case "DD\/MON\/YYYY" :
			vData = vDD + "\/" + vMon + "\/" + vY4;
			break;
		case "DD\/MON\/YY" :
			vData = vDD + "\/" + vMon + "\/" + vY2;
			break;
		case "DD-MON-YYYY" :
			vData = vDD + "-" + vMon + "-" + vY4;
			break;
		case "DD-MON-YY" :
			vData = vDD + "-" + vMon + "-" + vY2;
			break;
		case "DD\/MONTH\/YYYY" :
			vData = vDD + "\/" + vFMon + "\/" + vY4;
			break;
		case "DD\/MONTH\/YY" :
			vData = vDD + "\/" + vFMon + "\/" + vY2;
			break;
		case "DD-MONTH-YYYY" :
			vData = vDD + "-" + vFMon + "-" + vY4;
			break;
		case "DD-MONTH-YY" :
			vData = vDD + "-" + vFMon + "-" + vY2;
			break;
		case "DD\/MM\/YYYY" :
			vData = vDD + "\/" + vMonth + "\/" + vY4;
			break;
		case "DD\/MM\/YY" :
			vData = vDD + "\/" + vMonth + "\/" + vY2;
			break;
		case "DD-MM-YYYY" :
			vData = vDD + "-" + vMonth + "-" + vY4;
			break;
		case "DD-MM-YY" :
			vData = vDD + "-" + vMonth + "-" + vY2;
			break;
		default :
			vData = vMonth + "\/" + vDD + "\/" + vY4;
	}

	return vData;
}

function Build(p_item, p_month, p_year, p_format) {
	gCal = new Calendar(p_item, p_month, p_year, p_format);

	// Customize your Calendar here..
	gCal.gBGColor="white";
	gCal.gLinkColor="black";
	gCal.gTextColor="black";
	gCal.gHeaderColor="darkgreen";

	// initialize the content string
	ggWinContent = "";

	// Choose appropriate show function
	if (gCal.gYearly) {
		// and, since the yearly calendar is so large, override the positioning and fontsize
		// warning: in IE6, it appears that "select" fields on the form will still show
		//	through the "over" div; Note: you can set these variables as part of the onClick
		//	javascript code before you call the show_yearly_calendar function
		if (ggPosX == -1) ggPosX = 10;
		if (ggPosY == -1) ggPosY = 10;
		if (fontsize == 8) fontsize = 6;
		// generate the calendar
		gCal.showY();
		}
	else {
		gCal.show();
		}

	// if this is the first calendar popup, use autopositioning with an offset
	if (ggPosX == -1 && ggPosY == -1) {
		overlib(ggWinContent, AUTOSTATUSCAP, STICKY, CLOSECLICK, CSSSTYLE,
			TEXTSIZEUNIT, "pt", TEXTSIZE, 8, CAPTIONSIZEUNIT, "pt", CAPTIONSIZE, 8, CLOSESIZEUNIT, "pt", CLOSESIZE, 8,
			CAPTION, "Selecciona una fecha", OFFSETX, 20, OFFSETY, -20);
		// save where the 'over' div ended up; we want to stay in the same place if the user
		//	clicks on one of the year or month navigation links
		if ( (ns4) || (ie4) ) {
		        ggPosX = parseInt(over.left);
		        ggPosY = parseInt(over.top);
			} else if (ns6) {
			ggPosX = parseInt(over.style.left);
			ggPosY = parseInt(over.style.top);
			}
		}
	else {
		// we have a saved X & Y position, so use those with the FIXX and FIXY options
		overlib(ggWinContent, AUTOSTATUSCAP, STICKY, CLOSECLICK, CSSSTYLE,
			TEXTSIZEUNIT, "pt", TEXTSIZE, 8, CAPTIONSIZEUNIT, "pt", CAPTIONSIZE, 8, CLOSESIZEUNIT, "pt", CLOSESIZE, 8,
			CAPTION, "Selecciona una fecha", FIXX, ggPosX, FIXY, ggPosY);
		}
	window.scroll(ggPosX, ggPosY);
}

function show_calendar() {
	/* 
		p_month : 0-11 for Jan-Dec; 12 for All Months.
		p_year	: 4-digit year
		p_format: Date format (mm/dd/yyyy, dd/mm/yy, ...)
		p_item	: Return Item.
	*/

	p_item = arguments[0];
	if (arguments[1] == null)
		p_month = new String(gNow.getMonth());
	else
		p_month = arguments[1];
	if (arguments[2] == "" || arguments[2] == null)
		p_year = new String(gNow.getFullYear().toString());
	else
		p_year = arguments[2];
	if (arguments[3] == null)
		p_format = "YYYY-MM-DD";
	else
		p_format = arguments[3];

	Build(p_item, p_month, p_year, p_format);
}
/*
Yearly Calendar Code Starts here
*/
function show_yearly_calendar() {
	// Load the defaults..
	//if (p_year == null || p_year == "")
	//	p_year = new String(gNow.getFullYear().toString());
	//if (p_format == null || p_format == "")
	//	p_format = "YYYY-MM-DD";

	p_item = arguments[0];
	if (arguments[1] == "" || arguments[1] == null)
		p_year = new String(gNow.getFullYear().toString());
	else
		p_year = arguments[1];
	if (arguments[2] == null)
		p_format = "YYYY-MM-DD";
	else
		p_format = arguments[2];

	Build(p_item, null, p_year, p_format);
}

</SCRIPT>
<script language="JavaScript" src="overlib_mini.js"></script>
</head>
<body>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<form name="uno" method="post">

<?	
	set_time_limit (300);
	$fecdig=(date("d/m/Y"));
	$hora=(date("H:i"));
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	if(empty($tipo))$tipo=1;
	echo "<table align=center>
	<tr  BGCOLOR='#E3E3ED'>
	<td align=center><font size=2>IDENTIFICACION</td>
	<td align=center><font size=2>FECHA INICIAL</td>
	<td align=center><font size=2>FECHA FINAL</td>
	<td align=center><font size=2>TIPO DE INFORME</td>
	</tr>
	<tr>
	<td><input type=text name=cedula onkeypress='buscar()' value='$cedula'></td>
	<td align=center>
	<p><input type=text name=fechai size=10 maxlength=10 onFocus='cambio(this)' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 45) event.returnValue = true;else event.returnValue = false' value='$fechai'>
	<a href=javascript:show_calendar('uno.fechai');>
	<img src='img/feed.png' title='Buscar' class='enlace1' border=0></a>
	</p>
	</td>
	<td align=center>
	<p><input type=text name=fechaf size=10 maxlength=10 onFocus='cambio(this)' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 45) event.returnValue = true;else event.returnValue = false' value='$fechaf'>
	<a href=javascript:show_calendar('uno.fechaf');>
	<img src='img/feed.png' title='Buscar' class='enlace1'  border=0></a>
	</p>
	</td>
	<td>
	<select name=tipo>";
	if($tipo==1)
	{
		echo"
		<option selected value=1>DETALLE</option>
		<option value=2>RESUMEN</option>";
	}
	if($tipo==2)
	{
		echo"
		<option value=1>DETALLE</option>
		<option selected value=2>RESUMEN</option>";
	}
	echo"</select>
	</td>
	</tr>
	<tr><td colspan=3 align=center><a href='#' onclick='buscar1()'>BUSCAR</A></td></tr>
	</table><br>";
	
	if($cedula!='')
	{
		if($tipo==1)
		{
			$busu=mysql_query("select * from usuario where NROD_USU='$cedula'");		
			$usuenco=0;		
			if(mysql_num_rows($busu)>0)
			{			
				while($row=mysql_fetch_array($busu))
				{
					$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
					$codiuniusu=$row['CODI_USU'];
					$usuenco=1;
				}
			}
			else
			{			
				$cedu=trim($cedula);
				$bnusu=mysql_query("SELECT ucontrato.CUSU_UCO, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
				FROM usuario INNER JOIN (nusuario INNER JOIN ucontrato ON nusuario.IUCO_NUS = ucontrato.IDEN_UCO) ON usuario.CODI_USU = ucontrato.CUSU_UCO
				WHERE (((nusuario.VALO_NUS)='$cedu') AND ((nusuario.CNOV_NUS)='N01'))");
				while($rcodn=mysql_fetch_array($bnusu))
				{
					$nombre=$rcodn['PNOM_USU'].' '.$rcodn['SNOM_USU'].' '.$rcodn['PAPE_USU'].' '.$rcodn['SAPE_USU'];
					$codiuniusu=$rcodn['CUSU_UCO'];
					$ceduhoy=$rcodn['NROD_USU'];
					$usuenco=2;
				}			
			}	
			if($usuenco==0)	
			{			
				echo "<table align=center>
				<tr>
				<td>USUARIO NO ENCONTRADO</td>
				</tr>
				</table>";
			}		
			else
			{			
				echo "<table align=center>";
				if($usuenco==2)
				{
					echo"
					<tr>
					<td>DOCUMENTO ANTERIOR: $cedula</td>
					<td>DOCUMENTO ACTUAL: $ceduhoy</td>
					</tr>
					<tr>
					<td colspan=2>Nombre: $nombre</td>
					</tr>
					<tr>
					<td colspan=2>Fecha y hora del informe: $fecdig - $hora</td>
					</tr>";
				}
				if($usuenco==1)
				{
					echo"
					<tr>
					<td>DOCUMENTO: $cedula</td>				
					</tr>
					<tr>
					<td>Nombre: $nombre</td>
					</tr>
					<tr>
					<td>Fecha y hora del informe: $fecdig - $hora</td>
					</tr>";
				}
				echo"			
				</table><BR><BR>";
				$cadena='';
				if($fechai!=' ')$cadena=$cadena." AND formulamae.fdis_for>='$fechai'";
				if($fechaf!='') $cadena=$cadena." AND formulamae.fdis_for<='$fechaf'";
				Mysql_select_db('formedica',$link);
				$cad="SELECT formulamae.nume_for, formuladet.regi_for, formulamae.fdis_for, formulamae.codi_medi,
				formuladet.codi_pro, formulamae.codi_bod, formulamae.scco_for, formuladet.codi_usu, 
				formuladet.cdis_for, formulamae.tido_for, formulamae.tdis_for
				FROM formuladet INNER JOIN formulamae ON formuladet.nume_for = formulamae.nume_for
				WHERE (((formulamae.codi_usu)='$cedula') AND ((formuladet.cdis_for)>0))
				$cadena ORDER BY formulamae.nume_for, formuladet.regi_for;"; 

				//echo $cad;		
						
				$resul=Mysql_query($cad,$link);
				$num=Mysql_num_rows($resul);			
				if($num>0)
				{	
					echo"<table align=center cellpadding=3><tr BGCOLOR='#E3E3ED'>
					<td align=center><font size=2>REGISTRO</td>
					<td align=center><font size=2>TIPO</td>
					<td align=center><font size=2>No.FORM</td>
					<td align=center><font size=2>PACIENTE</td>
					<td align=center><font size=2>REF. PROD</td>
					<td align=center><font size=2>DESCRIPCION</td>
					<td align=center><font size=2>AREA</td>
					<td align=center><font size=2>BOD.</td>
					<td align=center><font size=2>FECHA</td>
					<td align=center><font size=2>CANTI</td>
					<td align=center><font size=2>TD</td>
					<td align=center><font size=2>MEDICO</td>
					</tr>";
					while($row = mysql_fetch_array($resul))
					{					
						$prodpres1='';
						$registro=$row['regi_for'];
						$numformula=$row['nume_for'];
						$bodega=$row['codi_bod'];
						$fecha=$row['fdis_for'];									
						$codipro=$row['codi_pro'];					
						$canti=$row['cdis_for'];
						$medico=$row['codi_medi'];
						$subcentro=$row['scco_for'];
						$paciente=$row['codi_usu'];					
						$tipo=$row['tido_for'];
						$tipodis=$row['tdis_for'];
						Mysql_select_db('proinsalud',$link);
						$cadempl="select * from  medicos where csii_med='$medico'";
						$resem20=Mysql_query($cadempl,$link);
						while($rowem20 = mysql_fetch_array($resem20))
						{
							$nommedico=$rowem20['nom_medi'];						
						}						
						Mysql_select_db('formedica',$link);
						$cadempl="select * from  tipodocum where codi_tip='$tipo'";
						$reseml=Mysql_query($cadempl,$link);
						while($roweml = mysql_fetch_array($reseml))
						{
							$tipsii=$roweml['tsii_tip'];
							$numsii=$roweml['nsii_tip'];
							$concepto=$roweml['conc_tip'];
						}
						$tipnum=$tipsii.'-'.$numsii;
						Mysql_select_db('proinsalud',$link);
						$cadmed="SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
						FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
						WHERE medicamentos2.codi_mdi='$codipro'";
						$resmed=Mysql_query($cadmed,$link);
						$numr=mysql_num_rows($resmed);
						while($rowmed = mysql_fetch_array($resmed))
						{
							$prodpres=$rowmed['nomb_mdi'].' '.$rowmed['noco_mdi'].' '.$rowmed['desc_ffa'];            
							$prodpres1=substr($prodpres,0,53);
						}
						if($numr==0)
						{
							$cadmed=mysql_query("select *from medicamentos1 where codi_mdi='$codipro'");
							while($rowmed = mysql_fetch_array($cadmed))
							{
								$prodpres=$rowmed['nomb_mdi'];     
								$prodpres='** '.$prodpres;     
								$prodpres1=substr($prodpres,0,53);
							}					
						}					
						$cadmed="select *from insu_med where codi_ins='$codipro'";
						$resmed=Mysql_query($cadmed,$link);
						while($rowmed = mysql_fetch_array($resmed))
						{
							$prodpres=$rowmed['desc_ins'];            
							$prodpres1=substr($prodpres,0,60);
						}					
						if($subcentro!=4 && $subcentro!=5 && $subcentro!=6 && $subcentro!=7 && $subcentro!=12 && $subcentro!=15 && $subcentro!=16 && $subcentro!=17 && $subcentro!=18 && $subcentro!=20)
						{
							$nombrecentro='';
						}
						else
						{
							if($subcentro==4)$nombrecentro='URGENCIAS';
							if($subcentro==5)$nombrecentro='CONSULTA EXTERNA';
							if($subcentro==6)$nombrecentro='HOSPITALIZACION';
							if($subcentro==7)$nombrecentro='QUIROFANO';
							if($subcentro==12)$nombrecentro='PROM. Y PREV.';
							if($subcentro==15)$nombrecentro='MEDICINA ESPECIALIZADA';
							if($subcentro==16)$nombrecentro='ODONTOLOGIA';
							if($subcentro==17)$nombrecentro='MUNICIPIOS';
							if($subcentro==18)$nombrecentro='UCI ADULTOS';
							if($subcentro==20)$nombrecentro='UCI NEONATOS';
						}
						
						echo"
						<tr>
						<td><font size=2>$registro</td>
						<td><font size=2>$tipnum</td>
						<td><font size=2>$numformula</td>
						<td><font size=2>$paciente</td>
						<td><font size=2>$codipro</td>
						<td><font size=2>$prodpres1</td>
						<td><font size=2>$nombrecentro</td>
						<td><font size=2>$bodega</td>
						<td><font size=2>$fecha</td>
						<td><font size=2>$canti</td>
						<td><font size=2>$tipodis</td>
						<td><font size=2>$nommedico</td>
						</tr>";
					}
					echo"<table>";
				}				
				else
				{
					echo "<table align=center>
					<tr>
					<td>USUARIO NO ENCONTRADO</td>
					</tr>
					</table>";
				}		
			}
		}
		if($tipo==2)
		{
			Mysql_select_db('proinsalud',$link);			
			$busu=mysql_query("select * from usuario where NROD_USU='$cedula'");		
			$usuenco=0;		
			if(mysql_num_rows($busu)>0)
			{			
				
				
				while($row=mysql_fetch_array($busu))
				{
					$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
					$codiuniusu=$row['CODI_USU'];
					$usuenco=1;
					
				}
				
			}
			else
			{			
				$cedu=trim($cedula);
				$bnusu=mysql_query("SELECT ucontrato.CUSU_UCO, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
				FROM usuario INNER JOIN (nusuario INNER JOIN ucontrato ON nusuario.IUCO_NUS = ucontrato.IDEN_UCO) ON usuario.CODI_USU = ucontrato.CUSU_UCO
				WHERE (((nusuario.VALO_NUS)='$cedu') AND ((nusuario.CNOV_NUS)='N01'))");
				
				while($rcodn=mysql_fetch_array($bnusu))
				{
					$nombre=$rcodn['PNOM_USU'].' '.$rcodn['SNOM_USU'].' '.$rcodn['PAPE_USU'].' '.$rcodn['SAPE_USU'];
					$codiuniusu=$rcodn['CUSU_UCO'];
					$ceduhoy=$rcodn['NROD_USU'];
					$usuenco=2;
				}			
			}
		
			if($usuenco==0)	
			{			
				echo "<table align=center>
				<tr>
				<td>USUARIO NO ENCONTRADO</td>
				</tr>
				</table>";
			}			
			else
			{			
				
				echo "<table align=center>";
				if($usuenco==2)
				{
					echo"
					<tr>
					<td>DOCUMENTO ANTERIOR: $cedula</td>
					<td>DOCUMENTO ACTUAL: $ceduhoy</td>
					</tr>
					<tr>
					<td>Nombre: $nombre</td>
					</tr>
					<tr>
					<td colspan=2>Fecha y hora del informe: $fecdig - $hora</td>
					</tr>";
				}
				if($usuenco==1)
				{
					echo"
					<tr>
					<td>DOCUMENTO: $cedula</td>				
					</tr>
					<tr>
					<td>Nombre: $nombre</td>
					</tr>
					<tr>
					<td>Fecha y hora del informe: $fecdig - $hora</td>
					</tr>";
				}
					
				echo"			
				</table><BR><BR>";
				$cadena='';
				if($fechai!='')$cadena=$cadena." AND formulamae.fdis_for>='$fechai'";
				if($fechaf!='') $cadena=$cadena." AND formulamae.fdis_for<='$fechaf'";
				Mysql_select_db('formedica',$link);
				
				//echo "MMMMMMMMM";
				
				
				/*
				$cad="SELECT formulamae.scco_for, formulamae.tido_for, formuladet.codi_pro, Sum(formuladet.cdis_for) AS SumaDecdis_for
				FROM formuladet INNER JOIN formulamae ON formuladet.nume_for = formulamae.nume_for
				WHERE (((formulamae.coduni_usu)='$codiuniusu'))
				GROUP BY formulamae.scco_for, formulamae.tido_for, formuladet.codi_pro
				HAVING (((Sum(formuladet.cdis_for))>0))
				ORDER BY formulamae.scco_for, formulamae.tido_for, formuladet.codi_pro
				"; 	
				*/
				$cadena='';
				if($fechai!=' ')$cadena=$cadena." AND formulamae.fdis_for>='$fechai'";
				if($fechaf!='') $cadena=$cadena." AND formulamae.fdis_for<='$fechaf'";
				$cad="SELECT formulamae.scco_for, formuladet.codi_pro, Sum(formuladet.cdis_for) AS SumaDecdis_for
				FROM formuladet INNER JOIN formulamae ON formuladet.nume_for = formulamae.nume_for
				WHERE (((formulamae.tido_for)<9 And (formulamae.tido_for)<>5 And (formulamae.tido_for)<>8) AND ((formulamae.coduni_usu)='$codiuniusu') $cadena)
				GROUP BY formulamae.scco_for, formuladet.codi_pro
				HAVING (((Sum(formuladet.cdis_for))>0))
				ORDER BY formulamae.scco_for, formuladet.codi_pro";
				
				
				
				$resul=Mysql_query($cad,$link);
				
				$num=Mysql_num_rows($resul);			
				if($num>0)
				{					
					
					echo"<table align=center cellpadding=3><tr BGCOLOR='#E3E3ED'>					
					<td align=center><font size=2>PACIENTE</td>
					<td align=center><font size=2>REF. PROD</td>
					<td align=center><font size=2>DESCRIPCION</td>
					<td align=center><font size=2>AREA</td>
					<td align=center><font size=2>DISPENSADO</td>
					<td align=center><font size=2>DEVOLUCION</td>	
					<td align=center><font size=2>TOTAL</td>
					</tr>";
					
					while($row = mysql_fetch_array($resul))
					{					
						$prodpres1='';												
						$codipro=$row['codi_pro'];					
						$canti=$row['SumaDecdis_for'];
						$subcentro=$row['scco_for'];
						$cantidev=0;
						
						Mysql_select_db('formedica',$link);
						
						$bdev=mysql_query("SELECT Sum(formuladet.cdis_for) AS SumaDecdis
						FROM formuladet INNER JOIN formulamae ON formuladet.nume_for = formulamae.nume_for
						WHERE (((formulamae.scco_for)='$subcentro') AND ((formuladet.codi_pro)='$codipro') AND ((formulamae.tido_for)='9' Or (formulamae.tido_for)='10') AND ((formulamae.coduni_usu)='$codiuniusu'))
						HAVING (((Sum(formuladet.cdis_for))>0))");
						while($rdec=mysql_fetch_array($bdev))
						{
							$cantidev=$rdec['SumaDecdis'];						
						}
						
						$cadempl="select * from  tipodocum where codi_tip='$tipo'";
						$reseml=Mysql_query($cadempl,$link);
						while($roweml = mysql_fetch_array($reseml))
						{
							$tipsii=$roweml['tsii_tip'];
							$numsii=$roweml['nsii_tip'];
							$concepto=$roweml['conc_tip'];
							$nomtipo=$roweml['desc_tip'];
						}
						$tipnum=$tipsii.'-'.$numsii;
						Mysql_select_db('proinsalud',$link);
						$cadmed="SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
						FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
						WHERE medicamentos2.codi_mdi='$codipro'";
						$resmed=Mysql_query($cadmed,$link);
						$numr=mysql_num_rows($resmed);
						while($rowmed = mysql_fetch_array($resmed))
						{
							$prodpres=$rowmed['nomb_mdi'].' '.$rowmed['noco_mdi'].' '.$rowmed['desc_ffa'];            
							$prodpres1=substr($prodpres,0,53);
						}
						if($numr==0)
						{
							$cadmed=mysql_query("select *from medicamentos1 where codi_mdi='$codipro'");
							while($rowmed = mysql_fetch_array($cadmed))
							{
								$prodpres=$rowmed['nomb_mdi'];     
								$prodpres='** '.$prodpres;     
								$prodpres1=substr($prodpres,0,53);
							}					
						}					
						$cadmed="select *from insu_med where codi_ins='$codipro'";
						$resmed=Mysql_query($cadmed,$link);
						while($rowmed = mysql_fetch_array($resmed))
						{
							$prodpres=$rowmed['desc_ins'];            
							$prodpres1=substr($prodpres,0,60);
						}
											
						if($subcentro!=4 && $subcentro!=5 && $subcentro!=6 && $subcentro!=7 && $subcentro!=12 && $subcentro!=15 && $subcentro!=16 && $subcentro!=17 && $subcentro!=18 && $subcentro!=20)
						{
							$nombrecentro='';
						}
						else
						{
							if($subcentro==4)$nombrecentro='URGENCIAS';
							if($subcentro==5)$nombrecentro='CONSULTA EXTERNA';
							if($subcentro==6)$nombrecentro='HOSPITALIZACION';
							if($subcentro==7)$nombrecentro='QUIROFANO';
							if($subcentro==12)$nombrecentro='PROM. Y PREV.';
							if($subcentro==15)$nombrecentro='MEDICINA ESPECIALIZADA';
							if($subcentro==16)$nombrecentro='ODONTOLOGIA';
							if($subcentro==17)$nombrecentro='MUNICIPIOS';
							if($subcentro==18)$nombrecentro='UCI ADULTOS';
							if($subcentro==20)$nombrecentro='UCI NEONATOS';
						}
						
						$total=$canti-$cantidev;
						echo"<tr>
						<td><font size=2>$cedula</td>						
						<td><font size=2>$codipro</td>
						<td><font size=2>$prodpres1</td>
						<td><font size=2>$nombrecentro</td>
						<td align=center><font size=2>$canti</td>
						<td align=center><font size=2>$cantidev</td>
						<td align=center><font size=2>$total</td>
						</tr>";
						
					}
					
					echo"<table>";
					
				}				
				else
				{
					echo "<table align=center>
					<tr>
					<td>USUARIO NO ENCONTRADO</td>
					</tr>
					</table>";
				}
				
			}
		}
	}
?>	
</tr>
</table>
</form> 
</body>
</html>