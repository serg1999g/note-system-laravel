$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {


    // Adding pictures
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


    // Delete images
    let $DeleteImage = $('.delete-image');

    $DeleteImage.on('click', function (e) {
        e.preventDefault();
        $(this).closest(".wrapper-image").remove();
        let id = this.id;
        console.log(id);
        let path = '../../image/'+id+'/destroy';

        $.ajax({
            url: path,
            type: "DELETE",
            data: id,
            success: function () {

            },
        });
    });
});
