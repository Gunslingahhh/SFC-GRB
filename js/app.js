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

function buttonClicked() {
    const buttonContainer = document.getElementById("button-container");
    const buttonButton = document.getElementById("button-button");
    const isVouchered = document.getElementById("isVouchered");
    const storageLocation = document.getElementById("storage_location")

    if (buttonContainer.style.backgroundColor == "green"){
        buttonContainer.style.backgroundColor = "red";
        buttonButton.style.left="-2px";
        isVouchered.value="No";
        storageLocation.disabled=true;
    }
    else{
        buttonContainer.style.backgroundColor = "green";
        buttonButton.style.left="24px";
        isVouchered.value="Yes";
        storageLocation.disabled=false;
        storageLocation.required = true;
    }
}