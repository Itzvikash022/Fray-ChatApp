const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".btn input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault(); //Preventing form from submitting
};

continueBtn.onclick = () => {
  //Ajax code here
  let xhr = new XMLHttpRequest(); //XMl Object
  xhr.open("POST", "php/login.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          console.log("suc");
          location.href = "users.php";
        } else {
          // console.log(data);
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
