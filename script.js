// Function to filter products by search input
function filterProducts() {
    const input = document.getElementById('searchBar').value.trim().toLowerCase();
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach((productCard) => {
        const productName = productCard.getAttribute('data-name').toLowerCase();
        productCard.style.display = productName.includes(input) ? "block" : "none";
    });
}

// Function to add items to the cart
let cartCount = 0;
let cart = [];

function addToCart(productName, price) {
    if (typeof productName === 'string' && typeof price === 'number') {
        cart.push({ name: productName, price: price });
        cartCount++;
        document.getElementById('cartCount').textContent = cartCount;
        alert(`${productName} has been added to your cart.`);
    } else {
        console.error('Invalid product name or price');
    }
}

// Save cart data (can later be connected to a backend system)
function saveCartData() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Load cart data from local storage
function loadCartData() {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
        cartCount = cart.length;
        document.getElementById('cartCount').textContent = cartCount;
    }
}

// Call loadCartData on page load
document.addEventListener('DOMContentLoaded', loadCartData);