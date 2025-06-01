import './app.js';

document.addEventListener("DOMContentLoaded", () => {
    const cartBadge = document.getElementById('cart-badge');
    if (cartBadge) {
        updateCartBadge();
    } else {
        console.log('User is not logged in, cart badge is not rendered.');
    }
    fetch("getCart.php")
        .then((response) => response.json())
        .then((data) => {
            cart = data;
            console.log("Cart fetched from database:", cart);
        })
        .catch((error) => {
            console.error("Error fetching cart:", error);
        });

    document.getElementById("validate-order").addEventListener("click", () => {
        console.log("Validate Order button clicked");
        console.log("Cart to send:", cart);
        

        if (!cart || cart.length === 0) {
            Swal.fire({
                title: "Fail!",
                text: "Your cart is empty. Please add items before placing an order.",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#54bafa",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "products.php"; 
                }
            });
        }

        fetch("saveOrder.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                cart: cart,
            }),
        })
        .then((response) => response.json())
        .then((data) => {

            if (data.success) {
                Swal.fire({
                    title: "Success!",
                    text: "Your order has been successfully submitted to the store.",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#54bafa",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "products.php"; // Redirect to products page
                    }
                });
                cart = [];
                updateCartBadge();
            } 
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
});

// Function to render the cart (can be called on the cart page if needed)
function renderCart(cartItems) {
    const cartItemsContainer = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");
    let totalPrice = 0;

    cartItemsContainer.innerHTML = ""; // Clear previous content

    cartItems.forEach((item) => {
        const title = item.product_title || "N/A";
        const image = item.product_image || "default-image.png"; // Default image
        const price = item.product_price || 0;
        const quantity = item.quantity || 1;
        const total = item.total || price * quantity;

        totalPrice += total;

        const cartRow = document.createElement("tr");
        cartRow.innerHTML = `
            <td><img src="${image}" alt="${title}" class="cart-product-image"></td>
            <td>${title}</td>
            <td >
                <div class="quantity-control">
                    <button class="quantity-btn decrement" data-id="${item.product_id}">-</button>
                    <span class="quantity">${quantity}</span>
                    <button class="quantity-btn increment" data-id="${item.product_id}">+</button>
                </div>
            </td>
            <td>${total.toFixed(2)} DA</td>
            <td><button class="remove-btn delete-btn" data-id="${item.product_id}">X</button></td>
        `;
        cartItemsContainer.appendChild(cartRow);
    });

    totalPriceElement.textContent = `${totalPrice.toFixed(2)} DA`;

    // Attach event listeners for increment, decrement, and remove buttons
    setupCartButtons();
}

// Function to handle cart button actions
function setupCartButtons() {
    document.querySelectorAll(".increment").forEach((button) => {
        button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            updateCartQuantity(productId, 1); // Increment quantity
        });
    });

    document.querySelectorAll(".decrement").forEach((button) => {
        button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            const quantityElement = button.nextElementSibling; // Get the quantity element
            const currentQuantity = parseInt(quantityElement.textContent, 10);

            if (currentQuantity > 1) {
                updateCartQuantity(productId, -1); // Decrement quantity
            } else {
                console.log("Cannot decrease below 1");
            }
        });
    });

    document.querySelectorAll(".remove-btn").forEach((button) => {
        button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            removeFromCart(productId); // Remove product
        });
    });
}

// Function to update the cart quantity
function updateCartQuantity(productId, delta) {
    fetch("updateCartQuantity.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            product_id: productId,
            quantity_delta: delta,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                fetchCart(); // Refresh the cart after updating
                updateCartBadge(); // Update the cart badge
            }
        })
        .catch((error) => console.error("Error updating cart quantity:", error));
}

// Function to remove an item from the cart
function removeFromCart(productId) {
    fetch("removeFromCart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ product_id: productId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                fetchCart(); // Refresh the cart after removing the product
                updateCartBadge(); // Update the cart badge
            }
        })
        .catch((error) => console.error("Error removing from cart:", error));
}

// Call fetchCart when the cart page loads
if (document.getElementById("cart-page")) {
    fetchCart();
}

// Function to fetch and render the cart
function fetchCart() {
    fetch("getCart.php")
        .then((response) => response.json())
        .then((cartItems) => {
            renderCart(cartItems);
        })
        .catch((error) => console.error("Error fetching cart:", error));
}