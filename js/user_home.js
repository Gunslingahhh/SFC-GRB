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