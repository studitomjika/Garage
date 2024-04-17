document.querySelectorAll(".open-modal-onclick").forEach(el => {
  el.addEventListener("click", (evt) => {
    let idModal = el.getAttribute("data-modal")
    let modal = document.querySelector("#"+idModal)
    console.log(idModal)
    if( modal !== null) { modal.classList.add("show") }

    evt.preventDefault()
  })
});

/* document.querySelectorAll(".deal-contact").forEach(el => {
  el.addEventListener("click", (evt) => {
    
    let modelText = el.parentElement.parentElement.getElementsByClassName("model")[0].textContent
    let idText = el.parentElement.parentElement.getElementsByClassName("id_car_deal")[0].textContent

    let textCarDeal = "Annonce: " + modelText
    document.getElementById("subject").value = textCarDeal
    document.getElementById("subject").setAttribute("disabled", "disabled")
    document.getElementById("id_car_deal").value = idText

    evt.preventDefault()
  })
}); */

/* document.querySelectorAll(".contact-generic").forEach(el => {
  el.addEventListener("click", (evt) => {
    
    if( document.getElementById("id_car_deal") !== null && document.getElementById("id_car_deal").value != "") {
      document.getElementById("subject").value = ""
      document.getElementById("subject").removeAttribute("disabled")
      document.getElementById("id_car_deal").value = ""
    }

    evt.preventDefault()
  })
}); */

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
