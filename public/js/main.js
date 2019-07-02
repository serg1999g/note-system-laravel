$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(function () {

    let $wrapperImages = $('.wrapper-input-images'),
        $btnAddImage = $('.add-block-image');

    let count = 1;
    $btnAddImage.on('click', function (event) {
        event.preventDefault();
        if(count === 5){
        $btnAddImage.addClass('hide');
            return;
        }
        count++;

        let input = `<input type="file" name="image-${count}" class="image-input">`;
        $wrapperImages.append(input);
    });
});

// function handleFileSelect(evt) {
//     let files = evt.target.files; // FileList object
//
//     // Loop through the FileList and render image files as thumbnails.
//     for (let i = 0, f; f = files[i]; i++) {
//
//         // Only process image files.
//         if (!f.type.match('image.*')) {
//             continue;
//         }
//
//         let reader = new FileReader();
//
//         // Closure to capture the file information.
//         reader.onload = (function (theFile) {
//             return function (e) {
//                 // Render thumbnail.
//                 let span = document.createElement('span');
//
//                 span.innerHTML = ['<img class="thumb" src="', e.target.result,
//                     '" title="', escape(theFile.name), '"/>'].join('');
//                 document.getElementById('previewImg').insertBefore(span, null);
//             };
//         })(f);
//
//         // Read in the image file as a data URL.
//         reader.readAsDataURL(f);
//     }
// }
//
// document.getElementById('files').addEventListener('change', handleFileSelect, false);

