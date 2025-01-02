// Profile picture upload functionality
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById("user-photo-filename");
    const profilePicture = document.getElementById("user-photo");

    const rawSequence = document.getElementById("raw-sequence");   
    const rawSequenceContainer = document.getElementById("raw-sequence-container");

    const cleanedSequence = document.getElementById("cleaned-sequence");   
    const cleanedSequenceContainer = document.getElementById("cleaned-sequence-container");

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

    rawSequenceContainer.addEventListener("click", function() {
        rawSequence.click();
    });

    rawSequence.addEventListener('change', function() {
        const file = rawSequence.files[0];
        const fileName = file.name;
        const fileSize = file.size;
        document.getElementById('rawSequencefileName').textContent = fileName + " ("+ fileSize + " KB)";
    });

    cleanedSequenceContainer.addEventListener("click", function() {
        cleanedSequence.click();
    });

    cleanedSequence.addEventListener('change', function() {
        const file = cleanedSequence.files[0];
        const fileName = file.name;
        const fileSize = file.size;
        document.getElementById('cleanedSequencefileName').textContent = fileName + " ("+ fileSize + " KB)";
    });
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