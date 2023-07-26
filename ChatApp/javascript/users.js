const usersList = document.querySelector(".users-list"),
userActive = document.querySelector(".user-active").value;

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          //if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data;
          //}
        }
    }
  }
  xhr.send();
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
