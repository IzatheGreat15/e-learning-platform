/* CLOSING OF THE MODAL */
// close the modal using the close button and when outside the modal is clicked
$(".close, .modal-bg, .close-btn").click(function(){
    $(".modal-bg").hide();
});

// stop the close modal when inside the modal is clicked
$(".modal-body").click(function(e) {
    e.stopPropagation();
})

// disable exiting the modal
$(".disable-modal").click(function(e) {
    e.stopPropagation();
})