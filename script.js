// Function to filter products by search input
function filterProducts() {
    let input = document.getElementById('searchBar').value.toLowerCase();
    let productCards = document.getElementsByClassName('product-card');
    
    for (let i = 0; i < productCards.length; i++) {
        let productName = productCards[i].getAttribute('data-name').toLowerCase();
        if (productName.includes(input)) {
            productCards[i].style.display = "block";
        } else {
            productCards[i].style.display = "none";
        }
    }
}

// Function to add items to the cart
let cartCount = 0;
let cart = [];

function addToCart(productName, price) {
    cart.push({ name: productName, price: price });
    cartCount++;
    document.getElementById('cartCount').textContent = cartCount;
    alert(productName + " has been added to your cart.");
}

// Save cart data (can later be connected to a backend system)
