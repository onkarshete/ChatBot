const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
attBtn = form.querySelector("#image-att"),
chatBox = document.querySelector(".chat-box"),
headerInfo = document.querySelector(".header-info"),
userActive = document.querySelector(".user-active").value;

form.onsubmit = (e)=>{
    e.preventDefault();
}

req();

function req() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response;
        chatBox.innerHTML = data;
        scrollToBottom();
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id="+incoming_id);
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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            form.reset();
            let data = xhr.response;
            if(data == "exit"){
              window.location.href = "http://localhost/ChatApp/";
            }

            inputField.value = "";
            sendBtn.classList.remove("active");
            inputField.disabled = false;
            req();
            scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

// chatBox.onmouseenter = ()=>{
//     chatBox.classList.add("active");
// }

// chatBox.onmouseleave = ()=>{
//     chatBox.classList.remove("active");
// }

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            // if(!chatBox.classList.contains("active")){
            //     scrollToBottom();
            //   }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-info.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            headerInfo.innerHTML = data;
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("header_id="+incoming_id);
}, 500);

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/activity.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          //console.log(data);
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("userActive=" + userActive);
}, 500);

attBtn.onchange = function () {
   inputField.value = this.value.split("\\")[2];
   inputField.disabled = true;
   sendBtn.classList.add("active");
};