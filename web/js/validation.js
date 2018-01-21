function chkName() {

// Get the target node of the event

  var myName = document.getElementById("regname").value;

// Test the format of the input name 
//  Allow the spaces after the commas to be optional
//  Allow the period after the initial to be optional

  var pos = myName.search(/^[A-Za-z]+[A-Za-z ]*$/);
	if(myName ==null || myName=="")
	{
		document.getElementById("sname").className="";
	}else{
		if (pos != 0) {
			document.getElementById("sname").className= "";
			document.getElementById("notif1").innerHTML="Your name must only contain alphabets";
		}else {
			document.getElementById("sname").className= "fa fa-check";
			document.getElementById("notif1").innerHTML="";
		}
	}
}

// ********************************************************** //
// The event handler function for the phone number text box

function chkEmail() {

// Get the target node of the event

  var myEmail = document.getElementById("regemail").value;

// Test the format of the input phone number
 
  var pos2 = myEmail.search(/^[A-Za-z-.]+@[A-Za-z.-]+\.[A-Za-z]{2,3}$/);
	if(myEmail ==null || myEmail=="")
	{
		document.getElementById("semail").className="";
	}else{
		if (pos2 != 0) {
			document.getElementById("semail").className= "";
			document.getElementById("notif2").innerHTML="Your email should contain @xx.xx";
		}else {
			document.getElementById("semail").className= "fa fa-check";
			document.getElementById("notif2").innerHTML="";
		}
	}
}

function chkPass() {

// Get the target node of the event

  var myPass = document.getElementById("regpassword").value;

  var pos2 = myPass.search(/^[\w]{6,}$/);

  if(myPass ==null || myPass=="")
	{
		document.getElementById("spassword").className="";
	}else{
		if (pos2 != 0) {
			document.getElementById("spassword").className= "";
			document.getElementById("notif3").innerHTML="Your password must contain at least 6 characters";
		}else {
			document.getElementById("spassword").className= "fa fa-check";
			document.getElementById("notif3").innerHTML="";
		}
	}
}
function chkSame() {

// Get the target node of the event

  var myPass = document.getElementById("regpassword").value;
  var myPass2 = document.getElementById("regconpassword").value;    

if(myPass != myPass2)
{
    document.getElementById("spassword2").className= "";
    document.getElementById("notif4").innerHTML="Your pasword is not the same";
}
else
{
    document.getElementById("spassword2").className= "fa fa-check ";
			document.getElementById("notif4").innerHTML="";
}

}
function chkTelp() {

// Get the target node of the event

  var myTelp = document.getElementById("regtelephone").value;

  var pos2 = myTelp.search(/^[\d]{8,}$/);

if(myTelp ==null || myTelp=="")
	{
		document.getElementById("stelephone").className="";
	}else{
		if (pos2 != 0) {
			document.getElementById("stelephone").className= "";
			document.getElementById("notif5").innerHTML="Your telephone must contain at least 8 numbers";
		}else {
			document.getElementById("stelephone").className= "fa fa-check";
			document.getElementById("notif5").innerHTML="";
		}
	}

}

