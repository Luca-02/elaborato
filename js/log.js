function showPass() {
  var x = document.getElementById("MyPass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x2 = document.getElementById("MyPass2");
  if (x2.type === "password") {
    x2.type = "text";
  } else {
    x2.type = "password";
  }
}
