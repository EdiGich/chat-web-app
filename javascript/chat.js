const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    //starting ajax
    let xhr = new XMLHttpRequest();//creating xml object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = ""; //oncethe message has been inserted into the database leave the input field blank.
              scrollToBottom();
          }
      }
    }
    //sends the form data through Ajax to PHP.
    let formData = new FormData(form); //creating new form data object.
    xhr.send(formData); //sending the form data to php.
}

//stopping The scrollToBottom function when user scrolls to top intentionally.
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    //start Ajax.
    let xhr = new XMLHttpRequest(); //creatting xml object.
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            //stopping The scrollToBottom function when user scrolls to top intentionally.
             //if the active class is not contained iin the chatbox, scroll to bottom.
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

//function to scroll to bottom automatically.
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  