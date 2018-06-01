function formValidation()
{
var passid = document.myForm.pass;
var name = document.myForm.fullname;
var uni = document.myForm.univ;
var ph = document.myForm.phone;
var email = document.myForm.email;
if(passid_validation(passid,7,12))
{
if(allLetter(name))
{
if(alphanumeric(uni))
{ 
if(phonenumber(ph))
{
if(ValidateEmail(email))
{
  return true;
} 
}
} 
}
}
return false;
} 
function passid_validation(passid,mx,my)
{
var passid_len = passid.value.length;
if (passid_len == 0 ||passid_len >= my || passid_len < mx)
{
alert("Password should not be empty / length be between "+mx+" to "+my);
passid.focus();
return false;
}
return true;
}
function allLetter(name)
{ 
var letters = /^[A-Za-z]+$/;
if(name.value.match(letters))
{
return true;
}
else
{
alert('Name must have alphabet characters only');
name.focus();
return false;
}
}
function alphanumeric(uni)
{ 
var letters = /^[0-9a-zA-Z]+$/;
if(uni.value.match(letters))
{
return true;
}
else
{
alert('University Name must have alphanumeric characters only');
uni.focus();
return false;
}
}
function phonenumber(ph)
{
  var phoneno = /^\d{10}$/;
  if(ph.value.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Phone Number");
        ph.focus();
		return false;
        }
}
function ValidateEmail(email)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(email.value.match(mailformat))
{
return true;
}
else
{
alert("You have entered an invalid email address!");
email.focus();
return false;
}
} 