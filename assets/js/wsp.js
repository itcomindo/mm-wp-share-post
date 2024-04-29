window.addEventListener('DOMContentLoaded', (event) => {

    jQuery(function () {
        //jquery start below this line.

        function openWSP() {
            jQuery('.wsp-share-btn').on('click', function () {
                jQuery('#wsp-pr').removeClass('hide');
                jQuery('ul.wsp-list').addClass('animate__bounceInUp');
                setTimeout(function () {
                    jQuery('ul.wsp-list').removeClass('animate__bounceInUp').addClass('animate__rubberBand');
                    jQuery('small.wsp-text').addClass('animate__backInDown show');
                }, 1000);
            });
        }
        openWSP();

        function closeWSP() {
            jQuery('.wsp-close-btn, #wsp-pr, #wsp-wr').on('click', function () {
                jQuery('#wsp-pr').addClass('hide');
            });
        }
        closeWSP();



        //copy button start.
        function copyButtonWSP() {
            jQuery('.pf-copy').on('click', function (a) {
                a.preventDefault();
                var copyText = jQuery(this).find('a').attr('href');
                var tempInput = jQuery('<input>');
                jQuery('body').append(tempInput);
                tempInput.val(copyText).select();
                document.execCommand('copy');
                tempInput.remove();
                alert('Link copied to clipboard!');
            });
        }
        copyButtonWSP();

        //copy button end.


        //jquery end above this line.
    });
});