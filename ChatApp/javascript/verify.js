const token = document.querySelector(".token").value,
errorText = document.querySelector(".error-text"),
redirectText = document.querySelector(".redirect-text");

window.onload = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/verify.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                errorText.style.display = "block";
                errorText.textContent = "Email is Succesfully Verified";
                redirectText.innerHTML = "Redirecting in 5 Seconds if not Redirected <a href='login.php'> Click Here </a>";
                setTimeout(function(){
                  location.href = 'login.php';
                }, 5000);
              }else{
                errorText.style.display = "block";
                errorText.innerHTML = data;
                redirectText.innerHTML = "<p>(Try to <a href='login.php'> Login </a>)</p>";
              }
          }
      }
    }
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send("token="+token);
}