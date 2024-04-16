document.getElementById("price-select").onchange = filterSelection;
document.getElementById("km-select").onchange = filterSelection;
document.getElementById("year-select").onchange = filterSelection;

function filterSelection(evt) {
  const currentPrice = document.getElementById("price-select").options[document.getElementById("price-select").selectedIndex].value;
  const currentKM = document.getElementById("km-select").options[document.getElementById("km-select").selectedIndex].value;
  const currentYear = document.getElementById("year-select").options[document.getElementById("year-select").selectedIndex].value;
  const carDeals = document.getElementsByClassName("car-deal");
  
  const carDealsFilteredPrice = [...carDeals].filter(function (carDeal) {
    let priceValue = carDeal.getElementsByClassName("price")[0].innerText.slice(0, -2);
    switch (currentPrice) {
      case "bracket1" :
        return priceValue < 1500;
      case "bracket2" :
        return priceValue >= 1500 && priceValue < 3000;
      case "bracket3" :
        return priceValue >= 3000 && priceValue < 9000;
      case "bracket4" :
        return priceValue >= 9000;
      case "all":
        return true;
    }
  });
  
  const carDealsFilteredKM = carDealsFilteredPrice.filter(function (carDeal) {
    let kmValue = carDeal.getElementsByClassName("km")[0].innerText.slice(0, -3);
    switch (currentKM) {
      case "bracket1" :
        return kmValue < 15000;
      case "bracket2" :
        return kmValue >= 15000 && kmValue < 40000;
      case "bracket3" :
        return kmValue >= 40000 && kmValue < 90000;
      case "bracket4" :
        return kmValue >= 90000;
      case "all":
        return true;
    }
  });
  
  const carDealsFilteredYear = carDealsFilteredKM.filter(function (carDeal) {
    let yearValue = carDeal.getElementsByClassName("year")[0].innerText;
    switch (currentYear) {
      case "bracket1" :
        return yearValue < 2000;
      case "bracket2" :
        return yearValue >= 2000 && yearValue <= 2007;
      case "bracket3" :
        return yearValue >= 2008 && yearValue <= 2014;
      case "bracket4" :
        return yearValue >= 2015;
      case "all":
        return true;
    }
  });
  
  for (const element of carDeals)
    RemoveShowClass(element, "show");

  for (const element of carDeals)
  {
    if( [...carDealsFilteredYear].includes(element) )
      AddShowClass(element, "show")
  }
}

function AddShowClass(element, name) {
  let i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveShowClass(element, name) {
  let i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}