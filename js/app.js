// Profile picture upload functionality
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById("user-photo-filename");
    const profilePicture = document.getElementById("user-photo");

    if (fileInput && profilePicture) {
        profilePicture.addEventListener("click", function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file.type.match('image.*')) {
                alert("Please select an image file.");
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                profilePicture.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });
    } else {
        console.error("Profile picture or file input element not found!");
    }
});