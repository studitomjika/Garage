document.getElementById("filterButton").style.display = "none";

document.getElementById("price-select").onchange = requestFilteredCarDeals;
document.getElementById("km-select").onchange = requestFilteredCarDeals;
document.getElementById("year-select").onchange = requestFilteredCarDeals;

var carDealDiv = document.getElementsByClassName('car-deals-section')[0].getElementsByClassName('car-deal')[0];

var carDealSection = document.getElementsByClassName('car-deals-section')[0]
carDealSection.innerHTML = "";


let filteredCarDealsResults = [];

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
  })
}

requestFilteredCarDeals_viaAPI();

let carDeals_array = []

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
  .then(obj =>  carDeals_array = obj.body["hydra:member"]);
  
  for (const carDeal of carDeals_array)
  {
    console.log(carDeal)
    carDealSection.innerHTML += 

    "<div class=\'car-deal show\'><div class=\'photo\'>\
      <img src= \'/img\/" + carDeal.pictureFilename + "' alt=\'\' width=\'100\%\' height=\'100\%\'>\
      </div>\
      <div class=\'twoline\'>\
          <p class=\'" + carDeal.model + "\'>model</p>\
      </div>\
      <p class=\'km\'>" + carDeal.kilometers + " km</p>\
      <p class=\'year\'>" + carDeal.year + "</p>\
      <p class=\'price\'>" + carDeal.price +" €</p>\
      <p class=\'id_car_deal hidden\'>" + carDeal.id + "</p>\
    </div>"
  }
}