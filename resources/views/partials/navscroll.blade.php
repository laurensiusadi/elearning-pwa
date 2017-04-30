<script type="text/javascript">
    var didScroll;
    var lastScrollTop = 0;
    var delta = 10;
    var navbarHeight = $('nav').outerHeight();
    $(window).scroll(function(event){
        didScroll = true;
    });
    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);
    function hasScrolled() {
        var st = $(this).scrollTop();
        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <=  delta)
            return;
        if (st > lastScrollTop && st > navbarHeight){
            $('nav').addClass('nav-up');
        } else {
            if(st + $(window).height() < $(document).height()) {
                $('nav').removeClass('nav-up');
            }
        }
        lastScrollTop = st;
    }
</script>
