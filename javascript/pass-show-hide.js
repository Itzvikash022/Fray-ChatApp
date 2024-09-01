const pass = document.querySelector(".form input[type='password']"),
toggleBtn = document.querySelector(".form .field i")

toggleBtn.onclick = () =>{
    if(pass.type == "password"){
        pass.type = "text"
        toggleBtn.classList.add("active")
    }
    else{
        pass.type = "password"
        toggleBtn.classList.remove("active")
    }
}
