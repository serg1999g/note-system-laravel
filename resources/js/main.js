$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(() => {
    // Adding pictures
    let $wrapperImages = $('.wrapper-input-images'),
        $btnAddImage = $('.add-block-image'),
        count = $('.wrapper-image').length + 2;

    $btnAddImage.on('click', function (event) {
        event.preventDefault();
        if (count === 6) {
            $btnAddImage.addClass('hide');
            return;
        }

        let input = `<input type="file" name="image-${count}" class="image-input">`;
        $wrapperImages.append(input);
        count++;
    });
    if (count > 6) {
        $btnAddImage.addClass('hide');
        $wrapperImages.addClass('hide');
    }


    // Delete images
    let $DeleteImage = $('.delete-image');

    $DeleteImage.on('click', function (event) {
        event.preventDefault();
        $(this).closest(".wrapper-image").remove();
        let id = this.id;
        let path = '../../image/' + id + '/destroy';

        $.ajax({
            url: path,
            type: "DELETE",
            data: id,
            success: function () {

            },
        });
    });
});
