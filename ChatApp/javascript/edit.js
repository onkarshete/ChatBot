const form = document.querySelector(".edit form"),
updateBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

updateBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/edit.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="users.php";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}