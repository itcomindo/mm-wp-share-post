window.addEventListener('DOMContentLoaded', (event) => {

    jQuery(function () {
        //jquery start below this line.

        function openWSP() {
            jQuery('.wsp-share-btn').on('click', function () {
                jQuery('#wsp-pr').removeClass('hide');
            });
        }
        openWSP();

        function closeWSP() {
            jQuery('.wsp-close-btn, #wsp-pr, #wsp-wr').on('click', function () {
                jQuery('#wsp-pr').addClass('hide');
            });
        }
        closeWSP();


        //jquery end above this line.
    });
});