import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
//----------------------------------------
//Delete btn
//By clicking the delete btn on the index, prevent the default elimination
// open the Modal insert in the view-partials and REactivate the delete by clicking the btn 
const deleteBtns = document.querySelectorAll(".delete-btn");

deleteBtns.forEach((btn) => {
    btn.addEventListener("click", (event) => {
        event.preventDefault();
        const projectTitle = btn.getAttribute("data-project-title");
        const modal = new bootstrap.Modal(
            document.getElementById("deleteModal")
        );
        document.getElementById("modal-project-title").innerText = projectTitle;
        document.getElementById("delete").addEventListener("click", () => {
            btn.parentElement.submit();
        });
        modal.show();
    });
});
//----------------------------------------
//Preview Img
// when insert a img in the inpu type="file" with the Api READER showing the preview
const coverImageInput = document.getElementById("cover_img"); //input img
const imagePreview = document.getElementById("image_preview"); //preview img

if (coverImageInput && imagePreview) {
    //DEBUG console.log('change', this.files[0]);
    coverImageInput.addEventListener('change', function () {
        const uploadedFile = this.files[0];
        if (uploadedFile) { //if there is the file insert in src the path
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                imagePreview.src = reader.result;
            });
            reader.readAsDataURL(uploadedFile);
        }
    });
}
//----------------------------------------