/*
Parameters for displaying fancybox.php
 */
$('.fancybox').fancybox({
    beforeLoad: function () {
        var productId = this.element.attr('data-related-product');
        var $productWrapper = $('.product-' + productId);

        if ($productWrapper != null) {
            var image = $productWrapper.first().find('.latest_image').attr('src');
            var title = $productWrapper.first().find('.name_caption').text();
            var price = $productWrapper.first().find('.price').text();

            $('#fn-modal-image').attr('src', image);
            $('#fn-modal-title').html(title);
            $('#fn-modal-price').html(price);
        }
    },
});