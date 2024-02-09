$(document).ready(function() {
  // Get the products
  var products = $(".thumbnail");

  // Keep track of visible products and their positions
  var visibleProducts = [];
  products.each(function(index) {
    visibleProducts.push({ product: $(this), index: index });
  });

  // Set up the event listener for the form submission
  $("form").submit(function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the selected values from the form
    var brand = $("#marcas").val();
    var category = $("#categorias").val();
    var size = $("#tamanhos").val();
    var user_name = $("#user_name").val();
    if (typeof(user_name) !== 'undefined') {
      $.ajax({
        type: "POST",
        url: "save_preferences.php",
        data: {
          user_name: user_name,
          brand: brand,
          category: category,
          size: size
        }
      });
    }
    // Filter the products
    visibleProducts = [];
    products.each(function(index) {
      var product = $(this);
      var productBrand = product.find(".brand").text();
      var productCategory = product.find(".category").text();
      var productSize = product.find(".size").text();
      productSize = productSize.charAt(1)+ productSize.slice(2);

      // Check if the product matches the selected brand, category, and size
      if ((brand === "all" || productBrand.includes(brand.charAt(0).toUpperCase() + brand.slice(1))) &&
          (category === "all" || productCategory.includes(category.charAt(0).toUpperCase() + category.slice(1))) &&
          (size === "all" || productSize.includes(size.charAt(0).toUpperCase() + size.slice(1)))) {
        // If the product matches, show it and add it to the list of visible products
        product.show();
        visibleProducts.push({ product: product, index: index });
      } else {
        // If the product doesn't match, hide it
        product.hide();
        
      }
    });

// Replace hidden products with the first visible product that comes after them
for (var i = 0; i < visibleProducts.length; i++) {
  var visibleProduct = visibleProducts[i];
  
  var nextVisibleProduct = visibleProducts[i + 1];
  
  if (i === 0 && visibleProduct.index !== 0) {
    visibleProduct.product.insertBefore(products.eq(0));
  } else if (nextVisibleProduct && nextVisibleProduct.index !== visibleProduct.index + 1) {
    if (visibleProducts[i - 1]) {
      visibleProduct.product.insertAfter(products.eq(visibleProducts[i - 1].index));
    } else {
      visibleProduct.product.insertBefore(products.eq(0));
    }
  }
}
  });
});