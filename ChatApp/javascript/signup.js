const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text"),
overlay = document.querySelector("#overlay");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    overlay.style.display = 'flex';
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                errorText.style.display = "block";
                errorText.innerHTML = "SignUp Successful. Check your mail for Verification Link";
                overlay.style.display = 'none';
              }else{
                errorText.style.display = "block";
                errorText.innerHTML = data;
                overlay.style.display = 'none';
              }
              grecaptcha.reset();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

