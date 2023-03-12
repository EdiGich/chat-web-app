const form = document.querySelector(".signup form"),
continueBtn =form.querySelector(".button input"),
errorText =form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();//preventing form from submitting
}

continueBtn.onclick = ()=>{
    //starting Ajax
    let xhr = new XMLHttpRequest(); //Creating XML object
    xhr.open("POST", "php/signup.php", true);//xhr.open takes many parameters we only pass method, url and async
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status ===200){
                    let data = xhr.response;//xhr.response gives response of that passed url
                    if(data ==="success"){
                        location.href = "users.php";
                    }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                    
                    }
                }
            }
    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);//Creating new formData object
    xhr.send(formData); //sending the form data to php
}