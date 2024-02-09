//when i press the buy button it will make an alert saying that you bought the item and remove the item from the database
$(document).ready(function() {
    // When the "buy" button is clicked...
    $('.btn.btn-primary.buy').click(function() {
      // Find the closest thumbnail div to the clicked button
      var thumbnail = $(this).closest('.thumbnail');
      
      // Retrieve the information of the product from the DOM elements
      var productBrand = thumbnail.find('.brand').text().replace("Brand: ", "");
      var productCategory = thumbnail.find('.category').text().replace("Category: ", "");
      var productSize = thumbnail.find('.size').text().replace("Size: ", "");
      var productPrice = thumbnail.find('.price').text().replace("Price: ", "").replace(" €", "");
      var productName = thumbnail.find('.product_name').text();
      var user_name = thumbnail.find('.description').text().replace("Seller: ", "");
      alert("You have bought" + productName + "for " + productPrice + "€.");
      
      // Remove the item from the database
      removeItemFromDatabase(productName, productPrice, productBrand, productCategory, productSize, user_name);
      
      // Remove the item from the page
      thumbnail.closest('.col-sm-4').remove();
    });
  });

function removeItemFromDatabase(item_Name, item_Price, item_Brand, item_Category, item_Size, user_name) {

    $.ajax({
        type: "POST",
        url: "remove_Item.php",
        data: {
            item_Name: item_Name.trim(),
            item_Price: parseInt(item_Price),
            item_Brand: item_Brand.trim(),
            item_Category: item_Category.trim(),
            item_Size: item_Size.trim(),
            user_name: user_name.trim()
            
        },
      });

}



$(document).ready(function() {
  $('.btn.btn-primary.favorite-button').click(function() {
      var thumbnail = $(this).closest('.thumbnail');    
      // Retrieve the information of the product from the DOM elements
      var productBrand = thumbnail.find('.brand').text().replace("Brand: ", "");
      var productCategory = thumbnail.find('.category').text().replace("Category: ", "");
      var productSize = thumbnail.find('.size').text().replace("Size: ", "");
      var productPrice = thumbnail.find('.price').text().replace("Price: ", "").replace(" €", "");
      var productName = thumbnail.find('.product_name').text();
      var user_name = thumbnail.find('.description').text().replace("Seller: ", "");
      productName = productName.trim();
      productBrand = productBrand.trim();
      productCategory = productCategory.trim();
      productSize = productSize.trim();
      user_name = user_name.trim();
      productCategory = productCategory.charAt(0).toLowerCase() + productCategory.slice(1);
      productBrand = productBrand.charAt(0).toLowerCase() + productBrand.slice(1);
      productSize = productSize.charAt(0).toLowerCase() + productSize.slice(1);

      addRemoveFavorite(productName, parseInt(productPrice), productBrand, productCategory, productSize, user_name);

  });

});

function addRemoveFavorite(item_Name, item_Price, item_Brand, item_Category, item_Size, user_name) {
  $.ajax({
    type: "POST",
    url: "add_favorite.php",
    data: {
        item_Name: item_Name,
        item_Price: parseInt(item_Price),
        item_Brand: item_Brand,
        item_Category: item_Category,
        item_Size: item_Size,
        user_name_sell: user_name

    },
    success: function(response) {
      if (response === "added") {
        alert('The product has been added to your favorites list');
      } else if (response === "removed") {
        alert('The product has been removed from your favorites list');
      } else {
        alert('Something went wrong');
      }
    }
});

}
  