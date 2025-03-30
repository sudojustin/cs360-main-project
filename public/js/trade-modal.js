document.addEventListener('DOMContentLoaded', function() {
    const tradeModal = document.getElementById('tradeModal');
    const modalContent = document.querySelector('#tradeModal > div');
    const tradeForm = document.getElementById('tradeForm');
    const requestedProductName = document.getElementById('requestedProductName');
    const requestedProductQuantity = document.getElementById('requestedProductQuantity');
    const requestedProductValue = document.getElementById('requestedProductValue');
    
    // Open modal when "Initiate Trade" button is clicked
    document.querySelectorAll('.open-trade-modal').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productQuantity = this.getAttribute('data-product-quantity');
            const productValue = this.getAttribute('data-product-value');
            
            // Update modal content with product details
            requestedProductName.textContent = productName;
            requestedProductQuantity.textContent = productQuantity;
            requestedProductValue.textContent = parseFloat(productValue).toFixed(2);
            
            // Set form action with product ID
            tradeForm.action = `/trade/initiate/${productId}`;
            
            // Reset form fields
            document.getElementById('request_quantity').value = '1';
            document.getElementById('user_product_id').selectedIndex = 0;
            document.getElementById('offer_quantity').value = '1';
            
            // Show modal
            tradeModal.classList.remove('hidden');
        });
    });
    
    // Close modal when close button is clicked
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            tradeModal.classList.add('hidden');
        });
    });
    
    // Close modal when clicking outside of the modal content
    tradeModal.addEventListener('click', function(event) {
        // Check if the click was on the modal background (not on the modal content)
        if (event.target === tradeModal) {
            tradeModal.classList.add('hidden');
        }
    });
    
    // Validate quantity inputs when changed
    document.getElementById('request_quantity').addEventListener('change', function() {
        const max = parseInt(requestedProductQuantity.textContent);
        if (this.value > max) {
            this.value = max;
            alert(`Maximum available quantity is ${max}`);
        }
    });
    
    document.getElementById('user_product_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const maxQuantity = selectedOption.getAttribute('data-quantity');
        const offerQuantity = document.getElementById('offer_quantity');
        
        if (parseInt(offerQuantity.value) > parseInt(maxQuantity)) {
            offerQuantity.value = maxQuantity;
        }
    });
    
    document.getElementById('offer_quantity').addEventListener('change', function() {
        const productSelect = document.getElementById('user_product_id');
        if (productSelect.selectedIndex > 0) {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const maxQuantity = selectedOption.getAttribute('data-quantity');
            
            if (parseInt(this.value) > parseInt(maxQuantity)) {
                this.value = maxQuantity;
                alert(`Maximum available quantity is ${maxQuantity}`);
            }
        }
    });
}); 