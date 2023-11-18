
    function removeItem(itemId) {
        var confirmation = confirm("Are you sure you want to remove this item?");
        if (confirmation) {
            // Remove the item from the interface
            var itemElement = document.getElementById("item-" + itemId);
            if (itemElement) {
                itemElement.remove();
            }

            // AJAX call to update the database and remove the item
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove_item.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // You can handle the response if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.send("item_id=" + itemId);
        }
    }
