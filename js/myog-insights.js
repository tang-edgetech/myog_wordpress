document.addEventListener("DOMContentLoaded", function() {
	jQuery(document).ready(function() {
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            const results = regex.exec(window.location.search);
            return results === null ? null : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }


        const myogInsight = getUrlParameter('insight');
        if (myogInsight !== null ) {
            if( myogInsight.length > 0 ) {
                if( window.matchMedia("(max-width: 767px)").matches ) {
                    setTimeout(function(){
                        $('html, body').stop().animate({
                            scrollTop: $('#card-'+myogInsight).offset().top - 75
                        });
                    });
                }
                else {
                    setTimeout(function(){
                        $('html, body').stop().animate({
                            scrollTop: $('#modules-insights').offset().top - 50
                        });
                    });
                }

                setTimeout(function(){
                    $('#nav-'+myogInsight+'-tab').click();
                    $('#card-'+myogInsight+' .card-header button.btn').click();
                }, 150);
            }
        }

        $(document).on('click', '.myog-modules-insights .nav .nav-item', function(e) {
            let newValue = $(this).attr('href').replace('#nav-', '');
            let currentParam = new URLSearchParams(window.location.search).get('insight');
            if (currentParam !== newValue) {
                $('#myog-insight-accordion #card-'+newValue+' button.btn').click();

                const url = new URL(window.location);
                url.searchParams.set('insight', newValue);
                window.history.replaceState(null, null, url);
            }
        });

        $(document).on('click', '.myog-modules-insights .myog-insight-accordion .card-header button.btn', function() {
            var $this = $(this),
                $parents = $this.parents('.card');
            let newValue = $parents.attr('id').replace('card-', '');
            let currentParam = new URLSearchParams(window.location.search).get('insight');
            if (currentParam !== newValue) {
                const url = new URL(window.location);
                url.searchParams.set('insight', newValue);
                window.history.replaceState(null, null, url);
                $('#myog-insight-accordion .card').removeClass('card-opened');
                setTimeout(function(){
                    $('#nav-'+newValue+'-tab').click();
                }, 150);
            }

            if($parents.hasClass('card-opened')) {
                $parents.removeClass('card-opened');
                const url = new URL(window.location.href);
                url.searchParams.delete('insight');
                history.pushState(null, '', url.href);
            }
            else {
                $parents.addClass('card-opened');
            }
        });
    });
});