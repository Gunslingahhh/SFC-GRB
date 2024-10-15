document.addEventListener('DOMContentLoaded', () => {
    const rawSequence = document.getElementById("raw-sequence");   
    const rawSequenceContainer = document.getElementById("raw-sequence-container");

    const cleanedSequence = document.getElementById("cleaned-sequence");   
    const cleanedSequenceContainer = document.getElementById("cleaned-sequence-container");

    const photoIdentification = document.getElementById("photo-identification");   
    const photoIdentificationContainer = document.getElementById("photo-identification-container");

    rawSequenceContainer.addEventListener("click", function() {
        rawSequence.click();
    });

    cleanedSequenceContainer.addEventListener("click", function() {
        cleanedSequence.click();
    });

    photoIdentificationContainer.addEventListener("click", function() {
        photoIdentification.click();
    });
});