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

    photoIdentificationContainer.addEventListener("click", function() {
        photoIdentification.click();
    });
});