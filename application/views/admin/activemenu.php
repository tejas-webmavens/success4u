<script type="text/javascript">
 $(document).ready(function() {
    /*$('a[href^="'+document.location+'"]').parent().addClass("active");
    $('a[href^="'+document.location+'"]').parents().prev('a.accordion-toggle').addClass("menu-open");*/
    //$('ul["dropdown-menu"]').children('li').addclass("active");

      $('ul.nav.sidebar-menu li a[href^="'+document.location+'"]').parent().addClass("active");
        $('ul.nav.sidebar-menu li a[href^="'+document.location+'"]').parents().prev('a.accordion-toggle').addClass("menu-open");


} );
</script>