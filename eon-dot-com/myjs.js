var stl = "0112R12";
var l= stl.length;
var statusmsc = "";
var statuslsn = "";
var statuswsn = "";
var statushsn = "";

if (l != 7) {
	status = "storage code must be of 7 digit";
} else {

	var msc = stl[0]+stl[1];
	var lsn = stl[2]+stl[3];
	var wsn = stl[4];
	var hsn = stl[5]+stl[6];

	for(i = 0 ; i < 100 ; i++) {
		if (msc == i) {
			statusmsc = "1";
			document.write(i);
			exit();
	    } 
	    else {
	    	statusmsc = "Main Storage Code not set";
	    }   
	}

	for(i = 0 ; i < 100 ; i++) {
		if (lsn == i) {
			statuslsn = "1";
			document.write(i);
			exit();
	    } 
	    else {
	    	statuslsn = "Leanth Scale Number not set";
	    }   
	}

	for(i = 65 ; i < 97 ; i++) {
		var charCode = String.fromCharCode(i);
		if (wsn == charCode) {
			statuswsn = "1";
			document.write(i);
			exit();
	    } 
	    else {
	    	statuslsn = "Width Scale Number not set";
	    }   
	}

	for(i = 0 ; i < 100 ; i++) {
		if (hsn == i) {
			statushsn = "1";
			document.write(i);
			exit();
	    } 
	    else {
	    	statushsn = "Height Scale Number not set";
	    }   
	}

	if ( statusmsc == 1) {
		if (statuslsn == 1) {
			if (statuswsn == 1) {
				if (statushsn == 1) {
					document.getElementById("stl").innerHTML= "done";
				}
				else {
					document.getElementById("stl").innerHTML= statushsn;
					return false;
				}
			}
			else {
				document.getElementById("stl").innerHTML= statuswsn;
				return false;
			}
		}
		else {
			document.getElementById("stl").innerHTML= statuslsn;
			return false;
		}
	}
	else {
		document.getElementById("stl").innerHTML= statusmsc;
		return false;
	}
}