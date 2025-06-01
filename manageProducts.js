
let allProducts = [];
let currentPage = 1;
const productsPerPage = 9;
let currentCategory = "all";

document.addEventListener("DOMContentLoaded", function() {
    // Fetch products when the DOM is fully loaded
    const productGrid = document.getElementById("product-grid");
    if (productGrid) {
        fetch("getProducts.php")
            .then((response) => response.json())
            .then((products) => {
                allProducts = products; // Store fetched products globally
                renderProducts(currentPage, allProducts); // Render the first page
                renderPagination(allProducts); // Render pagination
            })
            .catch((error) => console.error("Error fetching products:", error));
    }

    // Attach event listeners for category filtering
    document.querySelectorAll(".sidebar a").forEach((link) => {
        link.addEventListener("click", (event) => {
            event.preventDefault();
            currentCategory = event.target.getAttribute("data-category");
            document.getElementById("sort").value = "latest"; // Reset sort dropdown to default
    
            fetch(`getProducts.php?category=${encodeURIComponent(currentCategory)}`)

                .then((response) => response.json())
                .then((products) => {
                    allProducts = products;
                    currentPage = 1;
                    renderProducts(currentPage, allProducts);
                    renderPagination(allProducts);
                })
                .catch((error) => console.error("Error fetching filtered products:", error));
        });
    });
    
    
    document.getElementById("sort").addEventListener("change", (e) => {
        const sortBy = e.target.value; 
        console.log("Selected sort option:", sortBy);
        
        fetch(`getProducts.php?sort=${sortBy}&category=${currentCategory}`) 
            .then((response) => response.json())
            .then((products) => {
                allProducts = products; // Update global products array
                renderProducts(currentPage, allProducts); 
                renderPagination(allProducts); 
            })
            .catch((error) => console.error("Error fetching sorted products:", error));
    });
    
    
});

function renderProducts(page, products) {
    const startIndex = (page - 1) * productsPerPage;
    const endIndex = startIndex + productsPerPage;
    const productsToDisplay = products.slice(startIndex, endIndex);

    const productGrid = document.getElementById("product-grid");
    productGrid.innerHTML = ""; // Clear previous products

    if (productsToDisplay.length === 0) {
        productGrid.innerHTML = '<div class="no-products">No products found.</div>';
        return;
    }

    productsToDisplay.forEach((product) => {
        const productCard = document.createElement("div");
        productCard.className = "product-card";
        productCard.innerHTML = `
            <img src="${product.product_image}" alt="${product.product_title}" />
            <h3>${product.product_title}</h3>
            <p>${parseFloat(product.product_price).toFixed(2)} DA</p>
            <button class="btn btn-primary modify" 
                    data-id="${product.product_id}" 
                    data-title="${product.product_title}" 
                    data-price="${product.product_price}" 
                    data-image="${product.product_image}">
                Modify
            </button>
             <button class="btn btn-primary quick-look delete" 
                data-id="${product.product_id}">
                Delete
            </button>
        `;
        productGrid.appendChild(productCard);
    });

    // Add event listeners to "Modify" button
    document.querySelectorAll(".modify").forEach((button) => {
        button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            if (productId) {
                window.location.href = `modifyProduct.php?id=${productId}`;
            } else {
                alert("Product ID not provided.");
            }
        });
    });
    document.querySelectorAll(".delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            if (productId) {
                const modal = document.getElementById("customConfirmModal");
                const confirmBtn = document.getElementById("confirmDelete");
                const cancelBtn = document.getElementById("cancelDelete");
    
                modal.style.display = "flex"; 

                confirmBtn.addEventListener("click", () => {
                    fetch("deleteProduct.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ id: productId }),
                    })
                    .then((response) => {
                        if (response.ok) {
                            const productCard = e.target.closest(".product-card");
                            if (productCard) {
                                productCard.remove();
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Product successfully deleted.',
                            }).then(() => {
                                window.location.href = 'manageProducts.php'; // Redirect to the product management page after deletion
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete the product. Please try again.',
                            });
                        }
                        modal.style.display = "none";
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An error occurred while deleting the product.");
                        modal.style.display = "none";
                    });
                });
    
                cancelBtn.addEventListener("click", () => {
                    modal.style.display = "none"; 
                });
            } else {
                alert("Product ID not provided.");
            }
        });
    });
    

}

// Function to render pagination buttons
function renderPagination(products) {
    const totalPages = Math.ceil(products.length / productsPerPage);
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = ""; // Clear previous buttons

    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.textContent = i;
        button.className = i === currentPage ? "active" : "";
        button.addEventListener("click", () => {
            currentPage = i;
            renderProducts(currentPage, products);
            renderPagination(products);
        });
        pagination.appendChild(button);
    }
}


