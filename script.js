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





document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.editBtn');
    const form = document.getElementById('productForm');
    const productId = document.getElementById('productId');
    const productTitle = document.getElementById('productTitle');
    const productCategory = document.getElementById('productCategory');
    const productDescription = document.getElementById('productDescription');
    const productPrice = document.getElementById('productPrice');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            productId.value = button.dataset.id;
            productTitle.value = button.dataset.title;
            productCategory.value = button.dataset.category;
            productDescription.value = button.dataset.description;
            productPrice.value = button.dataset.price;

            form.scrollIntoView({ behavior: 'smooth' });
        });
    });
});


document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission from reloading the page

    const form = event.target;
    const formData = new FormData(form);

    // Send login data to PHP backend
    fetch("login.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Save user name and login state to localStorage
                localStorage.setItem("isLoggedIn", true);
                localStorage.setItem("userName", data.userName);

                // Update navigation bar
                const joinProfileLink = document.getElementById("join-profile");
                joinProfileLink.innerHTML = `<a href="profile.html">${data.userName}</a>`;

                alert(`Welcome, ${data.userName}!`);
            } else {
                alert("Invalid login credentials!");
            }
        })
        .catch(error => console.error("Error:", error));
});



