const imagePreview = document.getElementById('image-preview');
const fileUpload = document.getElementById('fileToUpload');

let source;

const maxSize = 2 * 1024 * 1024;

// Ouverture de l'explorateur de fichier
imagePreview.addEventListener('click', function(){
    fileUpload.click();
})

// Preview de l'image, lors de la sélection du fichier
fileUpload.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        
        if (this.files[0].size > maxSize) {
            alert("Le fichier est trop volumineux. Veuillez sélectionner une image de moins de 2 Mo.");
            fileUpload.value = "";
        } else {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                source = imagePreview.src;
            };

            reader.readAsDataURL(this.files[0]);
        }
    }
});