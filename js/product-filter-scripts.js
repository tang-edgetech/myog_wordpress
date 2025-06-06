jQuery(document).ready(function($){
    function updateUrlParameterWithoutReload(parameter, value) {
        var url = new URL(window.location.href);
        url.searchParams.set(parameter, value);

        window.history.replaceState({}, '', url.toString());
    }

    $(document).on('click', '.btn[data-toggle="test-kit"]', function(e){
        e.preventDefault();
        var $this = $(this),
            $loading = $('.myog-tkp-body > .loading'),
            $target = $this.attr('data-target'),
            $packagesList = $('.myog-tkp-packages');
        console.log($target);

        $loading.fadeIn();
        $('.myog-tkp-wrapper .nav-item .nav-link').removeClass('active');
        $this.addClass('active');
        updateUrlParameterWithoutReload('category', $target);
        $.ajax({
            type: 'POST',
            url: myog_test_kit.ajaxurl,
            data: {
                action: 'myog_test_kit_filter',
                nonce: myog_test_kit.nonce,
                target: $target,
            },
            beforeSend: function(){
                $packagesList.html('');
            },
            success: function(response){
                $loading.fadeOut();
                console.log(response);
                if(response.status == 'success'){
                    $packagesList.html(response.html);
                }
                else{
                    $packagesList.html(response.html);
                }
            },
            error: function(xhr){
                $loading.fadeOut();
                console.log('Error');
                console.log(xhr);
            }
        })

    });
});