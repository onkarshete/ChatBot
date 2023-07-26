const form = document.querySelector(".reset form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text"),
redirectText = document.querySelector(".redirect-text"),
overlay = document.querySelector("#overlay");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    overlay.style.display = 'flex';
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/resetpassword.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                errorText.style.display = "block";
                errorText.textContent = "Password Reset Successful. Check your mail for New Password";
                redirectText.innerHTML = "Redirecting in 5 Seconds if not Redirected <a href='login.php'> Click Here </a>";
                overlay.style.display = 'none';
                setTimeout(function(){
                  location.href = 'login.php';
                }, 5000);
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
                overlay.style.display = 'none';
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

