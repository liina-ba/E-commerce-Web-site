// Variables for managing the cart, products, pagination, and filtering
let allProducts = [];
let cart = [];
let currentPage = 1;
const productsPerPage = 9;
let currentCategory = "all";




 // Fetch the latest products dynamically
 fetch('getLatestProducts.php')
 .then(response => response.json())
 .then(products => {
     const carouselInner = document.getElementById('carousel-inner');
     const productsPerSlide = 3;

     // Create carousel slides
     for (let i = 0; i < products.length; i += productsPerSlide) {
         const slide = document.createElement('div');
         slide.className = `carousel-item ${i === 0 ? 'active' : ''}`;

         const row = document.createElement('div');
         row.className = 'row';

         products.slice(i, i + productsPerSlide).forEach(product => {
             const col = document.createElement('div');
             col.className = 'col-md-4';
             col.innerHTML = `
                 <div class="card">
                     <img src="${product.product_image}" class="card-img-top" alt="${product.product_title}">
                     <div class="card-body text-center">
                         <h5 class="card-title">${product.product_title}</h5>
                         <p class="card-text">${parseFloat(product.product_price).toFixed(2)} DA</p>
                         <a href="viewDetails.php?id=${product.product_id}" class="btn btn-primary">View Details</a>
                     </div>
                 </div>
             `;
             row.appendChild(col);
         });

         slide.appendChild(row);
         carouselInner.appendChild(slide);
     }
 })
 .catch(error => console.error('Error fetching latest products:', error));

// Function to add a product to the cart
function addToCart(product) {
    fetch("addToCart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            product_id: product.id,
            quantity: 1,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                updateCartBadge(); // Update the badge
                console.log(data.message);
            }
        })
        .catch((error) => console.error("Error adding to cart:", error));
}


// Function to update the cart badge
function updateCartBadge() {
    fetch("getCart.php")
        .then((response) => response.json())
        .then((cartItems) => {
            const cartBadge = document.getElementById("cart-badge");
            const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
            cartBadge.textContent = totalItems;
        })
        .catch((error) => console.error("Error updating cart badge:", error));
}

// Call this function on every page load
document.addEventListener("DOMContentLoaded", () => {
    updateCartBadge();
});




