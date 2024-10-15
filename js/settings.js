document.addEventListener('DOMContentLoaded', () => {
    const uploadButton = document.getElementById("upload-button");
    const fileInput = document.getElementById("image-file");   

    const profilePicture = document.getElementById("profile-picture");

    uploadButton.addEventListener("click", function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];   


        // Validate file type (optional)
        if (!file.type.match('image.*')) {
            alert("Please select an image file.");
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            profilePicture.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });

    const removeButton = document.getElementById("remove-button");

        removeButton.addEventListener("click", function() {
            profilePicture.src = ""; // Reset image to default
            fileInput.value = ""; // Clear the file input
        });
});