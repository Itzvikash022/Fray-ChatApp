const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault(); //Preventing form from submitting
};
sendBtn.onclick = () =>{
    //Ajax code here
    let xhr = new XMLHttpRequest(); //XMl Object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              inputField.value = ""; //makes the input field empty once the msg is stored in db
              scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = () =>{
  chatBox.classList.add("active");
}
chatBox.onmouseleave = () =>{
  chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest(); //XMl Object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () =>{
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          // console.log(data);
          chatBox.innerHTML = data;
          if(!chatBox.classList.contains("active")){
            scrollToBottom();
          }
        }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
  }, 500); //this function will run frequently after 500ms

  function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }