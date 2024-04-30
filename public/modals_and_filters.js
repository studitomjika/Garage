document.getElementById("filterButton").style.display = "none";

document.getElementById("price-select").onchange = requestFilteredCarDeals;
document.getElementById("km-select").onchange = requestFilteredCarDeals;
document.getElementById("year-select").onchange = requestFilteredCarDeals;

var carDealSection = document.getElementsByClassName('car-deals-section')[0]
carDealSection.innerHTML = "";

//requestFilteredCarDeals();
requestFilteredCarDeals_viaAPI();

async function requestFilteredCarDeals(){

  const parameters = {
    range_price: document.getElementById("price-select").value,
    range_km: document.getElementById("km-select").value,
    range_year: document.getElementById("year-select").value,
  };

  await fetch("https://127.0.0.1:8000/home?" + new URLSearchParams(parameters), {
    method: "GET",
    headers: {
      'credentials': 'same-origin',
      'X-Requested-With': 'XMLHttpRequest',
      'Content-Type': 'application/json'
    }
  })
  .then((response) => response.text())
  .then((text) => {
    carDealSection.innerHTML = text;
    setupEvents();
  })
}

async function requestFilteredCarDeals_viaAPI(){

  const parameters = {
    price: "%5Bbetween%5D=0..90000",
    kilometers: "%5Bbetween%5D=40000..90000",
    year: "%5Bbetween%5D=0..90000"
  };

  await fetch("https://127.0.0.1:8000/api/voiture_d_occasions?" + new URLSearchParams(parameters), {
    method: "GET",
    headers: {
      'credentials': 'same-origin',
      'X-Requested-With': 'XMLHttpRequest',
      'Content-Type': 'application/json'
    }
  })
  .then(response => response.json().then(data => ({status: response.status, body: data})))
  .then((obj) =>  {
    carDeals_array = obj.body["hydra:member"]
  
    for (const carDeal of carDeals_array)
    {
      console.log(carDeal)
      carDealSection.innerHTML += 

      "<div class=\'car-deal show\'><div class=\'photo\'>\
        <a class=\'like-button open-modal-onclick deal-contact\' data-modal=\'modal-contact\'>Contact</a>\
        <img src= \'/img\/" + carDeal.pictureFilename + "' alt=\'\' width=\'100\%\' height=\'100\%\'>\
        </div>\
        <div class=\'twoline\'>\
            <p class=\'model\'>" + carDeal.model + "</p>\
        </div>\
        <p class=\'km\'>" + carDeal.kilometers + " km</p>\
        <p class=\'year\'>" + carDeal.year + "</p>\
        <p class=\'price\'>" + carDeal.price +" €</p>\
        <p class=\'id_car_deal hidden\'>" + carDeal.id + "</p>\
      </div>"
    }
    setupEvents()
  });
}

function setupEvents() {
  setEventOpenModalOnclick()
  setEventCloseModalOnclick()
  setEventContactGeneric()
  setEventCarDealContact()
}

function setEventOpenModalOnclick() {
  document.querySelectorAll(".open-modal-onclick").forEach(el => {
    el.addEventListener("click", (evt) => {
      let idModal = el.getAttribute("data-modal")
      let modal = document.querySelector("#"+idModal)
      
      if( modal !== null) { modal.classList.add("show") }

      evt.preventDefault()
    })
  });
}

function setEventCloseModalOnclick() {
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
}

function setEventContactGeneric() {
  document.querySelectorAll(".contact-generic").forEach(el => {
    el.addEventListener("click", (evt) => {
      document.getElementById("contact_subject").value = ""
      document.getElementById("contact_subject").removeAttribute("readonly")

      evt.preventDefault()
    })
  });
}

function setEventCarDealContact() {
  document.querySelectorAll(".deal-contact").forEach(el => {
    el.addEventListener("click", (evt) => {
      
      let modelText = el.parentElement.parentElement.getElementsByClassName("model")[0].textContent
      
      let textCarDeal = "Annonce: " + modelText
      document.getElementById("contact_subject").value = textCarDeal
      document.getElementById("contact_subject").setAttribute("readonly", "readonly") //dependant du navigateur

      evt.preventDefault()
    })
  });
}