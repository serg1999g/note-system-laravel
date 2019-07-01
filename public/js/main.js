// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
//
//
// $(function () {
//
//     let $wrapperImages = $('.wrapper-input-images'),
//         $btnAddImage = $('.add-block-image');
//
//
//     let count = 1;
//     $btnAddImage.on('click', function (event) {
//         event.preventDefault();
//         if(count === 5) return;
//
//         count++;
//         let input = `<input type="file" name="image-${count}" class="image-input">`;
//         $wrapperImages.append(input);
//     });
// });

