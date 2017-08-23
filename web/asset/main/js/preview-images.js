$images = [];
$(document).ready(function() {
    $('#u-add').on('click', function() {
        $('#uevf_advertbundle_advert_uploads').trigger('click');
    });
    $('#uevf_advertbundle_advert_uploads').on('change', function() {
        $uploads.empty();
        $btn_add = $('<div>',{
            class:"u-add",
            id:'u-add',
        });
        $btn_add.on('click',function(){
            $('#uevf_advertbundle_advert_uploads').trigger('click');
        });
        $uploads.append($btn_add);
        $input = $(this)[0];
        if ($input.files) {
            $.each($input.files, function(i, file) {
                $images.push(file);
                $reader = new FileReader();
                $reader.readAsDataURL(file);
                $reader.onload = function(e) {
                    $img = $('<img>', {
                        class: 'u-preview',
                        src: e.target.result,
                        alt: 'previews'
                    });
                    $uploads.append($img);
                };
            });
        }
    });
});
