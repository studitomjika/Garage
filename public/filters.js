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

requestFilteredCarDeals();