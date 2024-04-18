document.querySelectorAll(".open-modal-onclick").forEach(el => {
  el.addEventListener("click", (evt) => {
    let idModal = el.getAttribute("data-modal")
    let modal = document.querySelector("#"+idModal)
    
    if( modal !== null) { modal.classList.add("show") }

    evt.preventDefault()
  })
});

document.querySelectorAll(".deal-contact").forEach(el => {
  el.addEventListener("click", (evt) => {
    
    let modelText = el.parentElement.parentElement.getElementsByClassName("model")[0].textContent
    
    let textCarDeal = "Annonce: " + modelText
    document.getElementById("contact_subject").value = textCarDeal
    document.getElementById("contact_subject").setAttribute("readonly", "readonly")

    evt.preventDefault()
  })
});

document.querySelectorAll(".contact-generic").forEach(el => {
  el.addEventListener("click", (evt) => {
    document.getElementById("contact_subject").value = ""
    document.getElementById("contact_subject").removeAttribute("readonly")

    evt.preventDefault()
  })
});

document.querySelectorAll(".close-modal-onclick").forEach(el => {
  el.addEventListener("click", (evt) => {

    let formFailElement = document.querySelector("#modal-connect .form-fail")
    if(formFailElement) formFailElement.remove()
    
    document.querySelectorAll(".modal").forEach(el => {
        el.classList.remove('show');
    })

    evt.preventDefault()
  })
});


/*let emailConnect = document.getElementById("login");
emailConnect.addEventListener("keyup", function (event) {
  if(emailConnect.validity.typeMismatch) {
    emailConnect.setCustomValidity("Veuillez entrer un mail")
  } else {
    emailConnect.setCustomValidity("")
  }
});*/

/*let emailContact = document.getElementById("mail")
emailContact.addEventListener("keyup", function (event) {
  if(emailContact.validity.typeMismatch) {
    emailContact.setCustomValidity("Veuillez entrer un mail")
  } else {
    emailContact.setCustomValidity("")
  }
});*/

/*let telContact = document.getElementById("tel")
telContact.addEventListener("keyup", function (event) {
  if(telContact.validity.patternMismatch) {
    telContact.setCustomValidity("Veuillez entrer un numéro de téléphone")
  } else {
    telContact.setCustomValidity("")
  }
});*/
