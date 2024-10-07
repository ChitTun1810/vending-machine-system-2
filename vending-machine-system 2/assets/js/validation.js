document.addEventListener("DOMContentLoaded", function() {
    // Validate the product creation form
    var createProductForm = document.querySelector("form#create-product-form");
    if (createProductForm) {
        createProductForm.addEventListener("submit", function(event) {
            var name = document.getElementById("name").value.trim();
            var price = parseFloat(document.getElementById("price").value);
            var quantity = parseInt(document.getElementById("quantity").value);

            if (name === "" || isNaN(price) || price <= 0 || isNaN(quantity) || quantity < 0) {
                alert("Please ensure all fields are filled out correctly.");
                event.preventDefault();  // Prevent form submission if validation fails
            }
        });
    }

    // Validate the purchase form
    var purchaseForm = document.querySelector("form#purchase-form");
    if (purchaseForm) {
        purchaseForm.addEventListener("submit", function(event) {
            var productId = parseInt(document.getElementById("product_id").value);
            var quantity = parseInt(document.getElementById("quantity").value);

            if (isNaN(productId) || productId <= 0 || isNaN(quantity) || quantity <= 0) {
                alert("Please enter a valid product ID and quantity.");
                event.preventDefault();  // Prevent form submission if validation fails
            }
        });
    }
});
