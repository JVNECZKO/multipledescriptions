$(document).ready(function() {
    $('select[name^="group"]').change(function() {
        var id_product_attribute = $('input[name="id_product_attribute"]').val();
        var product_id = $('#combination-descriptions').data('product-id');
        var ajaxUrl = prestashop.urls.base_url + 'index.php?fc=module&module=multidescriptions&controller=ajax';

        console.log('Variant changed: ' + id_product_attribute); // Logowanie zmiany wariantu

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                id_product_attribute: id_product_attribute,
                ajax: true
            },
            success: function(data) {
                if (data && data.description !== undefined && data.description_short !== undefined) {
                    console.log('Description data received:', data); // Logowanie otrzymanych danych
                    $('.product-description').html(data.description);
                    $('.short-description').html(data.description_short);
                } else {
                    console.error('Invalid data received:', data); // Logowanie nieprawidłowych danych
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX request failed:', textStatus, errorThrown); // Logowanie błędów
                console.error('Response Text:', jqXHR.responseText); // Logowanie odpowiedzi
            }
        });
    });

    // Logowanie początkowej wartości id_product_attribute
    var initial_id_product_attribute = $('input[name="id_product_attribute"]').val();
    console.log('Initial id_product_attribute: ' + initial_id_product_attribute);
});
