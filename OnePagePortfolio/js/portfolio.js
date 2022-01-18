/*
====================================
    Desktop Navigation
====================================
*/

window.addEventListener("scroll", function(){
    if(window.scrollY < 300 && document.querySelector("nav").classList.contains("active") && window.innerWidth > 700){
        document.querySelector("nav").classList.toggle("active");
    }else if(window.scrollY > 300 && !document.querySelector("nav").classList.contains("active") && window.innerWidth > 700){
        document.querySelector("nav").classList.toggle("active");
    } 
});

/*
====================================
    Mobile Navigation
====================================
*/

if(document.querySelector(".mobile-nav-icon")){
    document.querySelector(".mobile-nav-icon").addEventListener('click', function(){
        document.querySelector(".mobile-nav-icon").classList.toggle("active");
        document.querySelector("nav").classList.toggle("active");
    });
}

if(window.innerWidth <= 700){
    links = document.querySelectorAll('nav ul li a');
    links.forEach(link => {
        link.addEventListener("click", function(){
            document.querySelector("nav").classList.toggle("active");
        });
    })
}

/*
====================================
    Portfolio Section
====================================
*/
if(document.querySelector(".portfolio")){
    let portfolios = document.querySelectorAll(".p-item");
    portfolios.forEach(p => {
        //toggle modal active
        let modal = p.querySelector(".modal"),
        mOpen = p.querySelector(".m-open"),
        mClose = p.querySelector(".m-close"),
        left = p.querySelector(".m-left"),
        right = p.querySelector(".m-right"),
        imgs = p.querySelector(".modal").querySelectorAll("img"),
        width ="";

        mOpen.addEventListener("click", function(){
            modal.classList.toggle("active");
            //set image positions
            width = modal.querySelector(".m-container").offsetWidth;
            set_images(imgs, width);
        });

        //close the modal
        mClose.addEventListener("click", function(){
            modal.classList.toggle("active");
        });
        
        //add listener to carousel buttons m-left and m-right
        left.addEventListener("click", function(){
            carousel(-1, imgs, width);
        });
        right.addEventListener("click", function(){
            carousel(1, imgs, width);
        });
        
    });
} 

function set_images(imgs, width){
    for(i=0; i<imgs.length; i++){
        pos = i*width + "px";
        imgs[i].style.left = pos;
    }
}

function carousel(num, imgs, width){
    img0 = parseInt(imgs[0].style.left);
    img1 = parseInt(imgs[imgs.length -1].style.left)
    switch (num) {
        case -1:
            if(img0 < 0){
                imgs.forEach(img =>{
                    pos = parseInt(img.style.left) - (num * width);
                    pos += "px";
                    img.style.left = pos;
                });
            }
            break;
        case 1:
            if(img1 > 0){
                imgs.forEach(img =>{
                    pos = parseInt(img.style.left) - (num * width);
                    pos += "px";
                    img.style.left = pos;
                });
            }
            break;
        default:
            break;
    }
    
;
    
}

/*
====================================
    Portfolio Tags 
====================================
*/
if(document.querySelector(".portfolio")){
    let p = document.querySelector(".p-tags"),
        items = p.querySelectorAll('.p-tag');
        items.forEach(function(item){
            item.addEventListener("click", function(){
                items.forEach(function(item){
                    if(item.classList.contains("active")){
                        item.classList.remove("active");
                    }
                })
                sort_portfolio(item, item.innerHTML);
            })
        });
}

function sort_portfolio(item, text){
    let portfolio = document.querySelectorAll(".p-item");
    text = text.toUpperCase();
    portfolio.forEach(function(p){
        if(text == 'ALL'){
            p.style.display = "block";
        }else{
            if(p.querySelector("p").innerHTML.indexOf(text) == -1){
            p.style.display = "none";
            }else{
                p.style.display = "block";
            }
        }
        
        item.classList.toggle("active");
        
        
    });

}

/*
====================================
    Contact Form
====================================
*/
if(document.querySelector("#contact-form")){
    document.querySelector("#contact-form").addEventListener("submit", function(e){
        e.preventDefault();
        contact_form_ajax(this);
    });
}

function contact_form_ajax(form){
    let action = "?action=contact_form_post",
    name = form.name.value,
    email = form.email.value,
    message = form.message.value,
    url = form.dataset.url + action,
    xhr = new XMLHttpRequest;

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhr.onload = function(){
        resp = document.querySelector("#contact-form-response");
        resp.classList.toggle("active");
        resp.innerHTML = `<p>${this.responseText}</p>`;
        form.submit.disabled = true;
        form.submit.style.display = "none";
        
        setTimeout(function(){ 
            form.name.value = "";
            form.email.value = "";
            form.message.value = "";
            form.submit.disabled = false;
            form.submit.style.display = "block";
            resp.classList.toggle("active");
        }, 4000);
    }

    xhr.send(`name=${name}&email=${email}&message=${message}`);
}

