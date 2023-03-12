const searchBar = document.querySelector(".users .search input"),
searchIcon = document.querySelector(".users .search button");
usersList = document.querySelector(".users .users-list");

searchIcon.onclick = () =>{
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if(searchBar.classList.contains("active")){
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
      searchBar.classList.add("active");
    }else{
      searchBar.classList.remove("active");//adding an active class when user starts searching
      //and only run the setInterval ajax if there is no active class.
    }
    //Starting Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            usersList.innerHTML = data;
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
  }

    setInterval(()=>{
//starting Ajax
let xhr = new XMLHttpRequest(); //Creating XML object
xhr.open("GET", "php/users.php", true);//xhr.open takes many parameters we only pass method, url and async
xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status ===200){
                let data = xhr.response;//xhr.response gives response of that passed url
                if(!searchBar.classList.contains("active")){//if active not contained in search bar then add this data.
                  usersList.innerHTML = data;
                }               
            }
        }
}
xhr.send();
    }, 500); //this function will run frequently after 500ms

