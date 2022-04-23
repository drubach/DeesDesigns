/* Function to display price by drop down choice. */

function getPrice(value){
    if (value == 1) {
        price = 150.00;
    } else if (value == 2) {
        price = 500.00;
    }else if (value == 3) {
        price = 1000.00;
    }else if (value == 4) {
        price = 5000.00;
    }
    document.getElementById("type-price").innerHTML = ("Price: $"+ price)
}

