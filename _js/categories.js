// Scripts for the "Edit categories" page

// Basic category functions

function createCategory() {
    var name = $('#newCategory').val();
    var parent = $('#newCategoryParent').val();
    
    $.ajax({
        url: '_app/ajax.php',
        data: {action: 'create-category', name: name, parent: parent},
        type: 'post',
        success: function(msg) {
            if (msg == true) {
                //updateCategories();
            }
            else {
                alert("Something went wrong while creating a new category! Please try again.");
            }
        },
        error: function(msg) {
            alert("Something went wrong while creating a new category! Please try again.\n\n"+msg);
        }
    });
}

function updateCategories() {
    $.ajax({
        url: '_app/ajax.php',
        data: {action: 'update-categories'},
        type: 'post',
        success: function(msg) {
            if (msg) {
                $('.all-categories').html(msg);
            }
            else {
                alert("Something went wrong while creating a new category! Please try again.");
            }
        },
        error: function(msg) {
            alert("Something went wrong while creating a new category! Please try again.\n\n"+msg);
        }
    });
}
